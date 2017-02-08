<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VisitCounter;
use Carbon\Carbon;
use EpicArrow\GitChangeLog\GitChangeLog;

/**
 * HomeController
 * -----------------------
 * Controller to handle the logic for the 'home' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class HomeController extends Controller {

    /**
     * Displays the admin's dashboard.
     *
     * @return \Illuminate\View\View The admins dashboard.
     */
    public function index() {

        $changeLog = GitChangeLog::get(10);

        $totalVisits = VisitCounter::getTotalPageViewsCount();
        $todayVisits = VisitCounter::getTotalPageViewsCount(Carbon::now());

        // Retrieve information about the server
        $system = [
            'url'              => $_SERVER['HTTP_HOST'],
            'ip'               => $_SERVER['REMOTE_ADDR'],
            'timezone'         => env('APP_TIMEZONE'),
            'php_version'      => phpversion(),
            'php_memory_limit' => ini_get('memory_limit'),
            'php_time_limit'   => ini_get('max_execution_time'),
            'db_connection'    => strtoupper(env('DB_CONNECTION')),
            'web_server'       => $_SERVER['SERVER_SOFTWARE']
        ];

        return view('backend.home.index', compact('system', 'changeLog', 'todayVisits', 'totalVisits'));
    }
}
