const gulp = require('gulp')
const livereload = require('gulp-livereload')

const { series, parallel } = gulp

const {
  compileLess
} = require('./less')

const {
  compileJSFrontend,
  compileJSAdmin
} = require('./javascript')

const develop = () => {
  gulp.watch(['src/**/*.less'], compileLess)
  // gulp.watch(['src/js/**/*.js', '!**/*.bundle.js'], compileJSFrontend)
  // gulp.watch(['src/blocks/client-side/**/*.js', '!**/*.bundle.js'], compileJSAdmin)
  // gulp.watch(['src/**/*.bundle.js'], livereload.reload)
  livereload.listen(9000)
}

gulp.task('develop', series(parallel(compileLess, compileJSFrontend, compileJSAdmin), develop))
