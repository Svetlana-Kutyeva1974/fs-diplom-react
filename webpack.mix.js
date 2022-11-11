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
/*
mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css');

mix.copyDirectory('resources/i', 'public/i');
mix.copyDirectory('resources/css', 'public/css');
*/
mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css');

mix.copyDirectory('resources/i', 'public/i');
mix.copyDirectory('resources/css', 'public/css');

mix.styles(
    ['resources/css/normilize.css', 'resources/css/styles.css'],
    'public/css/all.css'
);
