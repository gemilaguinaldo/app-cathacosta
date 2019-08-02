let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/bar.js', 'public/js')
   .js('resources/assets/js/dashboard.js', 'public/js')
   .js('resources/assets/js/roles.js', 'public/js')
   .js('resources/assets/js/users.js', 'public/js')
   .js('resources/assets/js/categories.js', 'public/js')
   .js('resources/assets/js/expenses.js', 'public/js')
   .js('resources/assets/js/profile.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/login.scss', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images');


// mix.scripts([
// 	'resources/assets/js/app.js',
// 	'resources/assets/js/bar.js',
// 	'resources/assets/js/alert.js'
// 	], 'public/js/app.js');