var gulp = require('gulp'),
    sass = require('gulp-dart-sass'),
    postcss = require('gulp-postcss'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    merge = require('merge-stream'),
    foreach = require('gulp-flatmap'),
    changed = require('gulp-changed'),
    wpPot = require('gulp-wp-pot'),
    cssnano = require('cssnano'),
    cmq = require('css-mqpacker'),
    autoprefixer = require('autoprefixer');

var plugins = [
    autoprefixer,
    cssnano,
    cmq
]

var paths = {
    styles: {
        src: 'public/scss/widget.scss',
        dest: 'public/css'
    },
    scripts: {
        src: [
            'public/js/sources/widget.js',
            'node_modules/slick-carousel/slick/slick.js'
        ],
        dest: 'public/js'
    },
    languages: {
        src: '**/*.php',
        dest: 'languages/ra-post-carousel-widget.pot'
    }
}

function translation() {
    return gulp.src(paths.languages.src)
        .pipe(wpPot())
        .pipe(gulp.dest(paths.languages.dest))
}

function scriptsLint() {
    return gulp.src('public/js/sources/**/*','gulpfile.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
}

function style() {
    
    return gulp.src(paths.styles.src)
        .pipe(changed(paths.styles.dest))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(concat('app.scss'))
        .pipe(postcss(plugins))
        .pipe(rename('widget.css'))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(notify({ message: 'Styles task complete' }));
}

function js() {
    return gulp.src(paths.scripts.src)
        .pipe(changed(paths.scripts.dest))
        .pipe(foreach(function(stream, file){
            return stream
                .pipe(uglify())
                .pipe(rename({suffix: '.min'}))
        }))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(notify({ message: 'Scripts task complete' }));
}

function watch() {
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], style)
    gulp.watch(paths.scripts.src, gulp.series(scriptsLint, js))
    gulp.watch([
            '*.php',
            'lib/*',
            '**/**/*.php'
        ]
    )
}

gulp.task('translation', translation);

gulp.task('default', gulp.parallel(style, js, watch));