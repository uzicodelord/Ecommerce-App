const mix = require('laravel-mix');

mix.scripts([
    'public/home/js/jquery-3.4.1.min.js',
    'public/home/js/popper.min.js',
    'public/home/js/bootstrap.js',
    'public/home/js/custom.js',
], 'public/js/app.js');

mix.styles([
    'public/home/css/bootstrap.css',
    'public/home/css/font-awesome.min.css',
    'public/home/css/responsive.css',
    'public/home/css/style.scss'
], 'public/css/app.css');
