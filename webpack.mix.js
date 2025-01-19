const mix = require('laravel-mix');
const modulePath = `${__dirname}/modules/Backend/resources/assets`;
const pluginPath = `${__dirname}/plugins`;
const themePath = `${__dirname}/themes`;

const dotenv = require('dotenv');
dotenv.config();

mix.disableNotifications();
mix.options(
    {
        postCss: [
            require('postcss-discard-comments') (
                {
                    removeAll: true
                }
            )
        ],
        uglify: {
            comments: false
        }
    }
);
mix.sass('resources/sass/app.scss', 'public/css')
   .disableNotifications();
// if (process.env.npm_config_module) {
//     require(`${modulePath}/mix.js`);
//     return;
// }
const selectedModule = process.env.MODULE;

if (selectedModule) {
    try {
        require(`${modulePath}/mix.js`);
        console.log(`Loaded module: ${selectedModule}`);
    } catch (err) {
        console.error(`Failed to load module: ${selectedModule}`);
        console.error(err.message);
    }
}

if (process.env.npm_config_theme) {
    require(`${themePath}/${process.env.npm_config_theme}/assets/mix.js`);
    return;
}

if (process.env.npm_config_plugin) {
    require(`${pluginPath}/${process.env.npm_config_plugin}/assets/mix.js`);
    return;
}

mix.browserSync({
    files: [
        'modules/Backend/Http/Controllers/*.php',
        'modules/Frontend/Http/Controllers/*.php',
        'modules/**/*.blade.php',
        'plugins/**/*.blade.php',
        'public/**/*.js',
        'public/**/*.css',
        'themes/**/*.twig',
        'resources/views/**/*.blade.php',
    ],
    proxy: process.env.APP_URL,
    notify: false,
    snippetOptions: {
        rule: {
            match: /<\/head>/i,
            fn: function (snippet, match) {
                return snippet + match;
            }
        }
    }
});
