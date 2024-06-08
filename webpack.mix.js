const mix = require('laravel-mix');
require('laravel-mix-serve');

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/assets/js')
    .postCss('resources/css/app.css', 'public/assets/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .version();

if (process.argv.length >= 4 && process.argv[3] === '--watch') {
    mix.serve();
}

mix.browserSync({
    proxy: 'localhost:8000'
});
