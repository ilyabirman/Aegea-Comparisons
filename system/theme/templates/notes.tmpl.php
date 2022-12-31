<?php if (@$content['pages']['timeline?']) _T ('pages-later') ?>

<?php foreach ($content['notes'] as $note): ?>

<?php _X ('note-pre') ?>

<div class="<?= array_key_exists ('only', $content['notes'])? 'e2-only ': '' ?>e2-note <?= $note['favourite?']? 'e2-note-favourite' : '' ?> <?= $note['visible?']? '' : 'e2-hidden' ?> <?= $note['playlist?']? 'jouele-playlist' : '' ?>">


<span class="admin-links admin-links-floating admin-links-sticky">

<?php if (array_key_exists ('edit-href', $note)): ?>

<?php if (array_key_exists ('favourite-toggle-href', $note)) { ?>
<span class="admin-links admin-icon"><a href="<?= $note['favourite-toggle-href'] ?>" class="nu e2-favourite-toggle <?= ($note['favourite?']? 'e2-toggle-on' : '') ?>">
<span class="e2-svgi"><span class="e2-toggle-state-off"><?= _SVG ('favourite-off') ?></span><span class="e2-toggle-state-on"><?= _SVG ('favourite-on') ?></span></span></a></span>
<?php } ?><span class="admin-icon"><a href="<?= $note['edit-href'] ?>" class="nu e2-edit-link"><span class="e2-svgi"><?= _SVG ('edit') ?></span></a></span>
<?php endif ?>

</span>

<article>

<?php // TITLE // ?>
<h1 class="<?= ($note['published?'] and !$note['future?'])? 'e2-published' : 'e2-draft' ?> e2-smart-title">
<?php if (@$note['favourite?'] and !$content['sign-in']['done?']) { ?>
<?= _A ('<a href="'. $note['href']. '"><span class="favourite">'. $note['title']. '</span></a>') ?>
<?php } else { ?>
<?= _A ('<a href="'. $note['href']. '">'. $note['title']. '</a>') ?>
<?php } ?>
</h1>



<?php // TEXT // ?>

<div class="e2-note-text e2-text <?= $note['published?']? 'e2-published' : 'e2-draft' ?>">
<?=@$note['text']?>
</div>

</article>

<?php // LIKES // ?>

<?php if (array_key_exists ('only', $content['notes'])) { ?>
<?php if ($note['shareable?']) { ?> 
<?php if ($note['published?'] and !$note['future?']) { ?> 

<?php _LIB ('likely') ?>
<div class="e2-note-likes">
<div class="likely" data-url="<?= $note['href-original'] ?>" data-title="<?= strip_tags ($note['title']) ?>">

<?php foreach ($note['share-to'] as $network => $network_info) { ?>
<?php if ($network_info['share?']) { ?>
<?php 
  $additional = '';
  if ($network_info['data']) {
    foreach ($network_info['data'] as $k => $v) {
      $additional .= ' data-'. $k .'="'. $v .'"';
    }
  }
?>

<div class="<?= $network ?>" <?= $additional ?>><?= _S ('sn--'. $network .'-verb') ?></div>

<?php } ?>
<?php } ?>

</div>
</div>

<?php } ?>
<?php } ?>
<?php } ?>




<?php // LIST OF KEYWORDS // ?>

<?php if (array_key_exists ('tags', $note)): ?>
<div class="e2-note-tags">
<span class="e2-timestamp" title="<?=_DT ('j {month-g} Y, H:i, {zone}', @$note['time'])?>"><?= _AGO ($note['time']) ?></span> &nbsp;
<?php 
$tags = array ();
foreach ($note['tags'] as $tag) {
  if ($tag['current?']) {
    $tags[] = '<span class="e2-tag e2-marked">'. $tag['name'] .'</span>';
  } else {
    $tags[] = '<a href="'. $tag['href'] .'" class="e2-tag">'. $tag['name'] .'</a>';
  }
}
echo implode (' &nbsp; ', $tags)

?>
</div>
<?php endif; ?>


<?php // COMMENTS LINK // ?>

<?php if ($note['comments-link?']): ?>
<div class="e2-note-comments-link">
<?php if ($note['comments-count']) { ?><a href="<?= $note['href'] ?>"><?= $note['comments-count-text'] ?></a><?php if ($note['new-comments-count'] == 1 and $note['comments-count'] == 1) { ?>, <?= _S ('gs--comments-all-one-new') ?><?php } elseif ($note['new-comments-count'] == $note['comments-count']) { ?>, <?= _S ('gs--comments-all-new') ?><?php } elseif ($note['new-comments-count']) { ?> · <span class="admin-links"><a href="<?=$note['href']?>#new"><?= $note['new-comments-count-text'] ?></a></span>
<?php } ?>
<?php } else { ?>
<a href="<?= $note['href'] ?>"><?= _S ('gs--no-comments') ?></a>
<?php } ?>
</div>
<?php endif ?>

</div>

<?php _X ('note-post') ?>

<?php endforeach ?>

<?php if (@$content['pages']['timeline?']) _T ('pages-earlier') ?>