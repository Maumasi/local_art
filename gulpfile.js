
'use strict';

let gulp = require('gulp'),
    sass = require('gulp-sass');


// compile SASS files
gulp.task('sass', () => {
  return gulp.src('./devAssets/sass/styles.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./web/css/'));
});


// watch for sass file changes on save
gulp.task('watch', () => {
  gulp.watch('./devAssets/sass/**/*.sass', ['sass']);
});



gulp.task('default', ['sass', 'watch']);
