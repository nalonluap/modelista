'use strict';

import del from 'del';
import { build } from '../config';

// Clean
// const clean = done => del([`${ build.css }`, `${ build.scripts }`, `${ build.fonts }`, `${ build.img }`], done);
const clean = done => del([`${ build.css }`, `${ build.scripts }`], done);

export default clean;
