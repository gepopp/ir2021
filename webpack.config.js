const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin    = require('copy-webpack-plugin');
const ImageminPlugin       = require('imagemin-webpack-plugin').default;
const BrowserSyncPlugin    = require('browser-sync-webpack-plugin');
const PurgeCSS             = require('@fullhuman/postcss-purgecss');
const UglifyJsPlugin       = require("uglifyjs-webpack-plugin");
const isProduction         = 'production' === process.env.NODE_ENV;

// Set the build prefix.
let prefix = isProduction ? '.min' : '';

// Set the PostCSS Plugins.
const post_css_plugins = [
	require('postcss-import'),
	require('tailwindcss')('./tailwind.js'),
	require('postcss-nested'),
	require('postcss-custom-properties'),
	require('autoprefixer')
]

// Add PurgeCSS for production builds.
if ( isProduction ) {
	post_css_plugins.push(require('cssnano'));
	post_css_plugins.push(
		PurgeCSS({
			content: [
				'./*.php',
				'./src/**/*.php',
				'./page-templates/*.php',
				'./banner-templates/*.php',
				'./assets/images/**/*.svg',
				'./assets/scss/whitelist/*.css',
				'./../../mu-plugins/app/src/components/**/*.php',
			],
			css: [
				'./node_modules/tailwindcss/dist/base.css'
			],
			// Use Extractor configuration from Tailwind Docs
			// https://tailwindcss.com/docs/controlling-file-size#setting-up-purge-css-manually
			defaultExtractor: content => {
    				// Capture as liberally as possible, including things like `h-(screen-1.5)`
    				const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || []

    				// Capture classes within other delimiters like .block(class="w-1/2") in Pug
    				const innerMatches = content.match(/[^<>"'`\s.()]*[^<>"'`\s.():]/g) || []

    				return broadMatches.concat(innerMatches)
  			},
			whitelistPatterns: getCSSWhitelistPatterns()
		})
	)
}

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
	optimization: {
		minimizer: [
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: true
			})
		]
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
				test: /\.css$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							importLoaders: 1,
							sourceMap: ! isProduction
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: post_css_plugins,
								sourceMap: true,
								ident: 'postcss',
							},
						},
					}
				],
			},
			{
				test: /\.svg$/,
				use: [
					{
						loader: 'svg-url-loader',
						options: {
							limit: 10000,
						},
					},
				],
			},
		]
	},
	resolve: {
		alias: {
			'@'      : path.resolve('assets'),
			'@images': path.resolve('../images')
		}
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: `[name]${prefix}.css`,
		}),
		new CopyWebpackPlugin({
			patterns: [{
                        	from: './assets/images/',
                        	to: 'images',
				globOptions: {
					ignore: [
						'**/.DS_Store'
					]
				}
			}]
		}),
		new ImageminPlugin({ test: /\.(jpe?g|png|gif|svg)$/i })
	]
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

/**
 * List of RegExp patterns for PurgeCSS
 * @returns {RegExp[]}
 */
function getCSSWhitelistPatterns() {
	return [
		/^home(-.*)?$/,
		/^blog(-.*)?$/,
		/^archive(-.*)?$/,
		/^date(-.*)?$/,
		/^error404(-.*)?$/,
		/^admin-bar(-.*)?$/,
		/^search(-.*)?$/,
		/^nav(-.*)?$/,
		/^wp(-.*)?$/,
		/^screen(-.*)?$/,
		/^navigation(-.*)?$/,
		/^(.*)-template(-.*)?$/,
		/^(.*)?-?single(-.*)?$/,
		/^postid-(.*)?$/,
		/^post-(.*)?$/,
		/^attachmentid-(.*)?$/,
		/^attachment(-.*)?$/,
		/^page(-.*)?$/,
		/^(post-type-)?archive(-.*)?$/,
		/^author(-.*)?$/,
		/^category(-.*)?$/,
		/^tag(-.*)?$/,
		/^menu(-.*)?$/,
		/^tags(-.*)?$/,
		/^tax-(.*)?$/,
		/^term-(.*)?$/,
		/^date-(.*)?$/,
		/^(.*)?-?paged(-.*)?$/,
		/^depth(-.*)?$/,
		/^children(-.*)?$/,
		/^figure(-.*)?$/,
		/^figcaption(-.*)?$/,
		/^ol(-.*)?$/,
		/^lg:(-.*)?$/,
		/^lg:grid-cols-4?$/,
		/^border-(-.*)?$/,
	];
}

module.exports = config
