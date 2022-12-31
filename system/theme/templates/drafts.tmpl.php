<? // mui ?>

<? foreach ($content['drafts'] as $draft) { ?>

<div class="e2-draft-preview">
<a href="<?= $draft['href'] ?>" title="">
  <div class="e2-draft-preview-box">
    <div class="e2-draft-preview-text">
    <? if (array_key_exists ('image-href', $draft)) { ?>
      <img src="<?= $draft['image-href']?>" /><br />
    <? } ?>
    <?= $draft['text-fragment']?>
    </div>
  </div>
  <div>
    <u><?= $draft['title']?></u>
  </div>
</a>
</div>

<? } ?>