<?php

namespace App\Http\Middleware;

use App\Models\PageViews;
use App\Models\Track;
use App\Models\TrackViews;
use Carbon\Carbon;
use Closure;
use File;

/**
 * VisitCounter
 * -----------------------
 * Middleware to count the visits of a page.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class VisitCounter {

    public static $COUNTER_FOLDER_NAME = "counter";
    public static $TRACK_FILE_PREFIX = 'track_';

    /**
     * Handles an incoming request and increases visit the counter for the specified page.
     *
     * @param  \Illuminate\Http\Request $request               The current request.
     * @param  \Closure                 $next
     * @param  string                   $page                  The name of the page to count the visits.
     * @param null|string               $requestParamKey       The dynamic identifier of the page or the object that
     *                                                         holds the identifier
     * @param null|string               $requestParamAttribute The attribute of the requestParamKey object to use as
     *                                                         the identifier of the page.
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $page, $requestParamKey = null, $requestParamAttribute = null) {
        $counterFileName = $page . ".txt";

        if (!empty($requestParamKey)) {
            $requestParam = $request->route()->parameter($requestParamKey);

            if (!empty($requestParamAttribute)) {
                $requestParam = $requestParam[$requestParamAttribute];
            }
            $counterFileName = $page . "_" . $requestParam . ".txt";
        }

        $counterFolderPath = self::getCounterFolderPathForDate();
        $counterFilePath = $counterFolderPath . "/" . $counterFileName;

        // Create counter folder if it doesn't exist.
        if (!is_dir($counterFolderPath)) {
            mkdir($counterFolderPath, 0777, true);
        }

        // Create counter file if it doesn't exist.
        if (!is_file($counterFilePath)) {
            $contents = 0;
            file_put_contents($counterFilePath, $contents);
        }

        // Get the current visit count
        $file = fopen($counterFilePath, "r");
        $count = fgets($file);
        fclose($file);

        // Check if file content is a number
        if (!is_numeric($count)) {
            $count = 0;
        }

        // Write the new count to the file
        $count = $count + 1;
        file_put_contents($counterFilePath, $count);

        return $next($request);
    }

    /**
     * Gets the path to the folder containing the counter files.
     *
     * @return string
     */
    public static function getCounterFolderPath() {
        return storage_path() . "/" . self::$COUNTER_FOLDER_NAME;
    }

    /**
     * Gets the path to the folder containing the counter files of a specific date.
     *
     * @param Carbon $date The date of the counts to retrieve
     *
     * @return string
     */
    public static function getCounterFolderPathForDate(Carbon $date = null) {
        if (empty($date)) {
            $date = Carbon::now();
        }

        return self::getCounterFolderPath() . "/" . $date->toDateString();
    }

    /**
     * Stores the visit counts from the counter files in the database.
     */
    public static function storeVisitCountsInDatabase() {
        foreach (File::directories(self::getCounterFolderPath()) as $countFolder) {
            $date = basename($countFolder);
            $date = Carbon::parse($date);

            // Only store the counts, which are earlier than today
            if (!$date->isToday()) {
                $filePaths = File::allFiles($countFolder);

                $page_count = 0;
                $track_counts = [];

                // Read the count from every count file
                foreach ($filePaths as $filePath) {
                    $fileName = pathinfo($filePath)['filename'];
                    $file = fopen($filePath, "r");
                    $count = fgets($file);
                    fclose($file);

                    if (substr($fileName, 0,
                            strlen(VisitCounter::$TRACK_FILE_PREFIX)) === VisitCounter::$TRACK_FILE_PREFIX
                    ) {
                        $trackId = substr($fileName, strlen(VisitCounter::$TRACK_FILE_PREFIX));
                        if (is_numeric($trackId)) {

                            // Check if the track still exists in the database
                            if (Track::find($trackId) == null) {
                                if (!unlink($filePath)) {
                                    \Log::critical('The track with id ' . $trackId . ' does not exist anymore and the file ' . $filePath . ' could not be deleted.');
                                }
                            } else {
                                $track_counts[$trackId] = $count;
                            }

                        } else {
                            \Log::error("The track views count id for file '$fileName' cannot be read.");
                        }
                    } else {
                        $page_count += $count;
                    }
                }

                // Save the general page views
                $pageViews = PageViews::whereDate('date', $date->toDateString())->first();
                if ($pageViews === null) {
                    $pageViews = new PageViews();
                    $pageViews->views_count = $page_count;
                    $pageViews->date = $date;
                } else {
                    $pageViews->views_count += $page_count;
                }
                $pageViews->save();

                // Save the track views
                foreach ($track_counts as $id => $track_count) {
                    $trackViews = TrackViews::whereDate('date', $date->toDateString())->where('track_id', $id)->first();
                    if ($trackViews === null) {
                        $trackViews = new TrackViews();
                        $trackViews->track_id = $id;
                        $trackViews->views_count = $track_count;
                        $trackViews->date = $date;
                    } else {
                        $trackViews->views_count += $track_count;
                    }
                    $trackViews->save();
                }

                File::deleteDirectory($countFolder);
            }
        }
    }

    /**
     * Gets the total views count for the specified track.
     *
     * @param Track $track
     *
     * @return int
     */
    public static function getTrackViewsCount(Track $track) {
        $pageViews = self::getTotalPageViews(null, $track->id);

        return $pageViews->sum('views_count');
    }

    /**
     * Gets the total views count for all pages.
     *
     * @param null|Carbon $date The date to filter.
     *
     * @return int
     */
    public static function getTotalPageViewsCount(Carbon $date = null) {
        $pageViews = self::getTotalPageViews($date);

        return $pageViews->sum('views_count');
    }

    /**
     * Gets the total views per day for all pages.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getDailyTrackViews() {
        $groupedPageViews = self::getTotalPageViews()->groupBy(function ($item, $key) {
            return $item->date->toDateString();
        });

        $pageViews = collect();
        foreach ($groupedPageViews as $groupedPageView) {
            $pageView = new PageViews();
            $pageView->date = $groupedPageView->get(0)->date;
            $pageView->views_count = $groupedPageView->sum('views_count');
            $pageViews->push($pageView);
        }

        return $pageViews;
    }

    /**
     * Gets the views counts for every page within a collection.
     *
     * @param null|Carbon $filterDate    The date to filter.
     * @param null|int    $filterTrackId The id of the track to get the view count.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getTotalPageViews(Carbon $filterDate = null, $filterTrackId = null) {
        $pageViews = collect();
        foreach (array_reverse(File::directories(self::getCounterFolderPath())) as $countFolder) {
            $date = basename($countFolder);
            $date = Carbon::parse($date);

            if (!empty($filterDate) && !$date->isSameDay($filterDate)) {
                continue;
            }

            // Read the count from every count file
            foreach (File::allFiles($countFolder) as $filePath) {
                $fileName = pathinfo($filePath)['filename'];
                $file = fopen($filePath, "r");
                $count = fgets($file);
                fclose($file);

                if (substr($fileName, 0, strlen(self::$TRACK_FILE_PREFIX)) === self::$TRACK_FILE_PREFIX) {
                    $trackId = substr($fileName, strlen(self::$TRACK_FILE_PREFIX));

                    if (is_numeric($trackId)) {

                        // Check if the track still exists in the database
                        if (Track::find($trackId) == null) {
                            if (!unlink($filePath)) {
                                \Log::critical('The track with id ' . $trackId . ' does not exist anymore and the file ' . $filePath . ' could not be deleted.');
                            }
                        } else if ((empty($filterTrackId) || $filterTrackId == $trackId)) {
                            $trackView = new TrackViews();
                            $trackView->track_id = $trackId;
                            $trackView->date = $date;
                            $trackView->views_count = $count;

                            $trackView->track = Track::find($trackId);

                            $pageViews->push($trackView);
                        }

                    } else {
                        \Log::error("The track views count id for file '$fileName' cannot be read.");
                    }

                } elseif (empty($filterTrackId)) {
                    $pageView = new PageViews();
                    $pageView->page = ucfirst($fileName);
                    $pageView->date = $date;
                    $pageView->views_count = $count;

                    $pageViews->push($pageView);
                }
            }
        }

        $dbViews = collect();
        $dbPageViewsQuery = PageViews::orderBy('date', 'desc');
        $dbPostViewsQuery = TrackViews::orderBy('date', 'desc');
        if (!empty($filterDate)) {
            $dbFilterDate = $filterDate->toDateString();
            $dbPageViewsQuery = $dbPageViewsQuery->whereDate('date', $dbFilterDate);
            $dbPostViewsQuery = $dbPostViewsQuery->whereDate('date', $dbFilterDate);
        }

        if (!empty($filterTrackId)) {
            $dbPostViewsQuery = $dbPostViewsQuery->where('track_id', $filterTrackId);
        } else {
            $dbViews = $dbViews->merge($dbPageViewsQuery->get());
        }

        $dbViews = $dbViews->merge($dbPostViewsQuery->get());

        $dbViews = $dbViews->sortByDesc('date');

        $pageViews = $pageViews->merge($dbViews);

        return $pageViews;
    }
}
