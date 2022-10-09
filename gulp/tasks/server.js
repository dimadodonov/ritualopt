import browserSync from 'browser-sync';

import { config } from '../config.js';

const server = (callback) => {
    browserSync.create().init({
        files: [
            `${config.dest.html}/*.html`,
            `${config.dest.css}/*.css`,
            `${config.dest.js}/*.js`,
            {
                match: [`${config.dest.images}/**/*`, `${config.php}`],
                fn() {
                    this.reload();
                },
            },
        ],
        proxy: 'ritualopt.loc',
        notify: false,
        browser: 'Firefox',
    });

    callback();
};

export default server;
