<?php

class NeasdenGroup_picture implements NeasdenGroup {

  private $neasden = null;
  
  function __construct ($neasden) {
    $this->neasden = $neasden;

    $neasden->define_line_class ('picture', '.*\.(jpe?g|gif|png)(?: +(.+))?');
    $neasden->define_group ('picture', '(-picture-)(-p-)*');
  }
    
  function detect_line ($line, $myconf) {
    list ($filebasename, ) = explode (' ', $line, 2);  
    return is_file ($myconf['folder'] . $filebasename);
  }  
  
  function render ($group, $myconf) {
    $p = false;

    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
      @list ($filebasename, $alt) = explode (' ', $line['content'], 2);
      
      // check if alt start with an url
      @list ($link, $newalt) = explode (' ', $alt, 2);
      if (preg_match ('/[a-z]+\:.+/i', $link)) { // usafe
        $alt = $newalt;
      } else {
        $link = '';
      }
      
      if ($line['class'] == 'picture') {
  
        $this->neasden->resource_detected ($filebasename);
        
        $filename = $myconf['folder'] . $filebasename;
        $size = getimagesize ($filename);
        list ($width, $height) = $size;

        if (substr ($filebasename, strrpos ($filebasename, '.') - 3, 3) == '@2x') {
          if (! ($width%2 or $height%2)) {
            $width /= 2;
            $height /= 2;
          }
        }
  
        $filename_original = $filename;
        $width_original = $width;
        // image too wide
        if ($width > $myconf['max-width']) {
          $height = $height * ($myconf['max-width'] / $width);
          $width = $myconf['max-width'];  
        }
        
        $image_html = (
          '<img src="'. $myconf['src-prefix'] . $filename .'" '.
          'width="'. $width .'" height="'. $height.'" '.
          'alt="'. htmlspecialchars ($alt) .'" />'. "\n"
        );
  
        if (! $this->neasden->config['html.basic']) {
          // wrap into upyachka fix
          $image_html = (
            '<div style="width: '. $width .'px; max-width: 100%">'.
            '<div class="e2-text-picture-imgwrapper" style="'.
            'padding-bottom: '. round ($height / $width * 100, 2).'%'.
            '">'.
            $image_html.
            '</div>'.
            '</div>'
          );
        }

        // wrap into a link to URL if needed
        $cssc_link = $myconf['css-class'] .'-link';
        if ($link) {
          $image_html = (
            '<a href="'. $link .'" width="'. $width_original .'" class="'. $cssc_link .'">' ."\n".
            $image_html .
            '</a>'
          );
        }

        $result .= $image_html;
        
      } else {
        if (!$p) {
          $p = true;
          $result .= '<p>' . $line['content'];
        } else {
          $result .= '<br />' . "\n" . $line['content'];
        }
      }
    }
  
    if ($p) $result .= '</p>'."\n";
  
    $result .= '</div>'."\n";
    
    return $result;
    
  }
  
}

?>