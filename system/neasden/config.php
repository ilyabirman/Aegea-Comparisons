<?php

global $settings, $full_blog_url, $_lang;

return array (

  '__overload' => 'user/neasden/',
  
  '__profiles' => array (
    'full-rss' => array (
      'html.on' => true,
      'html.basic' => true,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (),
    ),
    'full' => array (
      'html.on' => true,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (),
    ),
    'simple-rss' => array (
      'html.on' => false,
      'html.basic' => true,
      'groups.on' => true,
      'typography.markup' => true,
      'typography.autohref' => true,
      'banned-groups' => array (
        'picture', 'fotorama', 'audio', 'youtube', 'vimeo'
      ),
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
      'html.code.on' => false,
      'groups.on' => false,
      'typography.markup' => false,
      'typography.autohref' => false,
    ),
 ),
    
  'library' => SYSTEM_LIBRARY_FOLDER,
  
  'language' => $_lang,
  
  'html.on' => true,
  'html.elements.opaque' => 'div p ul ol li blockquote table pre textarea',
  'html.elements.sacred' => 'object embed iframe head link script style code',
  'html.basic' => false,

  'html.code.on' => true,
  'html.code.wrap' => array ('<pre class="e2-text-code"><code>', '</code></pre>'),  
  'html.code.highlightjs' => true,

  'html.img.prefix' => PICTURES_FOLDER,
  'html.img.detect' => true,

  'groups.on' => true,
  'groups.headings.char'  => '#',
  'groups.headings.plus'  => 1,
  'groups.quotes.char' => '>',
  'groups.lists.chars' => array ('-', '*'),
  'groups.generic-css-class' => 'e2-text-generic-object',
  'groups.classes' => array (
    'picture' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'e2-text-picture', 
      'max-width' => $settings['max-image-width'],
    ),
    'fotorama' => array (
      'src-prefix' => $full_blog_url .'/',
      'folder' => PICTURES_FOLDER,
      'css-class' => 'e2-text-picture',
      'max-width' => $settings['max-image-width'],
    ),
    'table' => array (
      'css-class' => 'e2-text-table',
    ),
    'onlinevideo' => array (
      'css-class' => 'e2-text-video',
      'max-width' => $settings['max-image-width'],
      'ratio' => 16/9,
    ),
    'audio' => array (
      'css-class' => 'e2-text-audio',
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

); ?>