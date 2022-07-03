'use strict';

import { src, dest, series } from 'gulp';
import { production, nominify, $, source, build, config } from '../config';

// Fonts
const fonts = () => src(source.fonts)
    .pipe($.plumber())
    .pipe($.changed(source.fonts))
    .pipe(dest(build.fonts));


export default fonts;
