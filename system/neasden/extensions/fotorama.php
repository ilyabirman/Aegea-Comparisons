<?

n__require_line_class ('picture');
//n__define_line_class ('picture', '.*\.(jpe?g|gif|png)(?: +(.+))?');
n__define_line_class ('fotorama-thumbs', '(?:\[thumbs\])(.*)');
n__define_group ('fotorama', '(-picture-){2,}(-fotorama-thumbs-)?(-p-)*');

function n__render_group_fotorama ($group, $myconf) {
  global $_neasden_config, $_neasden_extensions;

  n__require_link (@$_neasden_config['library']. 'jquery/jquery.js');

  n__require_link (USER_FOLDER .'library/fotorama/fotorama.css');
  n__require_link (USER_FOLDER .'library/fotorama/fotorama.js');

  $result = '';
  $p_opened = false;
  $div_opened = false;
  $thumbs = false;

  $data_nav = 'dots';

  foreach ($group as $line) {
    if ($line['class'] == 'fotorama-thumbs') {
      $data_nav = 'thumbs';
    }
  }

  foreach ($group as $line) {
    list ($filebasename, $alt) = explode (' ', $line['content'].' ', 2);
    $alt = trim ($alt); // usafe
    
    if ($line['class'] == 'picture') {

      n__resource_detected ($filebasename);
      
      $filename = $myconf['folder'] . $filebasename;
      $size = getimagesize ($filename);
      list ($width, $height) = $size;

      if ($width > $myconf['max-width']) {
        $height = $height * ($myconf['max-width'] / $width);
        $width = $myconf['max-width'];
      }

      $image_html = (
        '<img src="'. $myconf['src-prefix'] . $filename .'" '.
        'width="'. $width .'" height="'. $height.'" '.
        'alt="'. $alt .'" />'. "\n"
      );
      
      if (!$div_opened) {
        $result .= (
          '<div class="'. $myconf['css-class'] .' fotorama" '.
            'data-nav="'. $data_nav .'" '.
            'data-dotColor="#555" '.
            'data-zoomToFit="false" '.
            'data-width="'. $width .'"'.
            'data-height="'. $height .'"'.
            'data-aspectRatio="'. ($width / $height) .'"'.
          '>'."\n"
        );
        $div_opened = true;
      }

      $result .= $image_html;
      
    } else {
      if (!$p_opened) {
        $p_opened = true;
        $result .= '<p>' . $filebasename;
      } else {
        $result .= '<br />' . "\n" . $filebasename;
      }
    }
  }

  if ($p_opened) {
    $result .= '</p>'."\n";
  }
  
  if ($div_opened) {
    $result .= '</div>'."\n";
  }

  return $result;
  
}



?>