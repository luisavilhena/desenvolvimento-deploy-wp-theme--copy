const gulp = require('gulp')
const less = require('gulp-less')
const autoprefixer = require('gulp-autoprefixer')
const notify = require('gulp-notify')
const plumber = require('gulp-plumber')
const livereload = require('gulp-livereload')
const cleanCSS = require('gulp-clean-css')

const compileLess = () => {
  return gulp.src('src/less/style.less')
    .pipe(plumber({
      errorHandler: (err) => {
        notify.onError('LESS Compilation error')(err)
        console.warn(err.message)
      }
    }))
    .pipe(less())
    // .pipe(cleanCSS({
    //   level: 2
    // }))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('src'))
    .pipe(livereload())
}
gulp.task('compile:less', compileLess)

exports.compileLess = compileLess
