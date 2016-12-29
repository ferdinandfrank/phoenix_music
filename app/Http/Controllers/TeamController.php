<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * TeamController
 * -----------------------
 * Controller to handle the logic for the 'team' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class TeamController extends Controller {

    /**
     * Displays the team page.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $users = User::all();
        return view('frontend.team.index', compact('users'));
    }

}
