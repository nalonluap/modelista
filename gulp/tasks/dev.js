'use strict';

import { series, parallel } from 'gulp';
import clean from './clean';
import css from './css';
import { vendorScripts, scripts } from './scripts';
import fonts from './fonts';
import img from './img';
import { svgSprite } from './sprites';
import replaceTask from './replace';
import devWatch from './watch';
import critical from './critical';

// Dev
// const dev = series(clean, parallel(svgSprite, fonts, img, css, critical, vendorScripts, scripts), replaceTask, devWatch);
const dev = series(clean, parallel(css, critical, vendorScripts, scripts), replaceTask, devWatch);

export default dev;
