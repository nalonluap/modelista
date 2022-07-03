'use strict';

import { src, dest } from 'gulp';
import { production, criticalCss, nominify, $, source, build, config } from '../config';
import cssnano from 'cssnano';

let criticalSplit = require('postcss-critical-split');
if (criticalCss){
    var mode = 'rest';
}else{
    var mode = 'input';
}
const plugins = [
    criticalSplit({
        'output': mode // удалим весь critical код. он обработается в critical.js
    }),
    cssnano(),
]


// CSS
const css = () => src([source.css, source.vendorCss])
    .pipe($.plumber())
    .pipe($.changed(source.css))
    .pipe($.if(!production, $.sourcemaps.init()))
    .pipe($.sassGlob())
    .pipe($.sass(config.sass).on('error', $.sass.logError))
    .pipe($.autoprefixer(config.autoprefixer))
    .pipe($.if(production, $.postcss(plugins)))
    .pipe($.groupCssMediaQueries())
    .pipe($.if(production && !nominify, $.sass({ outputStyle: 'compressed' }).on('error', $.sass.logError)))
    .pipe($.if(!production, $.sourcemaps.write('.')))
    .pipe(dest(build.css))

export default css;