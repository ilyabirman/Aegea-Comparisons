<? // mui ?>

<? if ($content['notes']['only']['comments-count']) { ?>

<h3 class="comments-heading">

<span id="e2-comments-count"><?= $content['notes']['only']['comments-count-text'] ?></span>
<? if ($content['notes']['only']['new-comments-count'] == 1 and $content['notes']['only']['comments-count'] == 1) { ?>
 (<?= _S ('gs--comments-all-one-new') ?>)
<? } elseif ($content['notes']['only']['new-comments-count'] == $content['notes']['only']['comments-count']) { ?>
 (<?= _S ('gs--comments-all-new') ?>)
<? } elseif ($content['notes']['only']['new-comments-count']) { ?>
 <span class="admin-links"> (<a href="<?=$content['current-href']?>#new" class="dashed"><?= $content['notes']['only']['new-comments-count-text'] ?></a>)</span>
<? } ?>

</h3>

<? } ?>