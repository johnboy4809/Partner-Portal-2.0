const {task, src, dest, watch, series, parallel} = require('gulp');

const sass              = require('gulp-sass');
const browserSync       = require('browser-sync').create();
const rename 		    = require('gulp-rename');
const cssnano	        = require('gulp-cssnano');
const sourcemaps        = require('gulp-sourcemaps');
const uglify            = require('gulp-uglify');
const plumber           = require('gulp-plumber');
const concat            = require('gulp-concat');


var siteName = 'wp_dealers'; // set your siteName here
var userName = 'johnfieldsend'; // set your macOS userName here

var // Public Assets
    assets                 = 'assets/',
    assetsCSS              = assets + 'scss/',
    assetsCSSBuild         = assets + 'css/',
    assetsJS               = assets + 'js-src/',
    assetsJSBuild          = assets + 'js/';

// Compile SASS
function style() {
    return (
        src(assetsCSS + '**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano())
        .pipe(dest(assetsCSSBuild))
        .pipe(sourcemaps.write('./maps'))
        .pipe(browserSync.stream())
    );
}

// Compile JS
function js() {
    return (
        src([assetsJS + '**/*.js', '!' + assetsJS + '*.min.js'])
        .pipe(plumber())
        .pipe(rename({suffix: '.min'}))
        // .pipe(uglify())
        .pipe(dest(assetsJSBuild))
        .pipe(browserSync.stream())
    );
}

// Watcher
function watchTask() {
    browserSync.init({
        proxy: 'http://' + siteName + '.test',
        host: siteName + '.test',
        open: 'external',
        port: 8000,
    });
    watch(assetsCSS + '**/*.scss', style);
    watch([assetsJS + '**/*.js', '!' + assetsJS + '*.min.js'], js);
    watch('./**/*.php').on('change', browserSync.reload);
}

exports.style = style;
exports.js = js;
exports.watch = watchTask;

task('default', series(
    parallel(style,js),watchTask)
);