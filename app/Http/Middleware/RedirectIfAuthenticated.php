<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * RedirectIfAuthenticated
 * -----------------------
 * Middleware to redirect authenticated user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handles an incoming request and redirects the user if he's authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
