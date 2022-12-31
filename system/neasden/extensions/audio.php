<?

n__define_line_class ('audio', '.*\.(mp3)(?: +(.+))?');
n__define_line_class ('audio-play', '(?:\[play\])(.*)');

function n__detect_class_audio ($line, $myconf) {
  global $_neasden_config;
  
  list ($filebasename, ) = explode (' ', $line, 2);  
  return is_file ($myconf['folder'] . $filebasename);
}

n__define_group ('audio', '(?:(-audio-)|(-audio-play-))');

function n__render_group_audio ($group, $myconf) {

  global $_neasden_config, $_neasden_extensions;

  n__require_link (@$_neasden_config['library']. 'jquery/jquery.js');
  n__require_link (@$_neasden_config['library']. 'jouele/jquery.jplayer.min.js');
  n__require_link (@$_neasden_config['library']. 'jouele/jouele.css');
  n__require_link (@$_neasden_config['library']. 'jouele/jouele.js');
  
  $css_class = $_neasden_config['groups.generic-css-class'];
  if (@$myconf['css-class']) $css_class = @$myconf['css-class'];
  
  $p = false;

  $result = (
    '<div class="'. $css_class .'">'."\n"
  );
  foreach ($group as $line) {

    if ($line['class'] == 'audio') {
      @list ($filebasename, $alt) = explode (' ', $line['content'], 2);
      n__resource_detected ($filebasename);
      if (!$alt) $alt = basename ($filebasename);
      $href = $myconf['src-prefix'] . $myconf['folder'] . $filebasename;
    }

    if ($line['class'] == 'audio-play') {
      @list ($href, $alt) = explode (' ', trim ($line['class-data'][1]), 2); // usafe
      if (!$alt) $alt = basename ($href);
    }
  
    if ($line['class'] == 'audio' or $line['class'] == 'audio-play') {

      $player_html = '<a '.
        'class="jouele" '.
        'href="'. $href .'" '.
      '>'. $alt .'</a>'."\n";
      
      $player_html = n__isolate ($player_html);
  
      $result .= $player_html;
    
    }
    
  }
  $result .= '</div>'."\n";

  return $result;

  
}



?>