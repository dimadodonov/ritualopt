import gulp from 'gulp';

import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass); // https://github.com/dlmanning/gulp-sass

import plumber from 'gulp-plumber';
import autoprefixer from 'gulp-autoprefixer';
import gcmq from 'gulp-group-css-media-queries';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import gulpif from 'gulp-if';
import smartGrid from 'smart-grid';
import importFresh from 'import-fresh'; // Посмотреть и если что удалить, не могу через него сделать импорт файла
import sassGlob from 'gulp-sass-glob';
import notify from 'gulp-notify';

import { config } from '../config.js';

const smartGridConfig = {
    filename: '_smart-grid-build',
    outputStyle: 'scss',
    columns: 12,
    offset: '20px',
    mobileFirst: false,
    container: {
        maxWidth: '1200px',
        fields: '20px',
    },
    breakPoints: {
        hd: {
            width: '1400px' /* -> @media (max-width: 1100px) */,
        },
        lg: {
            width: '1366px' /* -> @media (max-width: 1100px) */,
        },
        md: {
            width: '1024px',
            // fields: '15px' /* set fields only if you want to change container.fields */
        },
        sm: {
            width: '768px',
        },
        xs: {
            width: '480px',
        },
        i8: {
            width: '414px',
        },
        i7: {
            width: '375px',
        },
        i5: {
            width: '320px',
        },
    },
};

const sassBuild = () =>
    gulp
        .src(`${config.src.sass}/app.scss`, { sourcemaps: config.isDev })
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: 'SCSS',
                        message: '<%= error.message %>',
                    })(err);
                },
            })
        )
        .pipe(sassGlob())
        .pipe(
            sass({
                includePaths: ['./node_modules'],
            }).on('error', sass.logError)
        )
        .pipe(gulpif(config.isProd, gcmq()))
        .pipe(gulpif(config.isProd, autoprefixer()))
        .pipe(gulpif(config.isProd, cleanCSS({ level: 2 })))
        .pipe(
            rename({
                suffix: '.min',
            })
        )
        .pipe(gulp.dest(config.dest.css, { sourcemaps: config.isDev }));

const smartGridBuild = (callback) => {
    // const smartGridConfig = `./${SMART_GRID_CONFIG_NAME}`;
    smartGrid(`${config.src.sass}/generated`, smartGridConfig);

    callback();
};

// export const stylesBuild = gulp.series(smartGridBuild, sassBuild);
export const stylesBuild = sassBuild;

export const stylesWatch = () => {
    gulp.watch(`${config.src.sass}/**/*.scss`, sassBuild);
    // gulp.watch(`./${SMART_GRID_CONFIG_NAME}`, smartGridBuild);
};
