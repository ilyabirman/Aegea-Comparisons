<?php

// this is not done yet
// see doc at Twitter.com:
// https://dev.twitter.com/docs/embedded-tweets

class NeasdenGroup_tweet implements NeasdenGroup {

  // done:
  function __construct ($neasden) {
  
    $neasden->define_line_class (
      'tweet',
      'https?\:\/\/(?:www\.)?(?:twitter\.com\/(.+?)\/statuses\/)(.{18})([&#?].*)?'
    );
    $neasden->define_group ('tweet', '(-tweet-)');
  
  }

  // not done:  
  function render ($group, $myconf) {
  
    $p = false;
  
    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
    
      if ($line['class'] == 'tweet') {
        
        $who = $line['class-data'][1];
        $id = $line['class-data'][2];

        // here must be a javascript which will ajax twitter com to get the tweet contents
        // and it even must cache the response
        $result .= (
          '<div class="twitter-tweet" lang="en"><p>Взлетаем <a href="https://t.co/BuJ5fid1gl">pic.twitter.com/BuJ5fid1gl</a></p>&mdash; Ilya Varlamov (@varlamov) <a href="https://twitter.com/varlamov/statuses/423551892036136960">January 15, 2014</a></div>'.
          "\n".
          '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>'.
          "\n"
          // 'width="'. $myconf['width'] .'" height="'. $myconf['height'] .'" '.
          // 'src="https://www.tweet.com/embed/'. $id .'" frameborder="0" allowfullscreen>'.
          // '</iframe>'.
        );
        
      } 
      
    }
  
    $result .= '</div>'."\n";
  
    return $result;
    
  }
  
}

?>