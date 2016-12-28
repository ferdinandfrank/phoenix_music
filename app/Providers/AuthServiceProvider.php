<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Track;
use App\Models\User;
use App\Policies\AlbumPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\TrackPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Track::class    => TrackPolicy::class,
        User::class     => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Settings::class => SettingsPolicy::class,
        Album::class    => AlbumPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        //
    }
}
