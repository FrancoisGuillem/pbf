import { parallel, series } from 'gulp';
import css from './tasks/style';
import script from './tasks/script';
import watch from './tasks/watch';
import browserSync from './tasks/browser-sync';

export { css, script };

export default series(parallel(css, script), parallel(browserSync, watch));
