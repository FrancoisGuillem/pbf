import { watch } from 'gulp';
import browserSync from 'browser-sync';
import style from './style';
import script from './script';

const reload = cb => {
  browserSync.reload();
  cb();
};

const watcher = () => {
  watch('./wordpress/wp-content/themes/pbf/**/*.php', reload);
  watch('./front/style/**/*.scss', style);
  watch('./front/script/**/*.js', script);
};

export default watcher;
