'use strict';

import { src, dest, parallel } from 'gulp';
import { production, nominify, $, source, build, config, criticalCss } from '../config';
import replace from 'replace-in-file';
import hashFile from 'hash-file';
import fs from 'fs';

const replaceTask = () => {
  var hash1 = hashFile.sync(build.css+'/vendor.css');
  replace({
      files: 'frontend/views/layouts/main.php',
      from: /'@web\/css\/vendor\.css\?hash=[a-z0-9]{40}'/g,
      to: "'@web/css/vendor.css?hash="+hash1+"'"
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
      results[0]['file'] = '/frontend/web/css/vendor.css';
      console.log('Replacement results:', results);
  })

  var hash2 = hashFile.sync(build.css+'/main.css');
  replace({
      files: 'frontend/views/layouts/main.php',
      from: /'@web\/css\/main\.css\?hash=[a-z0-9]{40}'/g,
      to: "'@web/css/main.css?hash="+hash2+"'"
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
      results[0]['file'] = '/frontend/web/css/main.css';
      console.log('Replacement results:', results);
  })

  var hash3 = hashFile.sync(build.scripts+'/vendor.js');
  replace({
      files: 'frontend/views/layouts/main.php',
      from: /'@web\/js\/vendor\.js\?hash=[a-z0-9]{40}'/g,
      to: "'@web/js/vendor.js?hash="+hash3+"'"
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
      results[0]['file'] = '/frontend/web/js/vendor.js';
      console.log('Replacement results:', results);
  })

  var hash4 = hashFile.sync(build.scripts+'/main.js');
  replace({
      files: 'frontend/views/layouts/main.php',
      from: /'@web\/js\/main\.js\?hash=[a-z0-9]{40}'/g,
      to: "'@web/js/main.js?hash="+hash4+"'"
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
      results[0]['file'] = '/frontend/web/js/main.js';
      console.log('Replacement results:', results);
  })


  /*var hash5 = hashFile.sync(build.css+'/main-critical.css');
    replace({
        files: 'frontend/views/layouts/main.php',
        from: /'@web\/css\/main\.critical\.css\?hash=[a-z0-9]{40}'/g,
        to: "'@web/css/main.critical.css?hash="+hash5+"'"
      }, (error, results) => {
        if (error) {return console.error('Error occurred:', error);}
        results[0]['file'] = '/frontend/web/css/main.critical.css';
        console.log('Replacement results:', results);
    })*/

  // Встроим crititcal css в html код страницы
    if (criticalCss){
        var replaceCritical = fs.readFileSync('./frontend/web/css/main.critical.css', 'utf8').trim();
    }else{
        var replaceCritical = '';
    }

  replace({
      files: 'frontend/views/layouts/main.php',
      from: /<!-- START INLINE CRITICAL -->([\s\S]*)<!-- END INLINE CRITICAL -->/gmui,
      to: '<!-- START INLINE CRITICAL --><style>\n' + replaceCritical + '\n</style><!-- END INLINE CRITICAL -->'
    }, (error, results) => {
      if (error) {return console.error('Error occurred:', error);}
      results[0]['file'] = '/frontend/web/css/main.critical.css';
      console.log('Replacement results:', results);
  })

  return Promise.resolve();
}

export default replaceTask;
