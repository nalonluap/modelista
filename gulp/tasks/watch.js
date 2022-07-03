
import { watch, series } from 'gulp';
import browserSync from 'browser-sync';
import css from './css';
import { vendorScripts, scripts } from './scripts';
import fonts from './fonts';
import img from './img';
import { svgSprite } from './sprites';
import { $, source, config } from '../config';
import { reload } from './server';

// Watch
const devWatch = () => {
    browserSync(config.browserSync);
    // CSS
    watch(source.css, series(css, reload));
    // JS
    watch(source.vendorJs, series(vendorScripts, reload));
    watch([...source.js, source.subJs], series(scripts, reload));
    // Sprites
    watch(source.svgSprite, series(svgSprite, reload));
    // Fonts
    watch(source.fonts, series(fonts, reload));
    // Images
    watch(source.fonts, series(img, reload));
};

export default devWatch;
