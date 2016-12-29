<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;

/**
 * ForgotPasswordController
 * -----------------------
 * This controller is responsible for handling password reset emails and
 * includes a trait which assists in sending these notifications from
 * your application to your users. Feel free to explore this trait.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers\Auth
 */
class ForgotPasswordController extends Controller {

    use SendsPasswordResetEmails;

    /**
     * Creates a new controller instance.
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Sends a reset link to the user with the specified email address.
     *
     * @param  \Illuminate\Http\Request $request
     * @param-request email The email address where to send the reset link.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request) {
        $this->validate($request, ['email' => 'required|email|exists:users,email'], [
            'email.exists' => \Lang::get('validation.password.email.exists'),
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(true);
        }

        // If an error was returned by the password broker, we will get this message
        // translated so we can notify a user of the problem. We'll redirect back
        // to where the users came from so they can attempt this process again.
        return response()->json(false, 500);
    }
}
