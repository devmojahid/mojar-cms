const mix = require('laravel-mix');

// Set this to true for development mode, false for production
const isDev = true;

// Define paths based on environment
const cssOutputPath = isDev 
    ? 'public/jw-styles/themes/edufax/assets/css/main.css'
    : 'themes/edufax/assets/public/css/main.css';

const jsOutputPath = isDev
    ? 'public/jw-styles/themes/edufax/assets/js/main.js'
    : 'themes/edufax/assets/public/js/main.js';

// CSS processing
mix.styles([
    'themes/edufax/assets/css/all.min.css',
    'themes/edufax/assets/css/bootstrap.min.css',
    'themes/edufax/assets/css/animate.css',
    'themes/edufax/assets/css/nice-select.css',
    'themes/edufax/assets/css/slick.css',
    'themes/edufax/assets/css/venobox.min.css',
    'themes/edufax/assets/css/videoPlayer.min.css',
    'themes/edufax/assets/css/spacing.css',
    'themes/edufax/assets/css/style.css',
    'themes/edufax/assets/css/responsive.css'
], cssOutputPath);

// JS processing
mix.combine([
    'themes/edufax/assets/js/jquery-3.7.0.min.js',
    'themes/edufax/assets/js/bootstrap.bundle.min.js',
    'themes/edufax/assets/js/Font-Awesome.js',
    'themes/edufax/assets/js/jquery.nice-select.min.js',
    'themes/edufax/assets/js/slick.min.js',
    'themes/edufax/assets/js/sticky_sidebar.js',
    'themes/edufax/assets/js/venobox.min.js',
    'themes/edufax/assets/js/wow.min.js',
    'themes/edufax/assets/js/videoPlayer.min.js',
    'themes/edufax/assets/js/main.js',
    'themes/edufax/assets/js/custom/post_filter.js'
], jsOutputPath);

// Optional: Log the current environment
console.log(`Running in ${isDev ? 'DEVELOPMENT' : 'PRODUCTION'} mode`);