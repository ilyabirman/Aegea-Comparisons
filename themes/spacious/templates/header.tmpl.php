<? _X ('header-pre') ?>

<div class="header">

  <h1>
    <?= _A ('<a href="'. $content['blog']['href']. '"><span id="e2-blog-title">'. $content['blog']['title']. '</span></a>') ?> 
    <?
      if (
        array_key_exists ('admin-hrefs', $content)
        and array_key_exists ('name-and-author', $content['admin-hrefs'])
        and !_AT ($content['admin-hrefs']['name-and-author'] )
      ) { 
    ?>
      <a href="<?= $content['admin-hrefs']['name-and-author'] ?>" class="nu"><span class="i-edit"></span></a>
    <? } ?>
  </h1>

  <div class="blog-menu">
  
    <? _T_FOR ('form-search') ?>
  
    <? if ($content['frontpage?']) {?>
  
      <p class="blog-description">
        <span id="e2-blog-description"><?= $content['blog']['description'] ?></span>
      </p>
    
    <? } ?>
    
    <? if ($content['content-page?']) { ?> 

      <? if (array_key_exists ('favourites', $content)) { ?> 
    
        <? if (_AT ($content['favourites']['href'])): ?>
        <?=$content['favourites']['title']?>
        <? else: ?>
        <a href="<?= $content['favourites']['href'] ?>"><?=$content['favourites']['title']?></a>
        <? endif ?>
      
          ·  
    
      <? } ?>
      
      <? if (array_key_exists ('most-commented', $content)) { ?> 
    
        <? if (_AT ($content['most-commented']['href'])): ?>
        <?=$content['most-commented']['title']?>
        <? else: ?>
        <a href="<?= $content['most-commented']['href'] ?>"><?=$content['most-commented']['title']?></a>
        <? endif ?>
      
          ·  
    
      <? } ?>    
    
      <? if ($content['tags-menu']['not-empty?']) { ?> 
    
        <? if (_AT ($content['hrefs']['tags'])): ?> 
        <?= _S ('gs--tags') ?>
        <? else: ?>
        <a href="<?= $content['hrefs']['tags'] ?>"><?= _S ('gs--tags') ?></a>
        <? endif ?>
      
          ·  
        
      <? } ?>
    
      
      <a class="rss" href="<?=@$content['blog']['rss-href']?>"><?= _S ('gs--rss') ?></a>
    
    <? } ?>
  
  </div>


</div>

<div class="clear"></div>

<? _X ('header-post') ?>
