<? // mui ?>

<? _T ('author-menu') ?>

<div class="common">

<? if ($content['content-page?'] and !$content['blog']['virgin?']) _T ('sidebar') ?>

<? _T ('header') ?>

<? _T_FOR ('message') ?>

<div class="main-content">


<? if ($content['class'] == 'found') { ?>

<div class="search-heading">
<? _T_FOR ('form-search') ?>
</div>

<? } else { ?>

<? if (array_key_exists ('superheading', $content)): ?>
<div class="super-h"><?= $content['superheading'] ?></div>
<? endif ?>

<? if (array_key_exists ('heading', $content)): ?>
<h2 id="e2-page-heading">
  
  <?= $content['heading'] ?>
  <? if (array_key_exists ('related-edit-href', $content)): ?>
  <a href="<?= $content['related-edit-href'] ?>" class="nu"><span class="i-edit"></span></a>
  <? endif ?>

</h2>
<? endif ?>

<? } ?>


<? if (array_key_exists ('search-related-tag', $content)) { ?> 
<p class="tags"><?= _S ('gs--see-also-tag') ?> <a href="<?=$content['search-related-tag']['href']?>"><?=$content['search-related-tag']['name']?></a>.</p>
<? } ?>

<? _T_FOR ('tag') ?>
<? _T_FOR ('error-404-description') ?>

<? _T_FOR ('year-months') ?>
<? _T_FOR ('month-days') ?>

<? _T ('content') ?>

</div>

<div class="clear"></div>

<? _T ('footer') ?>

</div>