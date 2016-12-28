<?php

namespace App\Http\Controllers;


use App\Mail\ContactEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Settings;

/**
 * ContactController
 * -----------------------
 * Controller to handle the logic for the 'contact' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class ContactController extends Controller {

    /**
     * Displays the contact page.
     *
     * @return \Illuminate\View\View The contact page.
     */
    public function index() {
        $users = User::all();

        return view('frontend.contact.index', compact('users'));
    }

    /**
     * Sends the requested data as a contact email.
     *
     * @param Request $request
     * @param-request email The sender email address.
     * @param-request name The name of the sender.
     * @param-request message The message of the email body.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $this->validate($request, [
            'email'   => 'required|email',
            'name'    => 'required',
            'message' => 'required'
        ]);

        \Mail::to(Settings::emailContact())
            ->cc(User::all())
            ->send(new ContactEmail($request));

        return response()->json(true);
    }

}
