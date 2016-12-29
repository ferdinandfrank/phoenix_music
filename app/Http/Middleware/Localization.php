<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Localization
 * -----------------------
 * Middleware to handle the localization of the application.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class Localization {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $locale = $request->segment(1);

        // Make sure current locale exists.
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = config('app.fallback_locale');
        }

        \App::setLocale($locale);

        return $next($request);
    }
}
