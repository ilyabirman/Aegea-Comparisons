<? _X ('header-pre') ?>

<div class="header">

  <h1>
    <?= _A ('<a href="'. $content['blog']['href']. '"><span id="e2-blog-title">'. $content['blog']['title']. '</span></a>') ?>
  </h1>

  <p class="blog-description">
    <span id="e2-blog-description"><?= $content['blog']['description'] ?></span>
    <?
      if (
        array_key_exists ('admin-hrefs', $content)
        and array_key_exists ('name-and-author', $content['admin-hrefs'])
        and !_AT ($content['admin-hrefs']['name-and-author'] )
      ) { 
    ?>
      <a href="<?= $content['admin-hrefs']['name-and-author'] ?>" class="nu"><span class="i-edit-small"></span></a>
    <? } ?>
  </p>


</div>

<div class="clear"></div>

<? _X ('header-post') ?>
