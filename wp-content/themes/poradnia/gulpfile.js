const gulp = require('gulp');
const sass = require('gulp-sass');
const minify = require('gulp-minify');
const sourcemap = require('gulp-sourcemaps');

const sassFiles = 'scss/**/*.scss';
const cssDest = './';
const jsFiles = 'js/*.js';

function style() {
	return gulp.src(sassFiles)
		.pipe(sourcemap.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sass({ outputStyle: 'compressed' }))
		.pipe(sourcemap.write())
		.pipe(gulp.dest(cssDest));
}

function minifyjs() {
	return gulp.src(jsFiles, { allowEmpty: true })
		.pipe(minify({ noSource: true }))
		.pipe(gulp.dest('./assets/js/'))
}

function watch() {
	gulp.watch(sassFiles, style);
	gulp.watch(jsFiles, minifyjs);
}

exports.style = style;
exports.watch = watch;
exports.default = minifyjs;