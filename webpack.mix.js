const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.alias({
//     '@': '/resources/js',
//     '@js': '/resources/js',
//     //'#': '/resources/sass',
//     '@sass': '/resources/sass',
//     '@cmp': '/resources/js/components',
//     '@api': '/resources/js/api',
//     //'@all': '/resources/js/components/pages/all'
// });

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
