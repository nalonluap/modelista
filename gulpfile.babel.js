'use strict';

import { task, series, parallel } from 'gulp';
import dev from './gulp/tasks/dev';
import build from './gulp/tasks/build';
import clean from './gulp/tasks/clean';
import { vendorScripts, scripts } from './gulp/tasks/scripts';
import fonts from './gulp/tasks/fonts';
import img from './gulp/tasks/img';
import { svgSprite } from './gulp/tasks/sprites';
import replaceTask from './gulp/tasks/replace';
import css from './gulp/tasks/css';
import critical from './gulp/tasks/critical';

task('default', dev);
task('dev', dev);
task('build', build);

task('clean', clean);

task('build:js', series(parallel(vendorScripts, scripts), replaceTask));
task('build:css', series(parallel(css, critical), replaceTask));

task('build:sprites', svgSprite);
task('build:img', img);
task('build:fonts', fonts);

task('build:cache', replaceTask);
