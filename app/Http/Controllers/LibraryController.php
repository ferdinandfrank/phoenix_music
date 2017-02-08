<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Track;

/**
 * LibraryController
 * -----------------------
 * Controller to handle the logic for the frontend 'track' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class LibraryController extends Controller {

    /**
     * Displays a listing of the tracks.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $tracks = Track::with('categories')->orderBy('published_at', 'desc')->get();
        $albums = Album::all();
        $categories = Category::all();

        return view('frontend.track.index', compact('tracks', 'categories', 'albums'));
    }

}
