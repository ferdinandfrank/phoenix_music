const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

let assetsPath = 'public/assets/';
let buildPath = 'public/build/assets/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    // Sass Backend
    mix.sass([
        'backend/app.scss',
        'backend/vendor/select2/select2.css',
        '../talvbansal/media-manager/css/media-manager.css',
        '../vendor/vue-forms/sass/vue-forms.scss'
    ], assetsPath + 'css/backend.css');

    // Sass Frontend
    mix.sass([
        'frontend/app.scss',
        '../vendor/vue-forms/sass/vue-forms.scss'
    ], assetsPath + 'css/frontend.css');

    // JS Backend
    mix.webpack([
        'backend/app.js',
        '../talvbansal/media-manager/js/media-manager.js',
        '../vendor/vue-forms/js/vue-forms.js',
    ], assetsPath + 'js/backend.js');

    // JS Frontend
    mix.webpack([
        'frontend/app.js',
        'frontend/jquery.fastLiveFilter.js',
        '../vendor/vue-forms/js/vue-forms.js',
    ], assetsPath + 'js/frontend.js');

    // Copy images
    mix.copy('resources/assets/images', assetsPath + 'images');
    mix.copy('resources/assets/images', buildPath + 'images');

    // Copy fonts
    mix.copy('resources/assets/fonts', assetsPath + '/fonts');
    mix.copy('resources/assets/fonts', buildPath + '/fonts');
    mix.copy('resources/assets/talvbansal/media-manager/fonts', buildPath + '/fonts');

    // Copy NPM fonts
    mix.copy(['node_modules/ContentTools/build/icons.woff'], buildPath + '/css');

    // Version the assets
    mix.version([
        // CSS files
        assetsPath + 'css/backend.css',
        assetsPath + 'css/frontend.css',

        // JS files
        assetsPath + 'js/backend.js',
        assetsPath + 'js/frontend.js',
    ]);
});
