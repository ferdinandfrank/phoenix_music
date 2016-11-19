<?php

namespace App\Http\Controllers;

use App\Models\Track;

class TrackController extends Controller {

    /**
     * Displays a listing of the tracks.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $tracks = Track::all();

        return view('tracks.index', compact('tracks'));
    }

    public function show(Track $track) {

        return view('tracks.show', compact('track'));
    }
}
