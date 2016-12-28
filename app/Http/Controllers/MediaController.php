<?php

namespace App\Http\Controllers;

/**
 * MediaController
 * -----------------------
 * Controller to handle the logic of the 'media' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class MediaController extends Controller {

    /**
     * Shows the media page.
     *
     * @return \Illuminate\View\View The media page.
     */
    public function index() {
        return view('backend.media.index');
    }
}
