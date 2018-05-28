<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Settings;

/**
 * PrivacyPolicyController
 * -----------------------
 * Controller to handle the logic for the 'privacy' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class PrivacyPolicyController extends Controller {

    /**
     * Displays the contact page.
     *
     * @return \Illuminate\View\View The contact page.
     */
    public function index() {
        return view('frontend.privacy_policy.index');
    }
}
