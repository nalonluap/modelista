'use strict';

import gulpLoadPlugins from 'gulp-load-plugins';
import moduleImporter from 'sass-module-importer';
import { argv } from 'yargs';

const { PORT, OPEN } = process.env;
// export const production = !!argv.production || !!argv.prod;
export const nominify = !!argv.nominify;
export const $ = gulpLoadPlugins();

export const production = true;
export const criticalCss = true;

export const source = {
    css: './frontend/assets/css/**/*.scss',
    vendorCss: './frontend/assets/css/vendor.scss',
    mainCss: './frontend/assets/css/main.scss',
    vendorJs: ['./frontend/assets/js/vendor.js'],
    js: ['./frontend/assets/js/main.js', '!./frontend/assets/js/vendor.js'],
    subJs: './frontend/assets/js/scripts/**/*.js',
    fonts: './frontend/assets/fonts/**/*.{eot,ttf,woff,woff2,svg}',
    img: './frontend/assets/img/**/*.{jpg,gif,svg,png}',
    src: './frontend',
    svgSprite: './frontend/assets/svg_icons/**/*.svg',
};

export const build = {
    dest: './frontend/web',
    css: './frontend/web/css',
    scripts: './frontend/web/js',
    svgSprite: './frontend/web',
    img: './frontend/web/img',
    fonts: './frontend/web/fonts',
};

export const config = {
    browserSync: {
        port: PORT || 3000,
        open: !!OPEN,
        notify: false,
        reloadOnRestart: true,
        server: {
            baseDir: build.dest,
            directory: true
        }
    },

    autoprefixer: {
        cascade: false
    },

    sass: {
        importer: moduleImporter(),
        outputStyle: 'compact'
    },

    include: {
        extensions: 'js',
        hardFail: true,
        includePaths: [
            `${ __dirname }/../node_modules`,
            `${ __dirname }/../src/js`
        ]
    },

    babel: {
        presets: ['env']
    },

    imagemin: {
        interlaced: true,
        progressive: true,
        optimizationLevel: 5,
        svgoPlugins: [{
                removeViewBox: false
            }
        ]
    },

    svgSprite: {
        mode: {
            symbol: {
                inline: true,
                sprite: '../icons.svg'
            }
        },
        transform: [
                {
                    svgo: {
                        plugins: [
                            {
                                removeViewBox: false
                            },
                            {
                                removeUselessStrokeAndFill: false
                            },
                            {
                                cleanupIDs: false
                            },
                            {
                                mergePaths: false
                            },
                            {
                                removeUnknownsAndDefaults: false
                            }
                        ]
                    }
                }
            ],
        svg: {
            xmlDeclaration: false,
            doctypeDeclaration: false,
            namespaceIDs: false
        }
    },

    // cheerio: {
    //     run: function($) {
    //         // Опционально, нужно не всегда
    //         // $('[fill]').removeAttr('fill');
    //         // $('[fill-rule]').removeAttr('fill-rule');
    //         // $('[style]').removeAttr('style');
    //     }
    // }
};
