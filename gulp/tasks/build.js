'use strict';

import { series, parallel } from 'gulp';
import clean from './clean';
import css from './css';
import { vendorScripts, scripts } from './scripts';
import fonts from './fonts';
import img from './img';
import { svgSprite } from './sprites';
import replaceTask from './replace';
import critical from './critical';

// Build
const build = series(clean, parallel(svgSprite, fonts, img, css, critical, vendorScripts, scripts), replaceTask);

export default build;
