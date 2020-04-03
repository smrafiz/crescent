/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package Crescent
 */

module.exports = {
	// Project options.
	projectName: 'crescent',
	projectURL: 'https://wp-new.test/', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: './assets/scss/theme.scss', // Path to main .scss file.
	styleDestination: './assets/css/', // Path to place the compiled CSS file. Default set to root folder.
	outputStyle: 'expanded', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Vendor options.
	jsVendorSRC: './assets/js/vendor/*.js', // Path to JS vendor folder.
	jsVendorDestination: './assets/js/', // Path to place the compiled JS vendors file.
	jsVendorFile: 'plugins', // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

	// JS Custom options.
	jsCustomSRC: './assets/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: './assets/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: 'theme', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: './assets/images/raw/**/*.{png,jpg,gif}', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: './assets/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Build options
	build: './dist/buildTheme/',
	buildInclude: [
		// include common file types
		'**/*.php',
		'**/*.html',
		'**/*.css',
		'**/*.js',
		'**/*.svg',
		'**/*.ttf',
		'**/*.otf',
		'**/*.eot',
		'**/*.woff',
		'**/*.woff2',
		'**/*.pot',

		// include specific files and folders
		'screenshot.png',

		// exclude files and folders
		'!node_modules/**/*',
		'!dist/**/*',
		'!*.css',
		'!gulp.config.js',
		'!gulpfile.js',
		'!css/*.css',
		'!style.css.map',
		'!assets/js/custom/*',
		'!assets/js/vendor/*',
		'!assets/sass*'
	],
	buildFinalZip: './dist/finalProduct/',

	// Watch files paths.
	watchStyles: './assets/scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
	watchJsVendor: './assets/js/vendor/*.js', // Path to all vendor JS files.
	watchJsCustom: './assets/js/custom/*.js', // Path to all custom JS files.
	watchPhp: './**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: 'crescent', // Your textdomain here.
	translationFile: 'crescent.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'Crescent WP Theme', // Package name.
	bugReport: 'http://aurorawpthemes.com/', // Where can users report bugs.
	lastTranslator: 'S.M. Rafiz <s.m.rafiz@gmail.com>', // Last translator Email ID.
	team: 'Aurora <s.m.rafiz@gmail.com>', // Team's Email ID.

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
	BROWSERS_LIST: [
		'last 20 version',
		'> 1%',
		'ie >= 9',
		'last 6 Android versions',
		'last 20 ChromeAndroid versions',
		'last 20 Chrome versions',
		'last 20 Firefox versions',
		'last 20 Safari versions',
		'last 20 iOS versions',
		'last 20 Edge versions',
		'last 20 Opera versions'
	]
};
