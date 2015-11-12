// Include gulp
var gulp        = require('gulp');

// Include plugins
var browserSync = require('browser-sync');
var compass     = require('gulp-compass');
var concat      = require('gulp-concat');
var jshint      = require('gulp-jshint');
var minifyCSS   = require('gulp-minify-css');
var uglify      = require('gulp-uglify');
var watch       = require('gulp-watch');


// Compile SCSS files with Compass
gulp.task('compass', function() {
	gulp.src('sass/**/*.scss')
		.pipe(compass({
			config_file: './config.rb',
				css: './',
				sass: 'sass'
		}))
		.pipe(minifyCSS());
		// .pipe(gulp.dest('app/assets/temp'));
});

// Use Browsersync to show changes
gulp.task('sass-watch', ['compass'], browserSync.reload);


// Lint our JS files
gulp.task('lint', function() {
	return gulp.src(['js/*.js', '!js/*.min.js'])
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});


// Minify & concatenate JS
gulp.task('scripts', function() {
	return gulp.src(['js/*.js', '!js/*.min.js', '!js/*.partial.js'])
		.pipe(uglify())
		.pipe(concat('app.min.js'))
		.pipe(gulp.dest('js'));
});


// Watch files for changes
gulp.task('watch', function () {
	browserSync({
		proxy: "localhost/staging/opod/one-plus-one-design/",
		host: "localhost",
		port: 8080
	});

	gulp.watch('js/*.js', ['lint', 'scripts']);
	gulp.watch('sass/**/*.scss', ['sass-watch']);
});


// Default Task
gulp.task('default', ['lint', 'compass', 'scripts', 'watch']);