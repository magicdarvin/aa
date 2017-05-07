var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');

// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: "aroundart.dev"
    });

    gulp.watch("scss/*.scss", ['sass']);
    // gulp.watch("dh.css").on('change', browserSync.reload);
    gulp.watch('dh.css', function() {
      // grab css files and send them into browserSync.stream
      // this injects the css into the page
      gulp.src('dh.css')
        .pipe(browserSync.stream());
    });
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("scss/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("css"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);
