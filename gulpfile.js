const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var assetsPath = 'public/assets/';

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
        // Sass files
        mix.sass([
        'app.scss',
        'theme-elements.css',
        'theme-animate.css',
        'skin.css',
        'custom.css'
    ], assetsPath + 'css/app.css');

    // JS files
    mix.webpack([
        'app.js',
        'theme.js',
        'views/view.home.js',
        'custom.js',
        'jquery.fastLiveFilter.js',
        'theme.init.js',

    ], assetsPath + 'js/app.js');
});
