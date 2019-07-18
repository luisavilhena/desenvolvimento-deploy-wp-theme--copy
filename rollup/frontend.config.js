const fs = require('fs')
const path = require('path')

const resolve = require('rollup-plugin-node-resolve')
const commonjs = require('rollup-plugin-commonjs')
const babel = require('rollup-plugin-babel')

const SCRIPTS_DIR = path.join(__dirname, '../src/js')

const isFile = filepath => {
	try {
		return fs.statSync(filepath).isFile()
	} catch (err) {
		return false
	}
}

const scripts = process.env.ROLLUP_SCRIPTS_NAMES ?
	process.env.ROLLUP_SCRIPTS_NAMES.split(',') :
	fs.readdirSync(SCRIPTS_DIR).filter(name => {
		return isFile(path.join(SCRIPTS_DIR, name, 'index.js'))
	})

const scriptConfig = scriptName => ({
	input: `src/js/${scriptName}/index.js`,
	output: {
		name: scriptName.replace(/-/g, ''),
		file: 'index.bundle.js',
		dir: `src/js/${scriptName}`,
		format: 'iife',
	},
	watch: {},
	plugins: [
		babel(),
		resolve(),
		commonjs(),
	]
})

module.exports = scripts.map(scriptConfig)
