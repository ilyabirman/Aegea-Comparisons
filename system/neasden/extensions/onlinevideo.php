<?php

class NeasdenGroup_onlinevideo implements NeasdenGroup {

  function __construct ($neasden) {
  
    $neasden->define_line_class (
      'youtube',
      'https?\:\/\/(?:www\.)?(?:(?:youtube\.com\/watch\/?\?v\=)|(?:youtu\.be\/))(.{11})([&#?].*)?'
    );
    $neasden->define_line_class (
      'vimeo',
      'https?\:\/\/(?:www\.)?(?:(?:vimeo\.com\/))(\d+)'
    );

    $neasden->define_group ('onlinevideo', '(?:(-youtube-)|(-vimeo-)(-p-)*)');

  }
  
  function render ($group, $myconf) {
  
    $p = false;

    $max_width = $myconf['max-width'];
    $ratio = $myconf['ratio'];

    $result = '<div class="'. $myconf['css-class'] .'">'."\n";
    foreach ($group as $line) {
    
      $id = $line['class-data'][1];
      $src = '';

      if ($line['class'] == 'youtube') $src = (
        'https://www.youtube.com/embed/'. $id .''
      );

      if ($line['class'] == 'vimeo') $src = (
        'https://player.vimeo.com/video/'. $id .'' //?title=0&amp;byline=0&amp;portrait=0
      );

      if ($line['class'] == 'youtube' or $line['class'] == 'vimeo') {

        $image_html = (
          '<iframe width="100%" height="100%" style="position: absolute" '.
          'src="'. $src .'" frameborder="0" allowfullscreen>'.
          '</iframe>'.
          "\n"
        );

        if (! $this->neasden->config['html.basic']) {
          // wrap into upyachka fix
          $image_html = (
            '<div style="width: '. $max_width .'px; max-width: 100%">'.
            '<div class="e2-text-picture-imgwrapper" style="'.
            'padding-bottom: '. round (100 / $ratio, 2).'%'.
            '">'.
            $image_html.
            '</div>'.
            '</div>'
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
  
    $result .= '</div>'."\n";
  
    return $result;
    
  }
  
}

?>