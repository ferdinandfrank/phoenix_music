<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VisitCounter;
use App\Jobs\StoreVisitCounts;

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

        return view('backend.statistics.index', compact('pageViews'));
    }
}
