import { watch } from 'gulp';
import browserSync from 'browser-sync';
import css from './css';

const reload = cb => {
  browserSync.reload();
  cb();
};

const watcher = () => {
  watch('./wordpress/wp-content/themes/pbf/**/*.php', reload);
  watch('./front/style/**/*.scss', css);
};

export default watcher;
