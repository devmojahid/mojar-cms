const mix = require('laravel-mix');
const modulePath = `${__dirname}/modules/Backend/resources/assets`;
const pluginPath = `${__dirname}/plugins`;
const themePath = `${__dirname}/themes`;

const dotenv = require('dotenv');
dotenv.config();

mix.disableNotifications();
mix.options({
    postCss: [
        require('postcss-discard-comments')({
            removeAll: true
        })
    ],
    uglify: {
        comments: false
    }
});

// Base application styles
mix.sass('resources/sass/app.scss', 'public/css')
   .disableNotifications();

const selectedModule = process.env.MODULE;
const selectedTheme = process.env.THEME;
const selectedPlugin = process.env.PLUGIN;

// Handle module compilation
if (selectedModule) {
    try {
        require(`${modulePath}/mix.js`);
    } catch (err) {
        console.error(`Failed to load module: ${selectedModule}`);
    }
}

// Handle theme compilation
if (selectedTheme) {
    try {
        require(`${themePath}/${selectedTheme}/assets/mix.js`);
    } catch (err) {
        console.error(`Failed to load theme: ${selectedTheme}`);
    }
}

// Handle plugin compilation
if (selectedPlugin) {
    try {
        require(`${pluginPath}/${selectedPlugin}/assets/mix.js`);
        // Add BrowserSync after plugin compilation
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
                `plugins/${selectedPlugin}/**/*.php`,
                `plugins/${selectedPlugin}/**/*.js`,
                `plugins/${selectedPlugin}/**/*.css`
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
    } catch (err) {
        console.error(`Failed to load plugin: ${selectedPlugin}`);
        console.error(err);
    }
} else {
    // If no plugin is selected, add BrowserSync for general development
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
}
