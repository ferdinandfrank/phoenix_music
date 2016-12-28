<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VisitCounter;
use App\Jobs\StoreVisitCounts;
use App\Models\PageViews;
use App\Models\Post;
use App\Models\PostViews;
use App\Utils\LocalDate;
use Carbon\Carbon;
use File;

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
     * @return \Illuminate\View\View The tools page.
     */
    public function index() {
        dispatch(new StoreVisitCounts());
        $pageViews = VisitCounter::getTotalPageViews();

        return view('backend.statistics.index', compact('pageViews'));
    }
}
