<? _T ('author-menu') ?>

<div class="common">

<? _T ('header') ?>

<div class="top-line"></div>

<? _T_FOR ('message') ?>

<div class="nowrap-children">

<?
  if (
    array_key_exists ('favourites', $content) and array_key_exists ('each', $content['favourites'])
    or
    array_key_exists ('most-commented', $content) and array_key_exists ('each', $content['most-commented'])
  ):
?> 
<? _T_FOR ('sidebar') ?>
<? endif ?>

<div class="main-content">

<? if (array_key_exists ('tags', $content)): ?>
<? endif ?>

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

<? if (@$content['search-related-tag']) { ?> 
<p class="tags"><small><?= _S ('gs--see-also-tag') ?> <a href="<?=@$content['search-related-tag']['href']?>"><?=@$content['search-related-tag']['name']?></a>.</small></p>
<? } ?>

<? _T_FOR ('tag') ?>
<? _T_FOR ('error-404-description') ?>

<? _T_FOR ('year-months') ?>
<? #_T_FOR ('month-days') ?>

<? _T ('content') ?>

<? #_T_FOR ('pages') ?>

</div>

</div>

<div class="clear"></div>






<? #_T ('pre-footer') ?>

<? _T ('footer') ?>

</div>
