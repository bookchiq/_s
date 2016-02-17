// Include gulp
var gulp         = require('gulp');

// Include plugins
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync');
var compass      = require('gulp-compass');
var concat       = require('gulp-concat');
var fs           = require('fs');
var jshint       = require('gulp-jshint');
var minifyCSS    = require('gulp-minify-css');
var notify       = require('gulp-notify');
var uglify       = require('gulp-uglify');
var watch        = require('gulp-watch');


// Compile SCSS files with Compass
gulp.task('compass', function() {
	gulp.src('sass/**/*.scss')
		.pipe(compass({
			config_file: './config.rb',
				css: './',
				sass: 'sass'
		}))
		.pipe(autoprefixer({
			browsers: ['> 1%'],
			cascade: false
		}))
		.pipe(minifyCSS())
		.on('error', function (error) {
			console.error('' + error);
			notify("Error: " + error );
		});
		// .pipe(gulp.dest('app/assets/temp'));
});


// Use Browsersync to show changes
gulp.task('sass-watch', ['compass'], browserSync.reload);


// Write PHP colors file
gulp.task('colors', function() {
	var content = fs.readFileSync("./sass/variables-site/_colors.scss", "utf-8");
	var php = '';
	var colorRegex = /\$color-.*?;/g;

	content.split(/\r?\n/).forEach(function(line) {
		var match;

		if (match = line.match(colorRegex)) {
			var hex = /#([a-fA-F0-9]+)/.exec(match);
			var colorName = /\$color-([\w\d\-]+)/.exec(match);
			colorName[1] = toTitleCase(colorName[1].replace('-',' '));
			
			if ( ( undefined !== hex[1] ) && ( undefined !== colorName[1] ) ) {
				php = php + "\n" + '"' + hex[1] + '", "' + colorName[1] + '",';
			}
	    }
	});
	// php = "global $tinymce_custom_colors = '" + php.replace(/,+$/,'') + "\n';";

	php = "<?php $colors = '" + php.replace(/,+$/,'') + "\n';";
	

	function toTitleCase(str) {
		return str.replace(/\w*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	}

	fs.writeFileSync('./inc/colors.php', php);
});


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
		.pipe(gulp.dest('js'))
		.on('error', function (error) {
			notify("Error: " + error );
			console.error('' + error);
		});
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
	gulp.watch('sass/**/_colors.scss', ['colors']);
});


// Default Task
gulp.task('default', ['lint', 'compass', 'scripts', 'watch']);