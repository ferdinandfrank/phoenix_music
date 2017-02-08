<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Serie;
use App\Models\Settings;
use EpicArrow\GitChangeLog\GitChangeLog;
use Illuminate\Http\Request;

/**
 * ChangelogController
 * -----------------------
 * Controller to handle the logic for the 'changelog' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class ChangelogController extends Controller {

    /**
     * Displays the changelog page with a listing of the last commits.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View The view of the changelog page.
     */
    public function index() {
        $changeLog = GitChangeLog::get();

        return view('backend.changelog.index', compact('changeLog'));
    }


}
