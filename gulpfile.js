var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var watch = require('gulp-watch');

var paths = {
    "css": "./public/css",
    "sass": "./public/sass"
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


gulp.task('watch', function () {
    gulp.watch( paths.sass + '/*.scss', gulp.series('sass') );
    // gulp.watch( [paths.dev + '/js/**/*.js', 'js/**/*.js', '!js/theme.js', '!js/theme.min.js'], ['scripts'] );
});