var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/* Get dependencies */
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    del = require('del');

/* Set paths */

var paths = {
    /* Source paths */
    styles: ['resources/assets/sass/main.scss'],
    scripts: [
        'resources/assets/bower/jquery/dist/jquery.js',
        'resources/assets/bower/jquery.easing/js/jquery.easing.js',
        'resources/assets/bower/bootstrap/dist/js/bootstrap.js',
        'resources/assets/bower/jqBootstrapValidation/dist/jqBootstrapValidation-1.3.7.min.js',
        'resources/assets/js/grayscale.js',
        'resources/assets/js/contact.js'
    ],
    images: ['resources/assets/images/**/*'],
    fonts: [
        'resources/assets/bower/bootstrap/fonts/*',
        'resources/assets/bower/font-awesome/fonts/*'
    ],

    /* Output paths */
    stylesOutput: 'public/css',
    scriptsOutput: 'public/js',
    imagesOutput: 'public/images',
    fontsOutput: 'public/fonts'
};


/* Tasks */
gulp.task('styles', function() {
    return sass(paths.styles,{ style: 'expanded' })
        .pipe(gulp.dest(paths.stylesOutput))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest(paths.stylesOutput))
        .pipe(notify({ message: 'Styles task complete' }));
});

gulp.task('scripts', function() {
    return gulp.src(paths.scripts)
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.scriptsOutput))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(paths.scriptsOutput))
        .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('images', function() {
    return gulp.src(paths.images)
        .pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
        .pipe(gulp.dest(paths.imagesOutput))
        .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('fonts', function() {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest(paths.fontsOutput))
        .pipe(notify({ message: 'Fonts task complete', onLast: true }));
});

gulp.task('clean', function(cb) {
    del([paths.stylesOutput, paths.scriptsOutput, paths.imagesOutput, paths.fontsOutput], cb)
});


elixir(function(mix) {
    //mix.sass('main.scss', 'public/css/main.css');
    mix.task('clean');
    mix.task(['styles', 'scripts', 'images', 'fonts']);
});
