const fs = require('fs')
const path = require('path')

const resolve = require('rollup-plugin-node-resolve')
const commonjs = require('rollup-plugin-commonjs')
const babel = require('rollup-plugin-babel')
const {string} = require('rollup-plugin-string')
const json = require('rollup-plugin-json')

const SCRIPTS_BASE_DIR = 'src/blocks/client-side'
const SCRIPTS_DIR = path.join(__dirname, '../src/blocks/client-side')

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
	input: `${SCRIPTS_BASE_DIR}/${scriptName}/index.js`,
	output: {
		name: scriptName.replace(/-/g, ''),
		file: 'index.bundle.js',
		dir: `${SCRIPTS_BASE_DIR}/${scriptName}`,
		format: 'iife',
	},
	watch: {},
	plugins: [
		babel(),
		string({
			include: ['src/blocks/client-side/**/*.css'],
		}),
		json({
			exclude: ['node_modules/**']
		}),
		resolve(),
		commonjs(),
	]
})

module.exports = scripts.map(scriptConfig)
