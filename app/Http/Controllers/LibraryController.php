<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Track;

class LibraryController extends Controller {

    /**
     * Displays a listing of the tracks.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $tracks = Track::with('categories')->get();
        $albums = Album::all();
        $categories = Category::all();

        return view('frontend.track.index', compact('tracks', 'categories', 'albums'));
    }

}
