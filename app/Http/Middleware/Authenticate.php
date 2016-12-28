<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Authenticate
 * -----------------------
 * Middleware for the routes that can only be accessed authenticated.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class Authenticate {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Creates a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handles an incoming request and checks if the user is authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return response()->view('auth.login');
            }
        }

        return $next($request);
    }
}
