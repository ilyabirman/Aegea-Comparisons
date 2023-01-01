if ($) $ (function () {
  var $mailMask = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i


  e2UpdateSubmittability = function () {

	  shouldBeEnabled = (
	    $ ('#name').val () &&
		$mailMask.test ($ ('#email').val ()) &&
	    $ ('#text').val ()
      )
	  if (shouldBeEnabled) {
		  $ ('#submit-button').removeAttr ('disabled')
	  } else {
		  $ ('#submit-button').attr ('disabled', 'disabled')
	  }

  }
  
  e2UpdateSubmittability ()
 
  $ ('.required').bind ('input blur cut copy paste keypress', e2UpdateSubmittability)
  
  
})