const gulpFontIcon = require('gulp-iconfont');

const gulp = require('gulp'),
    util = require('gulp-util'),
    sass = require('gulp-sass'),
    cleanCSS = require('gulp-clean-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    //  sourcemaps = require('gulp-sourcemaps'),
    watch = require('gulp-watch'),
    iconfont = require('gulp-iconfont'),
    iconfontCSS = require('gulp-iconfont-css'),
    runTimestamp = Math.round(Date.now() / 1000),
    postcss = require('gulp-postcss'),
    tailwindcss = require('tailwindcss');
/**
 * Convert SVG icons into the font
 */

function svgConvert(){
    gulp.src(['assets/images/icons/*.svg'], { base: 'assets' })
    .pipe(iconfontCSS({
        fontName: 'icons',
        path: 'scss',
        fontPath: '../fonts/',
        targetPath: '../scss/_icons.scss'
    }))
    .pipe(iconfont({
        fontName: 'icons',
        prependUnicode: true,
        formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
        timestamp: runTimestamp,
        normalize: true,
        fontHeight: 1001
    }))
    // .on('glyphs', function(glyphs, options) {
    //     console.log(glyphs, options);
    // })
    .pipe(gulp.dest('assets/fonts'));
}

/**
 * Compile SCSS into CSS
 */
function cssCompile(){
    gulp.src(['assets/scss/tailwind.scss','assets/scss/*.scss', 'assets/scss/acf-block-scss/*.scss'])
    //.pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(concat('base-theme-main.css'))
    // .pipe(sourcemaps.write())
    .pipe(postcss([tailwindcss('tailwind.config.js'), require('autoprefixer')]))
    .pipe(gulp.dest('assets/css/'));

    gulp.src(['assets/scss/tailwind.scss', 'assets/scss/acf-block-scss/*.scss'])
    //.pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(concat('base-theme-editor-styles.css'))
    //  .pipe(sourcemaps.write())
    .pipe(postcss([tailwindcss('tailwind.config.js'), require('autoprefixer')]))
    .pipe(gulp.dest('assets/css/'));
}

/**
 * Concat JS
 */
function jsConcat(){
    gulp.src([
        '!assets/js/compiled/main-min.js',
        '!assets/js/acf-block-admin/*.js',
        'assets/js/*.js',
    ])
        .pipe(concat('main-min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('assets/js/compiled'))
}

gulp.task('svgConvert', function () {
    svgConvert()
});

gulp.task('svgConvertDeploy', function() {
    return new Promise(function (resolve, reject){
        svgConvert();
        resolve();
    })
})


gulp.task('cssCompile', function () {
    return watch('assets/scss/**/*.scss', function () {
        cssCompile();
    });
});


gulp.task('cssCompileOnce', function() {
    return new Promise(function(resolve, reject) {
        cssCompile();
        resolve();
    })
})

gulp.task('jsConcat', function () {
    return watch('assets/js/*.js', function () {
        jsConcat();
    });
});

gulp.task('jsConcatOnce', function() {
    return new Promise(function (resolve, reject) {
        jsConcat();
        resolve();
    })
})

gulp.task('default', gulp.parallel('svgConvert', 'cssCompile', 'jsConcat'));

/**
 * For use in github actions
 */
gulp.task('deploy', gulp.parallel('svgConvertDeploy','jsConcatOnce', 'cssCompileOnce'));