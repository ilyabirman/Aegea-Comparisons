if ($('#form-comment').length) {
  $('.required').bind('input blur cut copy paste keypress', updateSubmittability)
  updateSubmittability()
  $('#form-comment').show()
}

function updateSubmittability () {
  const mailMask = /^([a-z0-9_.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i
  const shouldBeEnabled = $('#name').val() && mailMask.test($('#email').val()) && $('#text').val()

  if (shouldBeEnabled) {
    $('#submit-button').removeAttr('disabled')
  } else {
    $('#submit-button').attr('disabled', 'disabled')
  }
}
