<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Original;
use Session;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * CheckForMaintenanceMode
 * -----------------------
 * Middleware to handle the authorization of page access if the application is in maintenance mode.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class CheckForMaintenanceMode extends Original {

    private $except = ['admin', 'admin/*', 'login', 'logout'];

    private $excludedIPs = [];

    private function shouldPassThrough($request) {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handles an incoming request and checks if the user has permission to access the pages if the application is in
     * maintenance mode.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next) {
        if ($this->app->isDownForMaintenance()) {
            $response = $next($request);

            // Allow specific ip addresses to view the page.
            if (in_array($request->ip(), $this->excludedIPs + $this->getExcludedIPs())) {
                return $response;
            }

            // Allow super admins and admins to view the page.
            if (\Auth::check() && (\Auth::user()->isType(\Config::get('user_type.super_admin')) || \Auth::user()->isType(\Config::get('user_type.admin')))) {
                return $response;
            }

            // Allow specific pages to be viewed.
            if ($this->shouldPassThrough($request)) {
                return $response;
            }

            throw new HttpException(503);
        }

        return $next($request);
    }

    private function getExcludedIPs() {
        return (array)Session::get('admin_ip', []);
    }
}
