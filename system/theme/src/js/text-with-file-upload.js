if ($) $ (function () {

  var filesToUpload = []

  var listedThumbnails = []

  var completedUploadSize = 0
  var totalUploadSize = 0

  e2PastePic = function (pic) {
    //if (alt = $ ('#title').val ()) alt = ' ' + alt
    alt = ''
    text = ''
    if ($ ('#formatter-id').val () == 'calliope') text = '((' + pic + alt + '))'
    if ($ ('#formatter-id').val () == 'neasden') text = pic + alt
    if (!text) return
    field = document.getElementById ('text')
    field.focus ()
    if (field.selectionStart || field.selectionStart == '0') {
      selStart = field.selectionStart
      selEnd = field.selectionEnd
      textToPaste = text;
      extraLength = 0

      if (selStart == selEnd) {
        selStartBefore = selStart
        while ((field.value.charAt (selStart) != '\r') && (field.value.charAt (selStart) != '\n') && (selStart > 0)) { selStart -= 1 }
        while ((field.value.charAt (selStart) == '\r') || (field.value.charAt (selStart) == '\n')) { selStart += 1 }
        textToPaste = textToPaste + '\n\n'
        selEnd = selStart
      }

      field.value = field.value.substring (0, selStart) + textToPaste +
        field.value.substring (selEnd, field.value.length)

      field.selectionStart = // selStart
      field.selectionEnd = selStart + textToPaste.length - 2

    } else {
      field.value += '\r\n\r\n' + text
    }

    // make onchange event to update submittability
    if ('createEvent' in document) {
      var evt = document.createEvent ("HTMLEvents")
      evt.initEvent ('change', false, true)
      field.dispatchEvent (evt)
    } else {
      field.fireEvent ('onchange')
    }

    field.focus ()
  }

  $e2AddPasteableImage = function (imageThumb, imageFull, imageWidth, imageHeight) {
    $newImage = $ ('#e2-uploaded-image-prototype').clone (true)
    $newImage.attr ('style', '')
    $newImage.css ('width', '')
    $newImage.find ('.e2-uploaded-image-preview img')
      .attr ('src', imageThumb + '?' + new Date ().getTime ())
      .attr ('alt', imageFull)
      .attr ('width', imageWidth)
      .attr ('height', imageHeight)
    $newImage.find ('.e2-uploaded-image-remover')
      .data ('file', imageFull)
    listedThumbnails.push (imageFull)
    return $newImage
  }

  $ ('#e2-uploaded-image-prototype').click (function () {
    e2PastePic ($ (this).find ('.e2-uploaded-image-preview img').attr ('alt'))
  })

  e2Delfiles = function (theData, $thingToDelete) {

    $.ajax ({
      data: theData,
      timeout: 60000,
      url: $ ('#e2-file-remove-action').attr ('href'),
      success: function (msg) {
        // alert (msg)
        if (msg.substr (0, 6) == 'error|') {
          $thingToDelete.fadeTo (333, 1)
        } else {
          listedThumbnails.splice ($.inArray (theData['file'], listedThumbnails), 1)
          $thingToDelete.hide (333, function () { $ (this).remove () })
        }
      },
      error: function (xhr) {
        $thingToDelete.fadeTo (333, 1)
      }
    })
  }

  $ ('.e2-uploaded-image-remover').click (function () {
    var $picToDelete = $ (this).parent ().parent ()
    $picToDelete.fadeTo (333, 0.5)
    e2Delfiles ({
      'file': $ (this).data ('file')
    }, $picToDelete)
    return false
  })

  $ ('#e2-uploaded-images').children ().each (function () {
    var $img = $ (this).find ('.e2-uploaded-image-preview img')
    var imageThumb = $img.attr ('src')
    var imageFull = $img.attr ('alt')
    var imageWidth = $img.attr ('width')
    var imageHeight = $img.attr ('height')
    $ (this).remove ()
    $e2AddPasteableImage (imageThumb, imageFull, imageWidth, imageHeight)
      .appendTo ($ ('#e2-uploaded-images')).show ()
  })

  var e2CanUploadThisFile = function (file) {
    ext = ''
    if ((dot = file.lastIndexOf ('.')) != -1) ext = file.substr (dot + 1)
    $ ('.e2-upload-error').slideUp (333)
    if (/^gif|jpe?g|png|svg|mp3$/i.test (ext)) {
      $ ('#e2-uploading').show ().css ('opacity', 1)
      $ ('#e2-upload-button').hide ()
      return true
    } else {
      $ ('#e2-upload-error-unsupported-file').slideDown (333)
      return false
    }
  }

  var e2DoneUploadingThisFileWithResponse = function (file, response, isDroppedIntoText) {

    response = JSON.parse (response)

    if (response['success']) {

      completedUploadSize += file.size

      if (response['overwrite']) {

        $ ('#e2-uploading').hide ()
        $ ('#e2-upload-button').show ()
        var thumbToUpdate = $ (
          '#e2-uploaded-images img[src="' + response['thumb'] + '"], ' +
          '#e2-uploaded-images img[src^="' + response['thumb'] + '?"]'
        )[0]
        if (thumbToUpdate) thumbToUpdate.src = response['thumb'] + '?' + new Date ().getTime ()

      } else {

        // alert (response['new-name'])
        // alert (listedThumbnails)
        // alert (alreadyListed)

        if (isDroppedIntoText) e2PastePic (response['new-name'])

        var alreadyListed = ($.inArray (response['new-name'], listedThumbnails) !== -1)

        if (!alreadyListed) {
          $e2AddPasteableImage (
            response['thumb'], response['new-name'], response['width'], response['height']
          ).appendTo ($ ('#e2-uploaded-images')).show (333, function () {
              $ ('#e2-uploading').hide ()
              $ ('#e2-upload-button').show ()
            })
        } else {
          $ ('#e2-uploading').hide ()
          $ ('#e2-upload-button').show ()
        }

      }

    } else {

      $ ('#e2-uploading').hide ()
      $ ('#e2-upload-button').show ()
      if (response['error'] == 'could-not-create-thumbnail') {
        $ ('#e2-upload-error-cannot-create-thumbnail').slideDown (333)
      } else {
        $ ('#e2-upload-error-cannot-upload').slideDown (333)
      }

    }

    e2ClearUploadBuffer ()

  }

  new AjaxUpload ('e2-upload-button', {
    action: $ ('#e2-file-upload-action').attr ('href'),
    autoSubmit: true,
    onSubmit: e2CanUploadThisFile,
    onComplete: e2DoneUploadingThisFileWithResponse,
  })

  $ ('#e2-upload-controls').show ()

  e2ClearUploadBuffer = function () {
    if (filesToUpload.length) {
      var file = filesToUpload.shift ()
      var filename = file.name
      var url = $ ('#e2-file-upload-action').attr ('href')
      if (file.e2AltKeyPressed) { url += '&overwrite' }

      if (e2CanUploadThisFile (filename)) {

        e2UploadFile (
          file,
          url,
          function (e) {
            e2ShowUploadProgressInArc (
              $ ('#e2-uploading #e2-progress')[0],
              (completedUploadSize + e.loaded) / totalUploadSize
            )
          },
          function (data, textStatus, jqHXR) {
            e2ShowUploadProgressInArc ($ ('#e2-uploading #e2-progress')[0], 0)
            e2DoneUploadingThisFileWithResponse (file, data, file.e2DroppedIntoTextarea)
          },
          function (jqXHR, textStatus, errorThrown) {
            e2ShowUploadProgressInArc ($ ('#e2-uploading #e2-progress')[0], 0)
            e2DoneUploadingThisFileWithResponse (null, '{"success": false}', file.e2DroppedIntoTextarea)
          }
        )

      }

      return false

    } else {

      totalUploadSize = 0
      completedUploadSize = 0

      return true

    }
  }

  e2DropPictures = function (e) {
    var dt = e.originalEvent.dataTransfer
    if (!dt || !dt.files) return

    for (i = 0; i < dt.files.length; i++) {
      dt.files[i].e2AltKeyPressed = e.altKey
      dt.files[i].e2DroppedIntoTextarea = (e.target == document.getElementById ('text'))
      filesToUpload.push (dt.files[i])
      completedUploadSize = 0
      totalUploadSize += dt.files[i].size
    }

    e2ClearUploadBuffer ()

    return false
  }

  $ ('.e2-external-drop-target-body').bind ('drop', e2DropPictures)
  $ ('.e2-external-drop-target-textarea').bind ('drop', e2DropPictures)

})
