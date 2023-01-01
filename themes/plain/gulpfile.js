var gulp = require ('gulp')

var postcss = require ('gulp-postcss')
var sass = require ('gulp-sass')
var autoprefixer = require ('autoprefixer')
var assets = require ('postcss-assets')
var svgmin = require ('gulp-svgmin')

gulp.task ('svg', function () {
  return gulp.src (['src/images/*'])
    .pipe (svgmin ({
      plugins: [{cleanupIDs: false}]
    }))
    .pipe (gulp.dest ('images/'))
})

gulp.task ('sass', function () {
  gulp.src (['src/styles/*.scss', '!src/styles/_*.scss'])
    .pipe (sass ({
      outputStyle: 'compressed',
    }))
    .pipe (postcss ([
      autoprefixer ({
        browsers: ['last 1 version', 'last 2 Explorer versions']
      })
    ]))
    .pipe(gulp.dest('styles/'))
});

gulp.task ('watch', ['svg', 'sass'], function () {
  gulp.watch ('src/images/*', ['svg'])
  gulp.watch ('src/styles/**/*.scss', ['sass'])
});

gulp.task ('default', ['svg', 'sass'])