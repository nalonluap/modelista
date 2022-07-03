'use strict';

import { src, dest } from 'gulp';
import { production, nominify, $, source, build, config } from '../config';
import cssnano from 'cssnano';
import rename from 'gulp-rename';

let criticalSplit = require('postcss-critical-split');

const plugins = [
    criticalSplit(),
    cssnano(),
]

// CRITICAL CSS
export const critical = () => src([source.mainCss])
    .pipe($.plumber())
    .pipe($.changed(source.mainCss))
    .pipe($.if(!production, $.sourcemaps.init()))
    .pipe($.sassGlob())
    .pipe($.sass(config.sass).on('error', $.sass.logError))
    .pipe($.autoprefixer(config.autoprefixer))
    .pipe($.if(production, $.postcss(plugins)))
    .pipe($.groupCssMediaQueries())
    .pipe($.if(production && !nominify, $.sass({ outputStyle: 'compressed' }).on('error', $.sass.logError)))
    .pipe($.if(!production, $.sourcemaps.write('.')))
    .pipe(rename(function (path) {
      path.basename += ".critical";
    }))
    .pipe(dest(build.css))

export default critical;



// 'use strict';
//
// import { src, dest } from 'gulp';
// import { production, nominify, $, source, build, config } from '../config';
// import cssnano from 'cssnano';
//
// var postcss = require('postcss'),
// 	criticalSplit = require('postcss-critical-split'),
// 	css = '',
// 	fs = require('fs');
//
//
//   function saveCssFile(filepath, cssRoot) {
//       console.log('saving');
//       fs.writeFileSync(filepath, cssRoot.css);
//
//   }
//
//   css = fs.readFileSync(build.css + '/main.css');
//
// // critical css
// const critical = () => postcss(
//     criticalSplit({
//       'output': criticalSplit.output_types.CRITICAL_CSS
//     })
//   )
//   .process(css, {
//       'from': build.css + '/main.css',
//       'to': './frontend/web/main.critical.css'
//   })
//   .then(function(result) {
//       saveCssFile('./frontend/web/main.critical.css', result);
//       console.log('file saved');
//   })
//
// export default critical;
