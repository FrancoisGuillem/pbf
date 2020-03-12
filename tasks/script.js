import { rollup } from 'rollup';
import resolve from '@rollup/plugin-node-resolve';
import babel from 'rollup-plugin-babel';
import browserSync from 'browser-sync';

const options = {
  input: 'front/script/index.js',
  output: {
    file: 'script.js',
    format: 'cjs',
  },
  plugins: [
    resolve(),
    babel({
      exclude: 'node_modules/**', // only transpile our source code
    }),
  ],
};

const script = () => {
  return rollup(options)
    .then(bundle => {
      return bundle.write({
        file: './wordpress/wp-content/themes/pbf/script.js',
        format: 'umd',
        name: 'pbf',
        sourcemap: false,
      });
    })
    .then(() => {
      browserSync.reload();
    });
};

export default script;
