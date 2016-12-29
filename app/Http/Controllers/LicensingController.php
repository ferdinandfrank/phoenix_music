<?php

namespace App\Http\Controllers;

use App\Models\Track;

/**
 * LicensingController
 * -----------------------
 * Controller to handle the logic for the 'licensing' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class LicensingController extends Controller {

    /**
     * Displays the licensing page.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $styeTracks = Track::whereNotNull('stye')->get();
        $audiojungleTracks = Track::whereNotNull('audiojungle')->get();

        return view('frontend.licensing.index', compact('styeTracks', 'audiojungleTracks'));
    }
}
