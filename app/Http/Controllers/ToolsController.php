<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use DB;
use Excel;
use Gate;
use Illuminate\Support\Facades\Artisan;

/**
 * ToolsController
 * -----------------------
 * Handles the logic for the 'tools' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class ToolsController extends Controller {

    /**
     * The current date.
     *
     * @var false|string
     */
    protected $date;

    /**
     * The archives name for the download operation.
     *
     * @var string
     */
    private $archive_download_name;

    private $log_download_name;

    private $logFile;

    private $blogTitle;

    /**
     * Creates a new ToolsController instance.
     */
    public function __construct() {
        $this->date = date('Y-m-d');
        $this->blogTitle = App\Models\Settings::pageTitle();

        $this->archive_download_name = snake_case($this->blogTitle . '-archive');

        $this->logFile = storage_path() . "/logs/laravel.log";
        $this->log_download_name = $this->date . '_' . $this->blogTitle . '_log.log';
    }

    /**
     * Displays the tools page.
     *
     * @return \Illuminate\View\View The tools page.
     */
    public function index() {
        if (Gate::denies('update', App\Models\Settings::class)) {
            return redirect()->back();
        }

        // Get the datetime when the last search index was created.
        $indexModified = file_exists(storage_path('tracks.index')) ? filemtime(storage_path('tracks.index')) : false;

        $status = App::isDownForMaintenance() ? 0 : 1;

        return view('backend.tools.index', compact('status', 'indexModified'));
    }

    /**
     * Sends a test mail to the application's sender email address to test the email settings.
     */
    public function sendTestMail() {
        \Mail::to(config('mail.from.address'))
            ->send(new App\Mail\TestEmail());
    }

    /**
     * Clears the applications cache.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the operation was successful, {@code false} otherwise.
     */
    public function clearCache() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        $exitCode = Artisan::call('optimize');
        if ($exitCode === 0) {
            return response()->json(true);
        }

        return response()->json(getJsonError(), 500);
    }

    /**
     * Creates a database backup.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBackup() {
        $dbType = config('database.default');
        $info = config('database.connections.' . $dbType);
        $hostname = escapeshellcmd($info['host']);
        $user = escapeshellcmd($info['username']);
        $password = $info['password'];
        $database = escapeshellcmd($info['database']);

        $date = Carbon::now()->toDateString();
        $exportPath = 'backups/' . $database . '-' . $date . '.sql';
        $command = "mysqldump --no-tablespaces --host=$hostname --user=$user --password='$password' $database --result-file='~/$exportPath' 2>&1";

        exec($command, $output, $error);

        return response()->json(['msg' => $output], $error ? 500 : 200);
    }

    /**
     * Downloads the current log file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadLog() {
        return response()->download($this->logFile, $this->log_download_name);
    }

    /**
     * Clears the content of the current log file.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearLog() {
        $result = file_put_contents($this->logFile, "");

        return response()->json($result, $result === false ? 500 : 200);
    }

    /**
     * Resets the index for searching.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the operation was successful, {@code false} otherwise.
     */
    public function resetIndex() {
        $exitCode = Artisan::call('portfolio:index');
        if ($exitCode === 0) {
            return response()->json(true);
        }

        return response()->json(getJsonError(), 500);
    }

    /**
     * Creates and downloads an archive of all existing data.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse The download execution of the archive.
     */
    public function handleDownload() {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $this->storeDatabaseTable($table->Tables_in_spoferan_blog);
        }

        $this->storeUploads();
        $date = date('Y-m-d');
        $path = storage_path($date . $this->archive_download_name);
        $filename = sprintf('%s.zip', $path);
        $zip = new \ZipArchive();
        $zip->open($filename, \ZipArchive::CREATE);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        \File::deleteDirectory(storage_path($date . $this->archive_download_name));

        return response()->download(storage_path($date . '_' . $this->archive_download_name . '.zip'))->deleteFileAfterSend(true);
    }

    private function storeDatabaseTable($tableName) {
        $entries = DB::table($tableName)->get()->toArray();
        if (!empty($entries)) {
            Excel::create($tableName, function ($excel) use ($tableName, $entries) {
                $excel->sheet($tableName, function ($sheet) use ($entries) {
                    $sheet->appendRow(array_keys(json_decode(json_encode($entries[0]), true)));
                    foreach ($entries as $entry) {
                        $sheet->appendRow(json_decode(json_encode($entry), true));
                    }
                });
            })->store('xlsx', storage_path($this->date . $this->archive_download_name), true);
        }
    }


    private function storeUploads() {
        $source = storage_path('app/public');
        $destination = storage_path($this->date . $this->archive_download_name . '/uploads/');

        return \File::copyDirectory($source, $destination);
    }

    /**
     * Enables the application's maintenance mode.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the operation was successful, {@code false} otherwise.
     */
    public function enableMaintenanceMode() {
        $exitCode = Artisan::call('down');
        if ($exitCode === 0) {
            return response()->json(true);
        }

        return response()->json(getJsonError(), 500);
    }

    /**
     * Disables the application's maintenance mode.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the operation was successful, {@code false} otherwise.
     */
    public function disableMaintenanceMode() {
        $exitCode = Artisan::call('up');
        if ($exitCode === 0) {
            return response()->json(true);
        }

        return response()->json(getJsonError(), 500);
    }
}
