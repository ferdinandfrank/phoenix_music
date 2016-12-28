<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\Console\FlushCommand;
use Laravel\Scout\Console\ImportCommand;
use Laravel\Scout\EngineManager;

/**
 * ScoutServiceProvider
 * -----------------------
 * Provides the scout commands for the application.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Providers
 */
class ScoutServiceProvider extends ServiceProvider {

    /**
     * Registers the scout commands.
     */
    public function register() {
        $this->app->singleton(EngineManager::class, function ($app) {
            return new EngineManager($app);
        });

        $this->commands([
            ImportCommand::class,
            FlushCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/scout.php' => config_path('scout.php'),
        ]);
    }
}
