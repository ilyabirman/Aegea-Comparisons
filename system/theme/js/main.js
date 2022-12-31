if ($) $ (function () {

/*
$ ('<div id="e2-console"></div>').css ({
  'background': '#000',
  'color': '#0f0',
  'padding': '0 1em',
  'font-family': "Consolas, 'Courier New', monospace"
}).prependTo ('body')
//*/

document.e2 = {
  mac: /Macintosh/.test (navigator.userAgent),
  iosdevice: /(iPad)|(iPhone)/.test (navigator.userAgent),
  opera: /Opera/.test (navigator.userAgent)
}

// update a hrefs with link redirects
$ ('a').each (function () {
  if (redir = $ (this).attr ('linkredir')) {
    $ (this).attr ('href', redir + $ (this).attr ('href'))
    $ (this).attr ('linkredir', '')
  }
})

// show everything without hover on ios devices
if (document.e2.iosdevice) {
  $ ('.e2-comment-actions').removeClass ('comment-secondary-controls')
}

// login
if (document.getElementById ('e2-login-sheet')) {
  $ ('#e2-password').focus ()

  var m = 0
  var x = 0, nahStepTimeOut
  var mustSubmit = false
  
  var nahStep = function () {
    if (nahStepTimeOut) clearTimeout (nahStepTimeOut)
    l = (1 / (Math.pow (x, 1.25) / 20 + 0.5) - 0.05) * Math.sin (x/2)
    document.getElementById ('e2-login-sheet').style.marginLeft = (m + l * 25) + 'px'
    x ++
    if (x < 82) { nahStepTimeOut = setTimeout (nahStep, 10) }
    else { document.getElementById ('e2-login-sheet').style.marginLeft = m + 'px' }
  }
  
  $ ('#form-login').submit (function () {
    if (mustSubmit) return true
    if ($) {
      $ ('.input-disableable').attr ('disabled', 'disabled')
      $ ('#e2-password').blur ()
      $ ('#password-checking').fadeIn (333)
      xhrCheckPassword = $.ajax ({
        url: $ ('#e2-check-password-action').attr ('href'),
        type: "post",
        timeout: 10000,
        data: { password: $ ('#e2-password').val () },
        success: function (msg) {
          $ ('.input-disableable').removeAttr ('disabled')
          if (msg == 'password-correct') {
            $ ('#password-correct').fadeIn (333)
            mustSubmit = true
            $ ('#form-login').submit ()
          } else {
            $ ('#password-checking').fadeOut (333)
            $ ('#e2-password').focus ()
            x = 0
            nahStep ()
          }
        },
        error: function () {
          mustSubmit = true
          $ ('#form-login').submit ()
        }
      })
      return false
    } else {
      if (document.getElementById ('e2-password').value == '') return false
    }
  })
}


// visual login
if ($ ('#e2-visual-login').length) {
  $ (document).mousemove (function (event) {
    o = $ ('#e2-visual-login').offset ()
    x1 = o.left
    y1 = o.top
    x2 = event.pageX
    y2 = event.pageY
    l = Math.pow ((Math.pow (x2-x1, 2) + Math.pow (y2-y1, 2)), .5)
    l = Math.max (Math.min (l, 600), 100)
    l = (l - 100) / 500
    $ ('#e2-visual-login').css ('opacity', 0.25 + (1-l) * 0.75)
  })
  $ ('#e2-visual-login').click (function () {
    $ ('#e2-visual-login').css ('visibility', 'hidden')
    $ ('#e2-login-sheet').addClass ('e2-show')
    setTimeout(function() {
      $ ('#e2-password').focus ()
    }, 100)
    return false
  })
}

// hide login window
document.$e2HideLoginWindow = function () {
  $ ('#e2-password').blur ()
  $ ('#e2-login-sheet').removeClass ('e2-show')
  $ ('#e2-visual-login').css ('visibility', 'visible')
}

$ (document).keyup (function (event) {
  // hide login window on esc
  if ((27 == event.keyCode) && $ ('#e2-login-sheet').hasClass ('e2-hideable')) {
    document.$e2HideLoginWindow ()
  }
})

$ ('.e2-glass').on ('click tap', function () {
  if ($ ('#e2-login-sheet').hasClass ('e2-hideable')) {
    document.$e2HideLoginWindow ()
  }
})

$ ('.e2-login-sheet-guts').click (function (event) {
  event.stopPropagation ()
})



// don't search empty string
$ ('#e2-search').submit (function () {
  if (/^ *$/.test ($ ('#query').val ())) return false
})


// search focus
$ ('.e2-search-input-input').focusin(function () {
  $ ('.e2-search-icon').addClass('e2-search-icon-focus')
})

$ ('.e2-search-input-input').focusout(function () {
  $ ('.e2-search-icon').removeClass('e2-search-icon-focus')
})

$ ('.e2-search-icon').click(function () {
  $ ('.e2-search-input-input').focus ()
})


// ctrl+enter sends forms
$ (document).bind ('keydown keyup keypress', function (event) {
  if ((13 == event.keyCode) || (13 == event.which)) {
    var target = event.target || event.srcElement
    if (target) if (target.form) {
      if ($ (target.form).hasClass ('e2-enterable')) return
      if (!event.ctrlKey && $ (target).is ('textarea')) return
      event.preventDefault ()
      if (event.ctrlKey && (event.type == 'keydown')) {
        if (!$ ('#submit-button').attr ('disabled')) {
          target.form.submit ()
        }
      }
      return false
    }
  }
})

// alt+e edits
$ (document).bind ('keyup', function (event) {
  if (((69 == event.keyCode) || (69 == event.which)) && event.altKey) {
    if ($ ('.e2-edit-link').length == 1) {
      location.href = $ ('.e2-edit-link').attr ('href')
    }
  }
})

// ctrl-navigation
e2_ctrl_navi = function (event) {
  if (window.event) event = window.event
  var target = (event.srcElement || event.target).tagName;
  if (/textarea|input/i.test (target)) return

  if (
    (document.e2.mac && event.altKey) || (!document.e2.mac && event.ctrlKey)
  ) {
    var link = null
    if (37 == event.keyCode) link = document.getElementById ('link-prev')
    if (39 == event.keyCode) link = document.getElementById ('link-next')
    if (38 == event.keyCode) link = document.getElementById ('link-later')
    if (40 == event.keyCode) link = document.getElementById ('link-earlier')
    if (link && link.href) {
      location.href = link.href
      if (window.event) window.event.returnValue = false
      if (event.preventDefault) event.preventDefault ()
    }
  }

}

// autosize text fields
e2AutosizeTextFields = function () {
  var element = $ ('.e2-textarea-autosize')[0]
  // this should be expanded to support multiple elements
  if (element) {
    var myHeight = parseInt (element.style.height)
    if (element.scrollHeight > myHeight) {
      element.style.height = (element.scrollHeight) + 'px';
    } else {
      while (element.scrollHeight == myHeight) {
        myHeight -= 50
        element.style.height = (myHeight) + 'px'
        element.style.height = (element.scrollHeight) + 'px';
      }
    }
  }
}

$ ('.e2-textarea-autosize').bind ('input resize', e2AutosizeTextFields)
e2AutosizeTextFields ()


if (document.addEventListener) {
  document.addEventListener ('keyup', e2_ctrl_navi, false)
} else if (document.attachEvent) {
  document.attachEvent ('onkeydown', e2_ctrl_navi)
}

})