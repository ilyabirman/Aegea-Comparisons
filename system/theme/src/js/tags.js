let $tags

if ($('#e2-tags').length) initTags()

function initTags () {
  $tags = $('.e2-tag')

  filterTags(50)

  $('#e2-tag-slider').show()

  $('#e2-tag-slide-area').bind('mousedown touchstart', event => {
    $(document.body).on('mousemove touchmove', updateSlider)
    $(document.body).one('mouseup touchend touchcancel', () => $(document.body).off('mousemove touchmove', updateSlider))

    updateSlider(event)
  })
}

function filterTags (value) {
  const thresh = value > 99 ? 0 : parseInt(Math.pow((1 - (value / 100)) / 2, 1.5) * 99) + 1

  $tags.each(function () {
    const $this = $(this)
    const weight = parseInt($this.data('weight'), 10)

    $this[weight > thresh ? 'show' : 'hide']()
  })
}

function updateSlider (event) {
  let x

  if (event.originalEvent.touches && event.originalEvent.touches.length > 0) {
    x = event.originalEvent.changedTouches[0].clientX
  } else {
    x = event.clientX
  }

  let v = x - $('#e2-tag-slide').offset().left
  if (v < 0) v = 0
  if (v > 100) v = 100

  $('#e2-tag-slider').css('left', v)
  filterTags(v)

  event.stopPropagation()
  event.preventDefault()
}
