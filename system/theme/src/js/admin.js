if ($) $ (function () {

  // file upload

  e2UploadFile = function (file, uploadURL, progressCallback, doneCallback, errorCallback) {
    if (FormData) {
      var data = new FormData ()
      data.append ('file', file)

      $.ajax ({
        type: 'POST',
        timeout: 0,
        url: uploadURL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        xhr: function () {
          var myXhr = $.ajaxSettings. xhr ()
          if (myXhr.upload) {
            myXhr.upload.addEventListener ('progress', progressCallback, false)
          }
          return myXhr
        },
        success: doneCallback,
        error: errorCallback //,
        // complete: function (jqXHR, textStatus) {
          // errorCallback (jqXHR, textStatus)
        // }
      })
    }
  }

  // toggles

  var e2ToggleClick = function (event, me, functionOn, functionOff) {
    var functionOnGlobal = functionOn, functionOffGlobal = functionOff

    $ (me).removeClass ('e2-toggle-on')
    $ (me).addClass ('e2-toggle-thinking')

    $.ajax ({
      type: "post",
      timeout: 10000,
      url: $ (me).attr ('href'),
      data: 'result=ajaxresult',
      success: function (msg) {
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
      }
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
      }
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
      }
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


  e2ShowUploadProgressInArc = function (arc, progress) {
    var fadeMinProgress = 0.04
    var fakeFullProgress = 0.84
    progress = Math.min (progress, 1)
    fakeProgress = 0.1 + progress * 0.8
    var maxDash = 245
    var progressDash = Math.floor (maxDash - fakeProgress*maxDash)

    // document.title = progress * 100
    // console.log (file.name + ' / ' + completedUploadSize + '+' +  e.loaded + ' / ' + totalUploadSize + ' / ' + progressDash)
    arc.style.strokeDashoffset = progressDash
  }


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
        function (e) {
          e2ShowUploadProgressInArc (
            $ ('#e2-user-picture-uploading #e2-progress')[0],
            e.loaded / e.total
          )
        },
        function (data, textStatus, jqHXR) {
          e2ShowUploadProgressInArc ($ ('#e2-user-picture-uploading #e2-progress')[0], 0)
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
        },
        function () {
          e2ShowUploadProgressInArc ($ ('#e2-user-picture-uploading #e2-progress')[0], 0)
        }
      )

    }

    return false
  }

  $picContainer.bind ('drop', e2DropUserpic)

  // local copy indicators
  if (document.e2.isLocalStorageAvailable) {
    var $draftsLink = $ ('#e2-drafts-item')
    var $draftsUnsavedLed = $ ('#e2-drafts-item .e2-unsaved-led')
    var $newNoteUnsavedLed = $ ('#e2-new-note-item .e2-unsaved-led')
    var $notesUnsaved = $ ('#e2-notes-unsaved')
    var $nothingMessage = $ ('#e2-nothing-message')
    var $formNote = $ ('#form-note')
    
    var localCopiesList = document.e2.localCopies.getList ()
    var localCopiesCount = Object.keys (localCopiesList).length
    var isNewLocalCopyAvailable = document.e2.localCopies.doesCopyExist ('new')
    var noteId = $formNote ? $ ('#note-id').val () : null
    var isNoteLocalCopyAvailable = noteId !== 'new' ? document.e2.localCopies.doesCopyExist (noteId) : false

    if (isNewLocalCopyAvailable) localCopiesCount--
    if (isNoteLocalCopyAvailable) localCopiesCount--

    // indicator near the drafts button
    if ($draftsUnsavedLed && localCopiesCount > 0) {
      $draftsLink.show ()
      $draftsUnsavedLed.show ()
    }

    // indicator near the new note button
    if ($newNoteUnsavedLed && isNewLocalCopyAvailable) {
      $newNoteUnsavedLed.show ()
    }

    // indicators on the drafts page
    if ($notesUnsaved && $nothingMessage) {
      var newName = document.e2.localCopies.getName('new')

      if (localCopiesList.hasOwnProperty(newName)) {
        delete localCopiesList[newName]
      }
      
      // show indicators near the drafts if they have local copies
      for (var key in localCopiesList) {
        if (localCopiesList[key].isPublished === 'false') {
          $ ('#e2-draft-' + key + ' .e2-unsaved-led').show ()
          delete localCopiesList[key]
        }
      }

      if (Object.keys(localCopiesList).length) {
        for (var key in localCopiesList) {
          var copy = document.e2.localCopies.get(key)

          if (!copy) continue // if smth goes wrong we just get out of here

          addLink (copy.link, copy.title)
        }

        $notesUnsaved.show ()
        $nothingMessage.hide ()

        function addLink (link, title) {
          var $link = $('#e2-unsaved-note-prototype').clone(true)
          $link.attr('id', null)
          $('.e2-admin-link', $link).attr('href', link)
          $('u', $link).html(title)
          $link.attr('style', '')

          $notesUnsaved.append($link)
        }
      }
    }
  }
})
