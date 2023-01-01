'use strict';

var gulp = require ('gulp')
var postcss = require ('gulp-postcss')
var sass = require ('gulp-sass')
var autoprefixer = require ('autoprefixer')
var assets = require ('postcss-assets')
var svgmin = require ('gulp-svgmin')
var uglify = require('gulp-uglify');
var pump = require('pump')

gulp.task ('svg', function () {
  return gulp.src (['src/images/*'])
    .pipe (svgmin ({
      plugins: [{cleanupIDs: false}]
    }))
    .pipe (gulp.dest ('images/'))
})

gulp.task ('sass', function () {
  gulp.src (['src/styles/*.scss', '!styles/_*.scss'])
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

gulp.task('scripts', function(cb) { 
  pump([
      gulp.src('src/js/*.js'),
      uglify(),
      gulp.dest('js/')
    ],
    cb
  );
});

gulp.task ('watch', ['svg', 'sass', 'scripts'], function () {
  gulp.watch ('src/images/*', ['svg'])
  gulp.watch ('src/styles/**/*.scss', ['sass'])
  gulp.watch ('src/js/*', ['scripts'])
});

gulp.task ('default', ['svg', 'sass', 'scripts']);