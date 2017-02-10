
'use strict';

const gulp = require('gulp'),
    sass = require('gulp-sass'),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat');



// compile SASS files
gulp.task('sass', () => {
  return gulp.src('./devAssets/sass/styles.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./web/css/'));
});



// compile ES6 to legacy Javascript
gulp.task('compileES6', () => {
  return gulp.src(['./devAssets/Javascript/ES6/*.js'])
      .pipe(babel({presets: ['es2015']}))
      .pipe(concat('es5.js'))
      .pipe(gulp.dest('./devAssets/Javascript/ES6_to_ES5'))
});


// compress all js files into one file
gulp.task('compressAllJS', ['compileES6'], () => {
  return gulp.src(['./devAssets/Javascript/ES6/wrapper/start.js', './devAssets/Javascript/ES6_to_ES5/es5.js', './devAssets/Javascript/ES6/wrapper/end.js'])
      .pipe(concat('app.js'))
      .pipe(gulp.dest('./devAssets/Javascript/ES6_to_ES5/compressed/'));
});


// uglify the compiled ES6
// This gives us a chance to make changes to the compiled ES6 if we need to
gulp.task('uglyJS', ['compressAllJS'], () => {
  return gulp.src('./devAssets/Javascript/ES6_to_ES5/compressed/app.js')
      .pipe(uglify())
      .pipe(gulp.dest('./web/js/'));
});


// watch for sass file changes on save
gulp.task('watch', () => {
  gulp.watch(['./devAssets/sass/**/*.sass', './devAssets/Javascript/ES6/*.js'], ['sass', 'uglyJS']);
});


gulp.task('default', ['sass', 'uglyJS', 'watch']);
