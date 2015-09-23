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
    del = require('del'),
    merge = require('merge-stream'),
    phpunit = require('gulp-phpunit');;

/* Set paths */

var paths = {
    /* Source paths */
    admin: {
        styles : ['resources/assets/sass/main_admin.scss'],
        raw_styles: [
            'resources/assets/bower/animate.css/animate.min.css'
        ],
        scripts: [
            'resources/assets/bower/jquery/dist/jquery.js',
        ]
    },
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
    iCheckSrc: 'resources/assets/bower/iCheck/skins/flat/*',

    /* Output paths */
    stylesOutput: 'public/css',
    iCheckOutput: 'public/css/icheck',
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

gulp.task('admin_styles',  function(){
    var sass_styles = sass(paths.admin.styles, { style: 'expanded' })
        .pipe(gulp.dest(paths.stylesOutput))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(gulp.dest(paths.stylesOutput));

    var normal_styles = gulp.src(paths.admin.raw_styles)
        .pipe(gulp.dest(paths.stylesOutput))
        .pipe(gulp.src(paths.iCheckSrc))
        .pipe(gulp.dest(paths.iCheckOutput))
        .pipe(notify({ message: 'Admin styles task complete', onLast: true }));

    return merge(sass_styles, normal_styles);
});

gulp.task('admin_scripts', function() {
    return gulp.src(paths.admin.scripts)
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
        .pipe(concat('main_admin.js'))
        .pipe(gulp.dest(paths.scriptsOutput))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(paths.scriptsOutput))
        .pipe(notify({ message: 'Admin scripts task complete' }));
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

var testNotification = function (status, pluginName, override) {
    var options = {
        title:   ( status == 'pass' ) ? 'Tests Passed' : 'Tests Failed',
        message: ( status == 'pass' ) ? '\n\nAll tests have passed!\n\n' : '\n\nOne or more tests failed...\n\n',
        icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
    };
    if(typeof override != "undefined") {
        options.title = (typeof override.title != "undefined") ? override.title : options.title;
        options.message = (typeof override.message != "undefined") ? override.message : options.message;
        options.icon = (typeof override.icon != "undefined") ? override.icon : options.icon;
    }

    return options;
};

gulp.task('tests', function(){
    return gulp.src('phpunit.xml')
        .pipe(phpunit('', {notify: true}))
        .on('error', notify.onError(testNotification('fail', 'phpunit')))
        .pipe(notify(testNotification('pass', 'phpunit')));
})

gulp.task('clean', function(cb) {
    del([paths.stylesOutput, paths.scriptsOutput, paths.imagesOutput, paths.fontsOutput], cb)
});

gulp.task('clearCache', function(done){
    return cache.clearAll(done);
})


elixir(function(mix) {
    //mix.sass('main.scss', 'public/css/main.css');
    mix.task('clean');
    mix.task(['styles', 'scripts', 'images', 'fonts']);
});
