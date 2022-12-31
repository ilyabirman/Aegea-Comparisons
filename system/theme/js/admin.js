if ($) $ (function () {

  var e2SpinnerCode = function (radius, color, backwards, period) {
    return (
      '<span class="e2-toggle-state-thinking">' +
      '<svg xmlns="http://www.w3.org/2000/svg" width="' + (radius*2) + '" height="' + (radius*2) + '"' +
      'viewBox="0 0 24 24">' +
      '<path fill="'+ color +'" d="M17.25 1.5c-.14-.06-.28-.11-.44-.11-.55 0-1 .45-1 1 0 .39.23.72.56.89l-.01.01c3.2 1.6 5.39 4.9 5.39 8.71 0 5.38-4.37 9.75-9.75 9.75S2.25 17.39 2.25 12c0-3.82 2.2-7.11 5.39-8.71v-.02c.33-.16.56-.49.56-.89 0-.55-.45-1-1-1-.16 0-.31.05-.44.11C2.9 3.43.25 7.4.25 12c0 6.49 5.26 11.75 11.75 11.75S23.75 18.49 23.75 12c0-4.6-2.65-8.57-6.5-10.5z">' +
        '<animateTransform attributeName="transform" type="rotate" ' +
        'from="' + (backwards*360) + ' 12 12" to="' + (!backwards*360) + ' 12 12" ' +
        'dur="' + period + 'ms" repeatCount="indefinite"' + 
        ' />' + 
      '</path>' + 
      '</svg>' +
      '</span>'
    )
  }

// <animateTransform attributeName="transform" type="rotate" from="0 8 8" to="360 8 8" dur="1333ms" repeatCount="indefinite" />


  e2SelfSpin = function (me) {
    $ (me).append (e2SpinnerCode ())
    // $ (me).find ('span').attr ('class', '').addClass ('i-loading')
    // $ (me).fadeTo (333, 1)
  }
  
  // file upload
  
  e2UploadFile = function (file, uploadURL, doneCallback) {
    if (FormData) {
      var data = new FormData ()
      data.append ('file', file)
        
      $.ajax ({
        type: 'POST',
        url: uploadURL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: doneCallback,
        error: function (jqXHR, textStatus, errorThrown) {
          //alert (textStatus)
        },
        complete: function (jqXHR, textStatus) {
          //alert (textStatus)
        }
      })
    }
  }
  
  // toggles

  var e2ToggleClick = function (event, me, functionOn, functionOff, functionSlow) {
    var functionOnGlobal = functionOn, functionOffGlobal = functionOff, functionSlowGlobal = functionSlow;

    // $ (me).fadeTo (333, 0)
    if ($ (me).find ('.e2-toggle-state-thinking').length == 0) {
      $ (me).find ('.e2-svgi').append (e2SpinnerCode (8, '#000', 0, 1333))
    }

    $ (me).removeClass ('e2-toggle-on')
    $ (me).addClass ('e2-toggle-thinking')

    // slowTimeout = setTimeout (function () { functionSlowGlobal (me) }, 333)

    $.ajax ({
      type: "post",
      timeout: 10000,
      url: $ (me).attr ('href'),
      data: 'result=ajaxresult',
      success: function (msg) {
        // clearTimeout (slowTimeout)
        if (msg.substr (0, 10) == 'on-rehref|') {
          functionOnGlobal (msg.substr (10))
        }
        if (msg.substr (0, 11) == 'off-rehref|') {
          functionOffGlobal (msg.substr (11))
        }
      },
      error: function (xhr) {
        location.href = $ (me).attr ('href')
      },
      complete: function (xhr) {
        $ (me).removeClass ('e2-toggle-thinking')
        //$ ('#e2-console').html (xhr.responseText)
      }
    })
    return false
  }

  $ ('.e2-favourite-toggle').click (function (event) {
    var me = this
    return e2ToggleClick (
      event, me, 
      function (msg) {
        $ (me).addClass ('e2-toggle-on')
        $ (me).parent ().parent ().parent ().addClass ('e2-note-favourite')
        $ (me).attr ('href', msg)
      },
      function (msg) {
        $ (me).removeClass ('e2-toggle-on')
        $ (me).parent ().parent ().parent ().removeClass ('e2-note-favourite')
        $ (me).attr ('href', msg)
      },
      e2SelfSpin
    )
  })

  $ ('.e2-pinned-toggle').click (function (event) {
    var me = this
    return e2ToggleClick (
      event, me,
      function (href) {
        $ (me).addClass ('e2-toggle-on')
        $ (me).attr ('href', href)
      },
      function (href) {
        $ (me).removeClass ('e2-toggle-on')
        $ (me).attr ('href', href)
      },
      e2SelfSpin
    )
  })

  $ ('.e2-important-toggle').click (function (event) {
    var me = this
    return e2ToggleClick (
      event, me, 
      function (msg) {
        $ (me).addClass ('e2-toggle-on')
        $ (me).parent ().parent ().parent ().addClass ('important')
        $ (me).attr ('href', msg)
        $ct = $ (me).parents ('.e2-comment-control-group').eq (0)
        $ct.find ('.e2-markable').addClass ('e2-marked')
        if (document.$e2Mark) document.$e2Mark ()
      },
      function (msg) {
        $ (me).removeClass ('e2-toggle-on')
        $ (me).parent ().parent ().parent ().removeClass('important')
        $ (me).attr ('href', msg)
        $ct = $ (me).parents ('.e2-comment-control-group').eq (0)
        $ct.find ('.e2-markable').removeClass ('e2-marked')
        if (document.$e2Mark) document.$e2Mark ()
      },
      e2SelfSpin
    )
  })

  $ ('.e2-removed-toggle').click (function (event) {
    var me = this
    //var cc = $ ('#e2-comments-count').text ().split (' ')[0]
    var $ct = $ (me).parents ('.e2-comment').eq (0)
    $ct.find ('.e2-comment-actions').addClass ('e2-disabled')
    $ct.find ('.e2-comment-actions-removed').addClass ('e2-disabled')
    // $ct.find ('.e2-removed-toggling').css ('opacity', 0).show ().fadeTo (333, 1)
    return e2ToggleClick (
      event, me,
      function (href) {
        $ (me).addClass ('e2-toggle-on')
        $ct.find ('.e2-comment-actions').removeClass ('e2-disabled')
        // $ct.find ('.e2-removed-toggling').fadeTo (333, 0, function () {
          // $ct.find ('.e2-comment-actions').show ()
        // })
        // $ct.find ('.e2-comment-actions').show ()
        $ct.find ('.e2-comment-actions-removed').hide ()
        $ct.find ('.e2-comment-content').slideDown (333)
        $ct.find ('.e2-comment-meta').slideDown (333)
        $ct.find ('.e2-comment-author').removeClass ('e2-comment-author-removed')
        $ct.find ('.e2-removed-toggle').attr ('href', href)
        if (!$ (me).parents ('.e2-comment').is ('.e2-reply')) {
          $ (me).parents ('.e2-comment-and-reply').find ('.e2-reply').slideDown (333)
        }
      },
      function (href) {
        $ (me).removeClass ('e2-toggle-on')
        $ct.find ('.e2-comment-actions-removed').removeClass ('e2-disabled')
        // $ct.find ('.e2-removed-toggling').fadeTo (1, 0)
        // $ct.find ('.e2-comment-actions').hide ()
        $ct.find ('.e2-comment-author').addClass ('e2-comment-author-removed')
        $ct.find ('.e2-comment-meta').slideUp (333)
        $ct.find ('.e2-comment-content').slideUp (333, function () {
          // $ct.find ('.e2-comment-actions-removed').slideDown (333)
          $ct.find ('.e2-comment-actions-removed').show ()
        })
        $ct.find ('.e2-removed-toggle').attr ('href', href)
        if (!$ (me).parents ('.e2-comment').is ('.e2-reply')) {
          $ (me).parents ('.e2-comment-and-reply').find ('.e2-reply').slideUp (333)
        }
      },
      function (me) { return false }
    )
  })

  
  
  // generic external drag-n-drop
  
  e2DragEnter = function (e) {
    dt = e.originalEvent.dataTransfer
    if (!dt) return
    
    //FF
    if (dt.types.contains && !dt.types.contains ('Files')) return
    
    //Chrome
    if (dt.types.indexOf && dt.types.indexOf ('Files') == -1) return
	  if (dt.dropEffect) dt.dropEffect = 'copy'
	 
    $ (this).addClass ('e2-external-drop-target-dragover')

    if ($ (this).hasClass ('e2-external-drop-target-altable') && e.altKey) {
      $ (this).addClass ('e2-external-drop-target-dragover-alt')
    } else {
      $ (this).removeClass ('e2-external-drop-target-dragover-alt')
    }

    return false
    
  }
  
  e2DragLeave = function () {
    $ (this).removeClass ('e2-external-drop-target-dragover')
    $ (this).removeClass ('e2-external-drop-target-dragover-alt')
    return false
  }

  //*
  $ ('.e2-external-drop-target')
	  .bind ('dragover', e2DragEnter)
	  .bind ('dragenter', e2DragEnter)
	  .bind ('dragleave', e2DragLeave)
    .bind ('drop', e2DragLeave)
  //*/



  // userpic

  $picContainer = $ ('.e2-user-picture-container')
  $pic = $picContainer.find ('img')
  
  e2DropUserpic = function (e) {
    dt = e.originalEvent.dataTransfer
    if (!dt && !dt.files) return
    
    var files = dt.files
    if (files.length == 1) {
      file = files[0]

  	  $picContainer.addClass ('e2-user-picture-container-uploading')

      e2UploadFile (
        file,
        $ ('#e2-userpic-upload-action').attr ('href'),
        function (data, textStatus, jqHXR) {
          if (data.substr (0, 6) == 'image|') {
            image = data.substr (6).split ('|')
            image = image[0]
            $pic.attr ('src', image + '?' + escape (new Date ()))
            $pic.bind ('load', function () {
              $picContainer.removeClass ('e2-user-picture-container-uploading')
            })
            $ ('.e2-set-userpic-by-dragging').slideUp (333)
          } else {
            $picContainer.removeClass ('e2-user-picture-container-uploading')
          }
        }
      )
      
    }

    return false
  }
  
  $picContainer.bind ('drop', e2DropUserpic)
  
})