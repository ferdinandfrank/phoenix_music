<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VisitCounter;
use App\Jobs\StoreVisitCounts;
use App\Models\TrackViews;
use DB;

/**
 * StatisticsController
 * -----------------------
 * Handles the logic for the 'statistics' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class StatisticsController extends Controller {

    /**
     * Displays the statistics page.
     *
     * @return \Illuminate\View\View The statistics page.
     */
    public function index() {
        dispatch(new StoreVisitCounts());

        $pageViews = VisitCounter::getTotalPageViews();
        $totalVisits = VisitCounter::getTotalPageViewsCount();
        $dailyViews = VisitCounter::getDailyTrackViews();
        $trackViews = TrackViews::select(DB::raw('track_id, sum(views_count) as views_count'))->with('track')->groupBy('track_id')->orderBy('views_count', 'desc')->get();

        return view('backend.statistics.index', compact('pageViews', 'totalVisits', 'trackViews', 'dailyViews'));
    }
}
