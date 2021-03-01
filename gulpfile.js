const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sass = require("gulp-sass");
const minify = require('gulp-minify-css');

gulp.task('js', function () {
  return gulp.src('assets/src/*.js')
    .pipe(concat('script.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/dist/'));
});

gulp.task('css', function () {
  return gulp.src("assets/src/scss/*.scss")
    .pipe(sass({
      outputStyle: "expanded"
    }))
    .pipe(minify())
    .pipe(gulp.dest("assets/dist/"));
});

gulp.task('default', gulp.series('js', 'css'), function (done) {
  done();
});

gulp.task('watch', function () {
  gulp.watch("assets/src/scss/**/*.scss", gulp.series('css'));
  gulp.watch("assets/src/*.js", gulp.series('js'));
});