<?php

class NeasdenGroup_tweet implements NeasdenGroup {

  // done:
  function __construct ($neasden) {
    $this->neasden = $neasden;
  
    $neasden->define_line_class (
      'tweet',
      'https?\:\/\/(?:www\.)?(?:twitter\.com\/(.+?)\/status\/)(.{18})([&#?].*)?'
    );
    $neasden->define_group ('tweet', '(-tweet-)');
  
  }

  // not done:  
  function render ($group, $myconf) {
  
    $this->neasden->require_link ('https://platform.twitter.com/widgets.js');
    $this->neasden->require_link (SYSTEM_LIBRARY_FOLDER .'embedded-tweet/embedded-tweet.js');
    
    $p = false;

    if (! $this->neasden->config['html.basic']) {
      $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    }
    
    foreach ($group as $line) {
    
      if ($line['class'] == 'tweet') {
        
        $who = $line['class-data'][1];
        $id = $line['class-data'][2];

        // here must be a javascript which will ajax twitter com to get the tweet contents
        // and it even must cache the response
        if (! $this->neasden->config['html.basic']) {
          
          $result .= '<div class="e2-embedded-tweet" data-tweet-id="'. $id .'"></div>';
          
        } else {

          // we need to isolate it, otherwise typography.autohref
          // will wrap the link into another a href:
          
          $result .= $this->neasden->isolate (
            '<p><a href="'. $line['class-data'][0] .'">'.
            $line['class-data'][0].
            '</a></p>'
          );

        }
        
      } 
      
    }
  
    if (! $this->neasden->config['html.basic']) {
      $result .= '</div>'."\n";
    }
  
    return $result;
    
  }
  
}

?>