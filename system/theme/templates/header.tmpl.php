<? // mui ?>

<div class="header">

  <? _X ('header-pre') ?>

  <? if ($content['class'] != 'found') { ?>
  <? _T_FOR ('form-search') ?>
  <? } ?>

  <h1>
    <?= _A ('<a href="'. $content['blog']['href']. '"><span id="e2-blog-title">'. $content['blog']['title']. '</span></a>') ?> 
    <?
      if (
        array_key_exists ('admin-hrefs', $content)
        and array_key_exists ('name-and-author', $content['admin-hrefs'])
        and !_AT ($content['admin-hrefs']['name-and-author'] )
      ) { 
    ?>
      <a href="<?= $content['admin-hrefs']['name-and-author'] ?>" class="nu"><span class="i-edit-small"></span></a>
    <? } ?>
  </h1>

  <? if ($content['frontpage?']) {?>

  <p class="blog-description">
    <span id="e2-blog-description"><?= $content['blog']['description'] ?></span>
  </p>

  <? } ?>
  
  <? _X ('header-post') ?>
  
  <div class="header-end"></div>
  
</div>