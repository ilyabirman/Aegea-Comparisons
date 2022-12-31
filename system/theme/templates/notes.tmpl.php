<? // mui ?>

<? if (@$content['pages']['timeline?']) _T ('pages-later') ?>

<? foreach ($content['notes'] as $note): ?>

<? _X ('note-pre') ?>

<div class="<?= array_key_exists ('only', $content['notes'])? 'only ': '' ?>note <?= $note['favourite?']? 'e2-note-favourite' : '' ?>">

<? // TITLE // ?>
<h1 class="<?= ($note['published?'] and !$note['future?'])? 'published' : 'draft' ?> <?= $note['visible?']? 'visible' : 'hidden' ?> e2-smart-title"><?= _A ('<a href="'. $note['href']. '">'. $note['title']. '</a>') ?>

<span class="icons">

<? if (array_key_exists ('favourite-toggle-href', $note)): ?>
<a href="<?= $note['favourite-toggle-href'] ?>" class="e2-favourite-toggle nu">
<span class="i-favourite-<?= ($note['favourite?']? 'set' : 'unset') ?>"></span></a>
<? else: ?>
<? if (@$note['favourite?']) { ?><span class="i-favourite"></span><? } ?> 
<? endif ?>

<? if (@$note['published?']): ?>

<? if (array_key_exists ('edit-href', $note)): ?>
<a href="<?= $note['edit-href'] ?>" class="nu"><span class="i-edit"></span></a>
<? endif ?>

<? if (array_key_exists ('delete-href', $note)): ?>
<a href="<?= $note['delete-href'] ?>" class="nu"><span class="i-remove"></span></a>
<? endif ?>

<? endif ?>

</span>

</h1>


<? // DATE AND TIME // ?>

<? if (@$note['published?']) { ?>

<p class="date" title="<?=_DT ('j {month-g} Y, H:i, {zone}', @$note['time'])?>"><?= _AGO ($note['time']) ?></p>

<? } else { ?>

<p class="date" title="<?=_DT ('j {month-g} Y, H:i, {zone}', @$note['time'])?> (<?=_DT ('j {month-g} Y, H:i, {zone}', @$note['last-modified'])?>)"><?=_DT ('j {month-g} Y, H:i', @$note['time'])?></p>

<? } ?>



<? // TEXT // ?>

<div class="text <?= $note['published?']? 'published' : 'draft' ?> <?= $note['visible?']? 'visible' : 'hidden' ?>">
<?=@$note['text']?>
</div>



<? // LIST OF KEYWORDS // ?>

<? if (array_key_exists ('only', $content['notes']) and array_key_exists ('tags', $note)): ?>
<div class="tags">
<?
$tags = array ();
foreach ($note['tags'] as $tag) {
  if ($tag['current?']) {
    $tags[] = '<span class="e2-marked">'. $tag['name'] .'</span>';
  } else {
    $tags[] = '<a href="'. $tag['href'] .'">'. $tag['name'] .'</a>';
  }
}
echo implode (' &nbsp; ', $tags)

?>
</div>
<? endif; ?>


<? if ($note['comments-link?']): ?>
<div class="comments-link"><span class="comments-link-icon"></span>
<? if ($note['comments-count']) { ?>
<a href="<?= $note['href'] ?>"><b><?= $note['comments-count-text'] ?></b></a><? if ($note['new-comments-count'] == 1 and $note['comments-count'] == 1) { ?>
 (<?= _S ('gs--comments-all-one-new') ?>)
<? } elseif ($note['new-comments-count'] == $note['comments-count']) { ?>
 (<?= _S ('gs--comments-all-new') ?>)
<? } elseif ($note['new-comments-count']) { ?>
 <span class="admin-links"> (<a href="<?=$note['href']?>#new"><?= $note['new-comments-count-text'] ?></a>)</span>
<? } ?>
<? } else { ?>
<a href="<?= $note['href'] ?>"><b><?= _S ('gs--no-comments') ?></b></a>
<? } ?>
</div>
<? endif ?>

<? if (!@$note['published?']): ?>
<div class="toolbar">
  <? if (array_key_exists ('edit-href', $note)) { ?>
    <a href="<?= @$note['edit-href'] ?>" class="nu"><button type="button" class="button">
      <span class="i-edit"></span> <?= _S ('fb--edit') ?>
    </button></a>
  <? } ?>
  <div class="toolbar-end"></div>
</div>
<? endif ?>

</div>

<? _X ('note-post') ?>

<? endforeach ?>

<? if (@$content['pages']['timeline?']) _T ('pages-earlier') ?>
