<?php

namespace App\Http\Controllers;

use App\Models\Track;

class LicensingController extends Controller {


    public function index() {
        $styeTracks = Track::whereNotNull('stye')->get();
        $audiojungleTracks = Track::whereNotNull('audiojungle')->get();

        return view('frontend.licensing.index', compact('styeTracks', 'audiojungleTracks'));
    }
}
