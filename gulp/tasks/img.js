'use strict';

import { src, dest, series } from 'gulp';
import { production, $, source, build, config } from '../config';

// Images
const img = () => src(source.img)
    .pipe($.plumber())
    .pipe($.changed(source.img))
    .pipe($.if(production, $.imagemin(config.imagemin)))
    .pipe(dest(build.img));


export default img;
