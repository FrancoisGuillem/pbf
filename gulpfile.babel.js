import { parallel, series } from 'gulp';
import css from './tasks/css';
import watch from './tasks/watch';
import browserSync from './tasks/browser-sync';

export { css };

export default series(css, parallel(browserSync, watch));
