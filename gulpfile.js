
'use strict';

let gulp = require('gulp'),
    sass = require('gulp-sass');


gulp.task('sass', () => {
  return gulp.src('./devAssets/sass/styles.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./web/css/'));
});

gulp.task('default', () => {
  console.log('testing gulp');
});
