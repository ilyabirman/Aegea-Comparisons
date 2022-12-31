var gulp = require ('gulp')

var postcss = require ('gulp-postcss')
var sass = require ('gulp-sass')

gulp.task ('sass', function () {
  gulp.src (['sass/*.scss', '!sass/_*.scss'])
    .pipe (sass ({
      outputStyle: 'compressed',
    }))
    .pipe (postcss ([
      require ('autoprefixer') ({
        browsers: ['last 1 version', 'last 2 Explorer versions']
      }),
      require ('postcss-assets') ({
        basePath: 'images/',
        baseUrl: '/system/theme/',
        inline: { maxSize: '52K' }
      })
    ]))
    .pipe (gulp.dest ('styles/'))
});

gulp.task ('watch', function () {
  gulp.watch ('sass/**/*.scss', ['sass'])
});

gulp.task ('default', ['sass'])