<?php foreach ($content['drafts'] as $draft) { ?>

<div class="e2-draft-preview">
<a href="<?= $draft['href'] ?>" class="e2-admin-link nu">
  <div class="e2-draft-preview-box">
    <div class="e2-draft-preview-content">
    <?php if (array_key_exists ('image-href', $draft)) { ?>
      <img src="<?= $draft['image-href']?>" width="<?= $draft['image-width']?>" height="<?= $draft['image-height']?>" alt="" />
    <?php } ?>
    <div class="e2-draft-preview-text">
      <?= $draft['text-fragment']?>
    </div>
    </div>
  </div>
  <u><?= $draft['title']?></u>
</a>
</div>

<?php } ?>