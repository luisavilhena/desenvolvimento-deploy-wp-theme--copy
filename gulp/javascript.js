const gulp = require('gulp')
const { exec } = require('child_process')

const { parallel } = gulp

const compileJSAdmin = () => {
	return new Promise((resolve, reject) => {
		exec('npm run bundle-admin', { env: process.env })
			.on('error', reject)
			.on('exit', code => {
				if (code === 0) {
					resolve()
				} else {
					reject(new Error(`compile:js exited with ${code}`))
				}
			})
	})
}

const compileJSFrontend = () => {
	return new Promise((resolve, reject) => {
		exec('npm run bundle-frontend', { env: process.env })
			.on('error', reject)
			.on('exit', code => {
				if (code === 0) {
					resolve()
				} else {
					reject(new Error(`compile:js exited with ${code}`))
				}
			})
	})
}

gulp.task('compile:js', parallel(compileJSFrontend, compileJSAdmin))

exports.compileJSAdmin = compileJSAdmin
exports.compileJSFrontend = compileJSFrontend
