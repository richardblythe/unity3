// Sass configuration
var args         = require('yargs').argv,
    gulp         = require('gulp'),
	autoprefixer = require('autoprefixer'),
	// browsersync  = require('browser-sync'),
	// bump         = require('gulp-bump'),
	// changecase   = require('change-case'),
	// del          = require('del'),
	//mqpacker     = require('css-mqpacker'),
	// fs           = require('fs'),
	// beautify     = require('gulp-cssbeautify'),
	// cache        = require('gulp-cached'),
	changed 	 = require('gulp-changed'),
    cleancss     = require('gulp-clean-css'),
	csscomb      = require('gulp-csscomb'),
	// cssnano      = require('gulp-cssnano'),
	filter       = require('gulp-filter'),
	// imagemin     = require('gulp-imagemin'),
	notify       = require('gulp-notify'),
	pixrem       = require('gulp-pixrem'),
	plumber      = require('gulp-plumber'),
	postcss      = require('gulp-postcss'),
    rename       = require('gulp-rename'),
	//replace      = require('gulp-replace'),
	sass         = require('gulp-sass'),
	// sort         = require('gulp-sort'),
	sourcemaps   = require('gulp-sourcemaps'),
	// uglify       = require('gulp-uglify'),
	// wpPot        = require('gulp-wp-pot'),
	// zip          = require('gulp-zip'),
	focus        = require('postcss-focus');

// Set assets paths.
// var paths = {
// 	all:     ['./**/*', '!./node_modules/', '!./node_modules/**', '!./screenshot.png', '!./assets/images/**'],
// 	concat:  ['assets/scripts/menus.js', 'assets/scripts/superfish.js'],
// 	images:  ['assets/images/*', '!assets/images/*.svg'],
// 	php:     ['./*.php', './**/*.php', './**/**/*.php'],
// 	scripts: ['assets/scripts/*.js', '!assets/scripts/min/'],
// 	styles:  'assets/styles/*.scss',
// 	styleDest : 'assets/styles/'
// };

var paths = {
    styles: {
        src: ['assets/sass/unity3.scss', 'assets/sass/editor/unity3-editor.scss'],
        watch: ['assets/**/*.scss'],
        dest: 'assets/css/'
    }
};



/**
 * Compile Sass.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
var styles_compile = function (cb) {

	return gulp.src(paths.styles.src)

		// Notify on error
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Filter on the changed files...
		.pipe(changed(paths.styles.dest))

		// Source maps init
		.pipe(sourcemaps.init())

		// Process sass
		.pipe(sass())

		// Pixel fallbacks for rem units.
		.pipe(pixrem())

		// Parse with PostCSS plugins.
		.pipe(postcss([
			autoprefixer({
				browsers: 'last 2 versions'
			}),
			focus()
		]))

		// Output the un-minified css
		.pipe(gulp.dest(paths.styles.dest))

		// Minify the css
		.pipe(cleancss())
		
		.pipe(rename({suffix: '.min'}))

		// Write source map.
		.pipe(sourcemaps.write('./'))


		// Output minified css to theme directory.
		.pipe(gulp.dest(paths.styles.dest))

		// // Inject changes via browsersync.
		// .pipe(browsersync.reload({
		// 	stream: true
		// }))

		// Filtering stream to only css files.
		.pipe(filter('**/*.css'))

		// Notify on successful compile (uncomment for notifications).
		.pipe(notify("Compiled: <%= file.relative %>"));
		
}



/**
 * Process tasks and reload browsers on file changes.
 *
 * https://www.npmjs.com/package/browser-sync
 *
 * If you are not using a self-signed certificate, use the below config:
 *
 * browsersync( {
 *	    proxy: 'corporate-pro.dev',
 *	    notify: false,
 *	    open: false,
 * } );
 */
gulp.task('default', function () {

	// // HTTPS (optional).
	// browsersync({
	// 	proxy: 'https://corporate.test',
	// 	port: 8000,
	// 	notify: false,
	// 	open: false,
	// 	https: {
	// 		"key": "/Users/seothemes/.valet/Certificates/corporate.test.key",
	// 		"cert": "/Users/seothemes/.valet/Certificates/corporate.test.crt"
	// 	}
	// });

	// Run tasks when files change.
	gulp.watch(paths.styles.watch, styles_compile);
	// gulp.watch(paths.scripts, ['scripts']);
	// gulp.watch(paths.images, ['images']);
	// gulp.watch(paths.php).on('change', browsersync.reload);

});