window.addEventListener('load', function () {
  document.querySelectorAll('.e2-embedded-tweet').forEach(function (tweetEl) {
    twttr.widgets.createTweet(tweetEl.dataset.tweetId, tweetEl)
  });
})