import browserSync from 'browser-sync';

const server = () => {
  browserSync({
    proxy: 'http://localhost:8000',
    ghostMode: false,
    logSnippet: false,
    open: false,
    notify: false,
    ui: false,
  });
};

export default server;
