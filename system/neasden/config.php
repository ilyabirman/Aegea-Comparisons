<?

global $settings, $full_blog_url;

$_neasden_config = array (

  '__overload' => 'user/neasden/',
  
  '__profiles' => array (
    'full' => array (
      'html.on' => true,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (),
    ),
    'simple' => array (
      'html.on' => false,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (
        'picture', 'fotorama', 'audio', 'youtube', 'vimeo'
      ),
    ),
    'kavychki' => array (
      'html.on' => true,
      'groups.on' => false,
      'typography.markup' => false,
      'typography.autohref' => false,
    ),
  ),
    
  'library' => 'system/library/',
  
  'language' => 'ru',
  
  'html.on' => true,
  'html.elements.opaque' => 'div p ul ol li blockquote table pre textarea',
  'html.elements.sacred' => 'object embed iframe script style code',

  'groups.on' => true,
  'groups.headings.char'  => '#',
  'groups.headings.plus'  => 1,
  'groups.quotes.char' => '>',
  'groups.lists.chars' => array ('-', '*'),
  'groups.generic-css-class' => 'txt-generic-object',
  'groups.classes' => array (
    'picture' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'txt-picture', // see also var csscPrefix in scaleimage.js
      'max-width' => $settings['max-image-width'],
      'scaled-img-folder' => SCALED_IMAGES_FOLDER,
      'scaled-img-provider' => '?go=@scale-image:',
      'scaled-img-extension' => 'scaled.jpg',
      'scaled-img-link-to-original' => true,
      'scaled-img-link-to-original-class' => 'link-to-big-picture',
    ),
    'fotorama' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'txt-picture', // see also var csscPrefix in scaleimage.js
      'max-width' => $settings['max-image-width'],
    ),
    'table' => array (
      'css-class' => 'txt-table',
    ),
    'youtube' => array (
      'css-class' => 'txt-video',
      'width' => $settings['max-image-width'],
      'height' => round ($settings['max-image-width'] / 1.6),
    ),
    'vimeo' => array (
      'css-class' => 'txt-video',
      'width' => $settings['max-image-width'],
      'height' => round ($settings['max-image-width'] / 1.6),
    ),
    'audio' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => AUDIO_FOLDER,
    ),
  ),
  
  'typography.on' => true,
  'typography.markup' => true,
  'typography.autohref' => true,
  'typography.cleanup' => array (
    '&nbsp;' => ' ',
    '&laquo;' => '«',
    '&raquo;' => '»',
    '&bdquo;' => '„',
    '&ldquo;' => '“',
    '&rdquo;' => '”',
  ),
    
);


?>