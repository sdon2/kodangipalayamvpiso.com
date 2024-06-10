const mix = require('laravel-mix');
require('laravel-mix-serve');

mix.disableNotifications();

mix.options({
    processCssUrls: false
});

mix.js('resources/js/app.js', 'public/assets/js')
    .postCss('resources/css/app.css', 'public/assets/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .sass('resources/sass/style.scss', 'public/assets/css/')
    .version();

if (process.argv.length >= 4 && process.argv[3] === '--watch') {
    mix.serve();
}

mix.browserSync({
    proxy: 'localhost:8000'
});
