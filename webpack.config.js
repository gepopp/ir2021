const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction         = 'production' === process.env.NODE_ENV;

// Set the build prefix.
let prefix = isProduction ? '.min' : '';
// Add PurgeCSS for production builds.

const config = {
	entry: {
		main: './assets/js/main.js',
		single: './assets/js/single.js',
		category:'./assets/js/category.js',
		author:'./assets/js/author.js',
		login:'./assets/js/login.js',
		profile: './assets/js/profile.js',
		sehen: './assets/js/sehen.js',
		singlevideo: './assets/js/single-video.js',
		diskutieren:  './assets/js/diskutieren.js',
		comments: './assets/js/live_events.js',
	},
	output: {
		filename: `[name]${prefix}.js`,
		path: path.resolve(__dirname, 'dist')
	},
	mode: process.env.NODE_ENV,
	module: {
		rules: [
			{
				test: /\.js$/,
				loader: 'babel-loader',
				options: {
					presets: [
						[
							"@babel/preset-env"
						]
					]
				}
			},
			{
				test: /\.s[ac]ss$/i,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader',
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									require('postcss-import'),
									require('tailwindcss')('tailwind.js'),
									require('postcss-nested'),
									require('autoprefixer'),
								]
							}
						}
					}
				],
			},
			{
				test: /\.svg$/,
				loader: 'svg-inline-loader'
			}
		]
	},
	plugins: [new MiniCssExtractPlugin()]
}

// Fire up a local server if requested
if (process.env.SERVER) {
	config.plugins.push(
		new BrowserSyncPlugin(
			{
				proxy: 'https://ir.test',
				files: [
					'**/*.php',
					'**/*.scss'
				],
				port: 3000,
				notify: false,
			}
		)
	)
}
module.exports = config
