var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var terser = require('gulp-terser');

var paths = {
    "css": "./public/css",
    "sass": "./public/sass",
    "js_src": "./public/js_src",
    "js": "./public/js",
};

gulp.task('sass', function () {
    var stream = gulp.src(paths.sass + '/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sass({
            errLogToConsole: true
        }))
        .pipe(gulp.dest(paths.css))
    return stream;
});

gulp.task('scripts', function () {
    var stream = gulp.src(paths.js_src + '/*.js')
        .pipe(terser())
        .pipe(gulp.dest(paths.js))
    return stream;
});


gulp.task('watch', function () {
    gulp.watch( paths.sass + '/*.scss', gulp.series('sass') );
    gulp.watch( paths.js_src + '/*.js', gulp.series('scripts') );
});