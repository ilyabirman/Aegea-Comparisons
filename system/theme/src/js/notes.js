const $notes = $('.e2-note')

if ($notes.length && document.e2.isLocalStorageAvailable) checkCopies($notes)

function checkCopies ($notes) {
  for (let i = 0; i < $notes.length; i++) {
    const id = $notes[i].id.replace('e2-note-', '')

    if (document.e2.localCopies.doesCopyExist(id)) {
      $(`#e2-note-${id} .e2-unsaved-led`).show()
    }
  }
}
