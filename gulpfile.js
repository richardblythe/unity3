//process.env.DISABLE_NOTIFIER = true; // Uncomment to disable all Gulp notifications.

/**
 * Corporate Pro.
 *
 * This file adds gulp tasks to the Corporate Pro theme.
 *
 * @author Seo themes
 */

// Require our dependencies.
var args         = require('yargs').argv,
	autoprefixer = require('autoprefixer'),
	browsersync  = require('browser-sync'),
	bump         = require('gulp-bump'),
	gulp         = require('gulp'),
	cache        = require('gulp-cached'),
	cleancss     = require('gulp-clean-css'),
	imagemin     = require('gulp-imagemin'),
	notify       = require('gulp-notify'),
	pixrem       = require('gulp-pixrem'),
	plumber      = require('gulp-plumber'),
	postcss      = require('gulp-postcss'),
	rename       = require('gulp-rename'),
	sass         = require('gulp-sass'),
	sourcemaps   = require('gulp-sourcemaps'),
	uglify       = require('gulp-uglify'),
	merge 		 = require('merge-stream');

// Set assets paths.
var paths = {
	all:     ['./**/*', '!./node_modules/', '!./node_modules/**', '!./screenshot.png', '!./assets/images/**'],
	concat:  ['assets/scripts/menus.js', 'assets/scripts/superfish.js'],
	images:  ['assets/images/*', '!assets/images/*.svg'],
	php:     ['./*.php', './**/*.php', './**/**/*.php'],
	scripts: ['assets/scripts/*.js', '!assets/scripts/min/'],
	styles:  ['assets/styles/admin/', 'assets/styles/front/']
};


/**
 * Compile Sass.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task('styles', function () {

	var processors = [
		autoprefixer({
			browsers: ['last 5 versions']
		})
	];

	var sassOptions = {
		errLogToConsole: true,
		outputStyle: 'expanded'
	};

	var tasks = paths.styles.map(function(folder) {
		return gulp.src(folder + '*.scss')
			.pipe(sourcemaps.init())
			.pipe(sass({
				outputStyle: 'expanded',
				errLogToConsole: true
				}).on('error', sass.logError)
			)
			.pipe(postcss(processors))
			.pipe(sourcemaps.write())
			.pipe(gulp.dest(folder))
			//****************************
			//** MIN VERSION
			.pipe(sourcemaps.init())
			.pipe(sass({
					outputStyle: 'compressed',
					errLogToConsole: true
				}).on('error', sass.logError)
			)
			.pipe(cleancss({
				keepSpecialComments: '*',
				spaceAfterClosingBrace: true
			}))
			.pipe(rename({ suffix: '.min' }))
			.pipe(sourcemaps.write())
			.pipe(gulp.dest(folder));
	});
});

/**
 * Minify javascript files.
 *
 * https://www.npmjs.com/package/gulp-uglify
 */
gulp.task('scripts', function () {

	gulp.src(paths.scripts)

		// Notify on error.
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Cache files to avoid processing files that haven't changed.
		.pipe(cache('js'))

		// Add .min suffix.
		.pipe(rename({
			suffix: '.min'
		}))

		// Minify.
		.pipe(uglify())

		// Output the processed js to this directory.
		.pipe(gulp.dest('assets/scripts/min'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Notify on successful compile.
		.pipe(notify("Minified: <%= file.relative %>"));

});

/**
 * Optimize images.
 *
 * https://www.npmjs.com/package/gulp-imagemin
 */
gulp.task('images', function () {

	return gulp.src(paths.images)

		// Notify on error.
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Cache files to avoid processing files that haven't changed.
		.pipe(cache('images'))

		// Optimize images.
		.pipe(imagemin({
			progressive: true
		}))

		// Output the optimized images to this directory.
		.pipe(gulp.dest('assets/images'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Notify on successful compile.
		.pipe(notify("Optimized: <%= file.relative %>"));

});

gulp.task('watch', function () {

	// Run tasks when files change.
	gulp.watch(paths.styles, ['styles']);
	gulp.watch(paths.scripts, ['scripts']);
	gulp.watch(paths.images, ['images']);
	gulp.watch(paths.php).on('change', browsersync.reload);

});

/**
 * Bump version.
 *
 * https://www.npmjs.com/package/gulp-bump
 */
gulp.task('bump', function () {

	var kind = 'patch';

	if (args.major) {
		var kind = 'major';
	} else if (args.minor) {
		var kind = 'minor';
	}

	gulp.src(['./package.json'])

		.pipe(bump({
			type: kind,
			version: args.to
		}))
		.pipe(gulp.dest('./'));

	gulp.src(['./unity3.php'])
		.pipe(bump({
			key: "Version:",
			type: kind,
			version: args.to
		}))
		.pipe(gulp.dest('./'));

});


/**
 * Create default task.
 */
gulp.task('default', ['watch'], function () {

});

