if ($) $ (function () {
  var $notes = $ ('.e2-note')

  if (document.e2.isLocalStorageAvailable) checkCopies ()

  function checkCopies () {
    for (var i = 0; i < $notes.length; i++) {
      var id = $notes[i].id.replace('e2-note-', '')

      if (document.e2.localCopies.doesCopyExist (id)) {
        $ ('#e2-note-' + id + ' .e2-unsaved-led').show ()
      }
    }
  }
})
