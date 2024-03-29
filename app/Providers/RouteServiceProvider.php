<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param Request $request
     *
     * @return void
     */
    public function map(Request $request) {
        $this->mapApiRoutes();

        $this->mapWebRoutes($request);

        //
    }

    /**
     * Define the "web" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Request $request
     *
     * @return void
     */
    protected function mapWebRoutes(Request $request) {
        $params = [
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ];

        $locale = $request->segment(1);
        if (array_key_exists($locale, config('app.locales'))) {
            $params['prefix'] = $locale;
        }

        Route::group($params, function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
