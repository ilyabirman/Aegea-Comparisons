<?php _JS ('form-tag') ?>

<form
  action="<?= @$content['form-tag']['form-action'] ?>"
  method="post"
>                                   

<input
  type="hidden"
  name="tag-id"
  value="<?= @$content['form-tag']['.tag-id'] ?>" 
/>

<div class="form">

<div class="form-control form-control-big">
  <div class="form-label input-label"><label><?= _S ('ff--tag-name') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text big required width-2"
      autofocus="autofocus"
      id="tag"
      name="tag"
      value="<?= @$content['form-tag']['tag'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--tag-urlname') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text required width-2"
      id="urlname"
      name="urlname"
      value="<?= @$content['form-tag']['urlname'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--tag-description') ?></label></div>
  <div class="form-element">
  <textarea name="description"
    class="required e2-textarea-autosize e2-external-drop-target full-width"
    id="text"
    autocomplete="off"
    style="height: 25.2em; min-height: 25.2em; overflow-x: hidden; overflow-y: visible"
  ><?=$content['form-tag']['description']?></textarea>

    <div id="e2-uploaded-images">
    <?php foreach ($content['form-tag']['images'] as $image) { ?>
      <div class="e2-uploaded-image"><span class="e2-uploaded-image-preview"><img src="<?= $image['thumb'] ?>" alt="<?= $image['name'] ?>" /></span></div>
    <?php } ?>
    </div>

  </div>

</div>

<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-tag']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>

<?php if (array_key_exists ('delete-href', $content['form-tag'])) { ?>

<div class="form-control">
  <div class="form-element e2-toolbar">
    <?php if (array_key_exists ('delete-href', $content['form-tag'])) { ?>
      <a href="<?= @$content['form-tag']['delete-href'] ?>" class="nu"><button type="button" class="button">
        <span class="e2-svgi"><?= _SVG ('remove') ?></span> <?= _S ('ff--delete') ?>...
      </button></a>
    <?php } ?>
  </div>
</div>

<?php } ?>

</div>

</form>

