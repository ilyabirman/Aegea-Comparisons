'use strict';

var gulp = require ('gulp')
var postcss = require ('gulp-postcss')
var sass = require ('gulp-sass')
var autoprefixer = require ('autoprefixer')
var assets = require ('postcss-assets')
var svgmin = require ('gulp-svgmin')

gulp.task ('svg', function () {
  return gulp.src (['images__src/*'])
    .pipe (svgmin ())
    .pipe (gulp.dest ('images/'))
})

gulp.task ('sass', function () {
  gulp.src (['sass/*.scss', '!sass/_*.scss'])
    .pipe (sass ({
      outputStyle: 'compressed'
    }))
    .pipe (postcss ([
      assets ({
        relative: true,
        cachebuster: true,
        basePath: 'images/',
        baseUrl: '/system/theme/',
        inline: { maxSize: '52K' }
      })
    ]))
    .pipe (postcss ([
      autoprefixer ({
        browsers: ['last 1 version', 'last 2 Explorer versions']
      })
    ]))
    .pipe(gulp.dest('styles/'))
});

gulp.task ('default', ['svg', 'sass'], function () {
  gulp.watch ('images__src/*', ['svg'])
  gulp.watch ('sass/*', ['sass'])
});
