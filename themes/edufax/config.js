import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';

const themeName = process.env.THEME_NAME || 'edufax';
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS files
                `themes/${themeName}/assets/css/all.min.css`,
                `themes/${themeName}/assets/css/bootstrap.min.css`,
                `themes/${themeName}/assets/css/animate.css`,
                `themes/${themeName}/assets/css/nice-select.css`,
                `themes/${themeName}/assets/css/slick.css`,
                `themes/${themeName}/assets/css/venobox.min.css`,
                `themes/${themeName}/assets/css/videoPlayer.min.css`,
                `themes/${themeName}/assets/css/spacing.css`,
                `themes/${themeName}/assets/css/style.css`,
                `themes/${themeName}/assets/css/responsive.css`,
                // JS files
                `themes/${themeName}/assets/js/jquery-3.7.0.min.js`,
                `themes/${themeName}/assets/js/bootstrap.bundle.min.js`,
                `themes/${themeName}/assets/js/Font-Awesome.js`,
                `themes/${themeName}/assets/js/jquery.nice-select.min.js`,
                `themes/${themeName}/assets/js/slick.min.js`,
                `themes/${themeName}/assets/js/sticky_sidebar.js`,
                `themes/${themeName}/assets/js/venobox.min.js`,
                `themes/${themeName}/assets/js/wow.min.js`,
                `themes/${themeName}/assets/js/videoPlayer.min.js`,
                `themes/${themeName}/assets/js/main.js`
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: `themes/${themeName}/assets/public`,
        rollupOptions: {
            output: {
                entryFileNames: 'js/[name].js',
                chunkFileNames: 'js/[name].js',
                assetFileNames: ({ name }) => {
                    if (/\.css$/.test(name ?? '')) {
                        return 'css/[name][extname]';
                    }
                    if (/\.js$/.test(name ?? '')) {
                        return 'js/[name][extname]';
                    }
                    return 'assets/[name][extname]';
                }
            }
        }
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, `themes/${themeName}/assets`)
        },
    },
});