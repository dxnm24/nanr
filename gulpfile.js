var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.sass([
        '../../../node_modules/foundation-sites/dist/foundation.min.css',
        '../../../node_modules/font-awesome/css/font-awesome.min.css',
        '../../../node_modules/swiper/dist/css/swiper.min.css',
        'style.scss'
    ], 'public/css/app.css');

    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/foundation-sites/dist/foundation.min.js',
		'../../../node_modules/swiper/dist/js/swiper.jquery.min.js',
		'../../../node_modules/lazysizes/lazysizes.min.js',
		'script.js'
    ], 'public/js/app.js');

});
