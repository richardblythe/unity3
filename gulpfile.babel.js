//Gulp file built from the tutorial:
//https://css-tricks.com/gulp-for-wordpress-creating-the-tasks/

import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';

const PRODUCTION = yargs.argv.prod;

export const images = () => {
	return src('assets/src/images/**/*.{jpg,jpeg,png,svg,gif}')
		.pipe(gulpif(PRODUCTION, imagemin()))
		.pipe(dest('assets/dist/images'));
}

export const styles = () => {
	return src(['assets/src/styles/front/unity3-front.scss', 'assets/src/styles/admin/unity3-admin.scss', 'assets/src/styles/editor/unity3-editor.scss'])
		.pipe(gulpif(!PRODUCTION, sourcemaps.init()))
		.pipe(sass().on('error', sass.logError))
		.pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
		.pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
		.pipe(gulpif(!PRODUCTION, sourcemaps.write()))
		.pipe(dest('assets/dist/styles'));
}

export const scripts = () => {
	return src(['assets/src/scripts/front/unity3-front.js', 'assets/src/scripts/admin/unity3-admin.js', 'assets/src/scripts/editor/unity3-editor.js'])
		.pipe(named())
		.pipe(webpack({
			module: {
				rules: [
					{
						test: /\.js$/,
						use: {
							loader: 'babel-loader',
							options: {
								presets: ['@babel/preset-env']
							}
						}
					}
				]
			},
			mode: PRODUCTION ? 'production' : 'development',
			devtool: !PRODUCTION ? 'inline-source-map' : false,
			output: {
				filename: '[name].js'
			},
		}))
		.pipe(dest('assets/dist/scripts'));
}


export const copy = () => {
	return src(['assets/src/**/*','!assets/src/{images,js,scss}','!assets/src/{images,js,scss}/**/*'])
		.pipe(dest('assets/dist'));
}

export const watchForChanges = () => {
	watch('assets/src/images/**/*.{jpg,jpeg,png,svg,gif}', images);
	watch('assets/src/styles/**/*.scss', styles);
	watch('assets/src/scripts/**/*.js', scripts);
	watch(['assets/src/**/*','!assets/src/{images,scripts,styles}','!assets/src/{images,scripts,styles}/**/*'], copy);
}

export const clean = () => {
	return del(['assets/dist']);
}

export const dev = series(clean, parallel(styles, images, scripts), watchForChanges)
export const build = series(clean, parallel(styles, images, scripts))
export default dev;