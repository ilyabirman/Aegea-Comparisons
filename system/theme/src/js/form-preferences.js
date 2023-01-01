if ($) $ (function () {


$ ('#e2-template-selector').show ()

e2SelectTemplate = function (me, template) {
  $ ('.e2-template-preview').attr ('class', 'e2-template-preview')
  $ (me).attr ('class', 'e2-template-preview e2-current-template-preview')
  $ ('#template').val ($ (me).attr ('value'))
}

$ ('#blog-title').bind ('input blur cut copy paste keypress', function () {
  if ($ ('#e2-blog-title')) $ ('#e2-blog-title').text (
    this.value? this.value : $ ('#e2-blog-title-default').val ()
  )
})

$ ('#blog-author').bind ('input blur cut copy paste keypress', function () {
  if ($ ('#e2-blog-author')) $ ('#e2-blog-author').text (
    this.value? this.value : $ ('#e2-blog-author-default').val ()
  )
})

$ ('#notes-per-page').bind ('change blur', function () {
  if (isNaN (this.value)) this.value = 10
  this.value = Math.min (Math. max (this.value, 3), 100)
})

$ ('#email').bind ('input change blur', function () {
  if (this.value != '') $ ('#email-notify').attr ('checked', 'checked')
})

$ ('.e2-template-preview').click (function () {
  e2SelectTemplate (this, '')
}) 

})
