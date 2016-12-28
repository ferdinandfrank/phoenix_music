<?php

namespace App\Jobs;

use App\Http\Middleware\VisitCounter;
use App\Models\PageViews;
use App\Models\PostViews;
use Carbon\Carbon;
use File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * StoreViews
 * -----------------------
 * Reads the visit counts from all count files and stores them in the database.
 * -----------------------
 * @author Ferdinand Frank
 * @version 1.0
 * @package App\Jobs
 */
class StoreVisitCounts implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        VisitCounter::storeVisitCountsInDatabase();
    }
}
