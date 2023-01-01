if ($) $ (function () {
  if (document.e2.isLocalStorageAvailable) {
    var $formNote = $ ('#form-note')
    var $noteId = $ ('#note-id')
    var $isNotePublished = $ ('#is-note-published')
    var $liveSaveButon = $ ('#livesave-button')
    var $copyIndicator = $ ('#livesave-button + .e2-unsaved-led')
    var $title = $ ('#title')
    var $text = $ ('#text')
    var $tags = $ ('#tags')
    var $alias = $ ('#alias')
    var $stamp = $ ('#stamp')
    var $uploadedImages = $ ('#e2-uploaded-images')
    var draftTimestamp = +$ ('#note-timestamp').val () * 1000 // because php returns timestamp in secs, but we need ms
    var serverTime = +$ ('#server-time').val () * 1000
    var caretPosition = null;
    var prevLiveSaveButtonVisibility = $liveSaveButon.is (':visible')
    var initNoteId = $ ('#note-id').val ()
    
    var localSaverInited = false
    var localSaverInterval = null

    document.e2.localCopies.loadLocalCopy = loadLocalCopy
    document.e2.localCopies.initLocalSaver = initLocalSaver
    document.e2.localCopies.destroyLocalSaver = destroyLocalSaver
  }

  function initLocalSaver () {
    if (localSaverInited) return

    // remove listener if it was attached
    $formNote.off ('ajaxError', initLocalSaver)
    
    localSaverInterval = setInterval (saveLocalCopy, 3000)
    window.addEventListener ('beforeunload', saveLocalCopy)

    // remove beforeunload on pagehide, 'cause if not it will be run AFTER page loaded from back-forward cache
    // and if so it may remove local copy
    window.addEventListener ('pagehide', removeBeforeUnloadListener)

    $formNote.on ('submit', destroyLocalSaver)
    $formNote.on ('ajaxError', initLocalSaver)
    
    $text.on('input', saveCaretPosition)
    
    localSaverInited = true
  }

  function destroyLocalSaver () {
    clearInterval(localSaverInterval)
    removeBeforeUnloadListener();
    window.removeEventListener ('pagehide', removeBeforeUnloadListener)
    
    $formNote.off ('submit', destroyLocalSaver)

    $text.off('input', saveCaretPosition)

    localSaverInited = false
  }

  function removeBeforeUnloadListener () {
    window.removeEventListener ('beforeunload', saveLocalCopy)
  }

  function saveCaretPosition () {
    if ($text[0].selectionEnd) {
      caretPosition = $text[0].selectionEnd
    }
  }

  function loadLocalCopy () {
    var copy = document.e2.localCopies.get($noteId.val (), draftTimestamp, serverTime);

    if (!copy) return;
    
    if (copy.caretPosition) {
      // when we paste new text, textarea will be autosized, so we subscribe to `autosized` event
      // and scroll page after that
      $text.one ('autosized', function () {
        var caretCoords = window.getCaretCoordinates ($text[0], copy.caretPosition)
        var offsetTop = 15 // offset from the top edge of browser to caret in the $text
        
        window.scrollTo (0, $text.position ().top + caretCoords.top - offsetTop)
      })
    }

    // restore title & text with trying to save undo/redo queue
    if (document.queryCommandSupported('insertText')) {
      $title.focus ().select ()
      document.execCommand ('insertText', false, copy.title)
      $title.trigger ('input')
      
      $text.focus ().select ()
      document.execCommand ('insertText', false, copy.text)
      $text.trigger ('input')
    } else {
      $title.val (copy.title).trigger ('input')
      $text.val (copy.text).trigger ('input') 
    }

    // here we need to check, does select contain all tags, or some of them were added locally
    var tags = copy.tags ? copy.tags.slice () : []

    if (tags.length) {
      $tags.find ('option').each (function (i, option) {
        var index = tags.indexOf (option.text)

        if (index > -1) {
          tags.splice (index, 1)
        }
      })
    }

    // if some tags are brand new, let's add them to the select
    if (tags.length) {
      // current version of chosen doesn't have event for full ready
      // liszt:ready emmited before listeners registration
      // so we just wait for .chzn-done on root node (and we don't use MutationObserver for more compatibility)
      var waitForFullReady = setTimeout (loadTags, 500)

      function loadTags() {
        if (!$tags.hasClass ('chzn-done')) {
          waitForFullReady = setTimeout (loadTags, 500)
          return
        }

        clearTimeout(waitForFullReady)

        var $input = $ ('#tags_chzn .search-field input')

        tags.forEach (function (item) {
          $input.val (item + ',')

          // 191 (/) instead of 188 (,) 'cause of chosen listener internals
          // if we trigger event with 188 it opens tags select, but we want to keep it closed
          $input.trigger ({type: 'keyup', which: 191})
        })
      }
    }

    // and only then we change value of the select
    $tags.val (copy.tags).trigger ('input')

    $uploadedImages
      .empty ()
      .html (copy.images.reduce (function (result, image) {
        return result + '<div class="e2-uploaded-image"><span class="e2-uploaded-image-preview">' + image + '</span></div>';
      }, ''))

    if (copy.alias && $alias.val () !== copy.alias || $stamp.val () !== copy.stamp) {
      $alias.val (copy.alias)
      $stamp.val (copy.stamp)

      $ ('.e2-note-time-and-url').slideToggle ()
    }

    $liveSaveButon.show ()
    $copyIndicator.show ()
    
    if (copy.caretPosition) {
      $text.focus ()
      $text[0].selectionStart = $text[0].selectionEnd = caretPosition = copy.caretPosition
    }
  }

  function saveLocalCopy () {
    var liveSaveButtonVisibility = $liveSaveButon.is (':visible')
    
    if (liveSaveButtonVisibility || prevLiveSaveButtonVisibility) {
      prevLiveSaveButtonVisibility = liveSaveButtonVisibility
      
      var stamp = getStamp ()

      if (!stamp.images.length && !stamp.title.trim() && !stamp.text.trim()) {
        document.e2.localCopies.remove(stamp.id)
        return
      }

      document.e2.localCopies.save(stamp.id, stamp)
    }
  }
  
  function getStamp () {
    var previews = $uploadedImages.find ('.e2-uploaded-image-preview')
    var id = $noteId.val ()
    var title = $title.val ()
    var text = $text.val ()
    var images = [];

    for (var i = 0; i < previews.length; i++) {
      images.push (previews[i].innerHTML)
    }

    return {
      id: id,
      title: title,
      text: text,
      tags: $tags.val (),
      images: images,
      // when user press ⌘ S in a new note, note's id changes, but alias field does not appear
      // so we shouldn't save alias if it's a form of a new note
      alias: initNoteId == 'new' ? false : $alias.val (),
      stamp: $stamp.val (),
      timestamp: (new Date ()).getTime (),
      link: location.pathname,
      isPublished: $isNotePublished.val (),
      caretPosition: caretPosition
    }
  }
})
