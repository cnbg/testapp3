const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/css/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version()
}
