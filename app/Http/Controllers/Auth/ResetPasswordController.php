<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Password;

/**
 * ResetPasswordController
 * -----------------------
 * This controller is responsible for handling password reset requests
 * and uses a simple trait to include this behavior. You're free to
 * explore this trait and override any methods you wish to tweak.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController extends Controller {

    use ResetsPasswords;

    /**
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.

*
*@param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string                                $password
     *
     * @return void
     */
    protected function resetPassword($user, $password) {
        $user->forceFill([
            'password'       => $password,
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    /**
     * Get the response for a successful password reset.

*
*@param  string $response
     *
     *@return \Illuminate\Http\Response
     */
    protected function sendResetResponse($response) {
        return response()->json(true);
    }

    /**
     * Get the response for a failed password reset.

     *
*@param  \Illuminate\Http\Request
     * @param  string $response

     *
*@return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response) {
        return response()->json(false, 500);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function reset(Request $request) {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ], [
            'email.exists' => \Lang::get('validation.password.email.exists'),
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

}
