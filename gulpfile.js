
// Concatenate & Minify JS
// gulp.task('scripts', function() {
//     return gulp.src(alljs)
//         .pipe(concat('all.js'))
//         .pipe(gulp.dest(jsfolder))
//         .pipe(rename('all.min.js'))
//         .pipe(uglify())
//         .pipe(gulp.dest(jsfolder))
//         .pipe(notify({ message: 'Scripts task complete' }));
// });

// Watch Files For Changes
// gulp.task('watch', function() {
//     gulp.watch(mainjs, ['lint', 'scripts']);
//     gulp.watch(scssfiles, ['styles']);
// });

// Default Task
// gulp.task('default', ['lint', 'scripts', 'watch']);



var gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano"),
    sourcemaps = require("gulp-sourcemaps");
    
var paths = {
    styles: {
        src: "wp-content/themes/lavantseine-v3/assets/css/**/*.sass",
        dest: "wp-content/themes/lavantseine-v3/assets/"
    }
};


    
function style() {
    
    return (
        gulp
            .src(paths.styles.src)
            // Initialize sourcemaps before compilation starts
            //.pipe(sourcemaps.init())
            .pipe(sass())
            .on("error", sass.logError)
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(paths.styles.dest))
    );
    
}

    
function watch() {
    style();
    
    gulp.watch(paths.styles.src, style);
}

    
exports.watch = watch

