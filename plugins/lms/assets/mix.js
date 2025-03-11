const mix = require('laravel-mix');
const path = require('path');

console.log("Plugin Path: ", __dirname);

const baseAsset = path.resolve(__dirname, '');
const baseStyles = baseAsset + '/styles';
// const basePublish = baseAsset + '/public';

// dev mode
const localAsset = path.resolve(__dirname, '..', '..', '..', '..','mojar-cms', 'public', 'jw-styles', 'plugins', 'mojahid', 'lms', 'assets');

let basePublish = localAsset;


mix.styles(
    [
        baseAsset + '/css/bootstrap.min.css',
        baseAsset + '/css/lms.css',
    ],
    `${basePublish}/css/lms.min.css`
);

mix.combine(
    [
        baseAsset + '/js/bootstrap.min.js',
        baseAsset + '/js/lms.js',
    ],
    `${basePublish}/js/lms.min.js`
);