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


// Lint our JS files
gulp.task('lint', function() {
	return gulp.src(['js/*.js', '!js/*.min.js'])
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});


// Minify & concatenate JS
gulp.task('scripts', function() {
	return gulp.src(['js/*.js', '!js/*.min.js'])
		.pipe(uglify())
		.pipe(concat('app.min.js'))
		.pipe(gulp.dest('js'));
});


// Watch files for changes
gulp.task('watch', function () {
	gulp.watch('js/*.js', ['lint', 'scripts']);
	gulp.watch('sass/**/*.scss', ['compass']);
});


// Default Task
gulp.task('default', ['lint', 'compass', 'scripts', 'watch']);


// gulp.task('default', function() {
//   // place code for your default task here
// });

// gulp.task('js', function () {
//    return gulp.src(['js/**/*.js', '!js/**/*.min.js'])
//       // .pipe(jshint())
//       // .pipe(jshint.reporter('default'))
//       .pipe(uglify())
//       .pipe(concat('app.min.js'))
//       .pipe(gulp.dest('js'));
// });





// gulp.task('browser-sync', function () {
//    var files = [
//       'app/**/*.html',
//       'app/assets/css/**/*.css',
//       'app/assets/imgs/**/*.png',
//       'app/assets/js/**/*.js'
//    ];

//    browserSync.init(files, {
//       server: {
//          baseDir: './app'
//       }
//    });
// });

