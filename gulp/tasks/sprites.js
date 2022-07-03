'use strict';

import merge from 'merge-stream';
import { src, dest, series } from 'gulp';
import { $, source, build, config } from '../config';
import 'path';
import replace from 'replace-in-file';

let now      = new Date();
let datetime = now.getFullYear()+''+(("0" + (now.getMonth())).slice(-2))+''+(("0" + (now.getDate())).slice(-2))+''+now.getHours()+''+now.getMinutes()+''+now.getSeconds();

config.svgSprite.mode.symbol.sprite =  '../icons-'+datetime+'.svg';

// SVG sprite
const createSvg = () => src(source.svgSprite)
    .pipe($.plumber())
    .pipe($.changed(source.svgSprite))
    .pipe($.svgSprite(config.svgSprite).on('error', (e) => console.log(e)))
    .pipe($.cheerio(config.cheerio))
    .pipe($.replace('&gt;', '>'))
    .pipe(dest(build.svgSprite))


const replaceSvg = () => {
  replace({
      files: ['frontend/views/**/*.php', 'frontend/widgets/views/**/*.php', 'frontend/assets/js/scripts/**/*.js'],
      from: /\/icons-([0-9]*).svg#/g,
      to: '/icons-'+datetime+'.svg#'
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
  })

  return Promise.resolve();
}

export const svgSprite = series(createSvg, replaceSvg);
export default svgSprite;
