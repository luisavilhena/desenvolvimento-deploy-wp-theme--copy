const gulp = require('gulp')
const replace = require('gulp-replace')
const gulpIf = require('gulp-if')
const uglify = require('gulp-uglify')

const {
	compileJSFrontend,
	compileJSAdmin,
} = require('./javascript')

const {
	compileLess
} = require('./less')

const {
	parallel,
	series
} = gulp

const isCompiledBundle = file => {
	return /\.bundle\.js$/.test(file.path)
}

const distribute = () => {
	const WORDPRESS_FILES = [
		'src/**/*.php',
		'src/screenshot.png',
		'src/style.css',
	]

	const CONFIG_FILES = [
		'src/config.json',
	]

	const SCRIPTS = [
		'src/js/**/*.bundle.js',
		'src/blocks/client-side/**/*.bundle.js',
	]

	const RESOURCES = [
		'src/resources/**/*',
	]

	const VENDOR = [
		'src/vendor/**/*'
	]

	const IGNORED_DEVELOPMENT_FILES = [
		'!src/less',
		'!src/less/**/*',
		'!src/inc/development',
		'!src/inc/development/**/*',
	]

	return gulp.src([
			...WORDPRESS_FILES,
			...CONFIG_FILES,
			...SCRIPTS,
			...RESOURCES,
			...VENDOR,
			...IGNORED_DEVELOPMENT_FILES,
		], { base: 'src' })
		// Replaces the loading of development files
		.pipe(replace("require_once('inc/development/load.php');", ''))

		// uglify compiled bundles
		.pipe(gulpIf(isCompiledBundle, uglify()))
		.pipe(gulp.dest('dist'))
}

gulp.task('distribute', series(
	parallel(
		compileLess,
		compileJSAdmin,
		compileJSFrontend
	),
	distribute
))
