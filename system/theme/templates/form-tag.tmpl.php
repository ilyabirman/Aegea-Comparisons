<? // mui ?>

<? _JS ('form-tag') ?>

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

<div class="form-control">
  <div class="label"><label><?= _S ('ff--tag-name') ?></label></div>
  <input type="text"
    class="text big required width-2"
    id="tag"
    name="tag"
    value="<?= @$content['form-tag']['tag'] ?>"
  />
</div>

<div class="form-control">
  <div class="label"><label><?= _S ('ff--tag-urlname') ?></label></div>
  <input type="text"
    class="text required width-2"
    id="urlname"
    name="urlname"
    value="<?= @$content['form-tag']['urlname'] ?>"
  />
</div>

<div class="form-control">
  <div class="label"><label><?= _S ('ff--tag-description') ?></label></div>
  <textarea name="description"
    class="width-4"
    id="text"
    style="height: 10em; overflow-x: hidden; overflow-y: visible"
  ><?=$content['form-tag']['description']?></textarea>
</div>

<div class="submit-box">
<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-tag']['submit-text'] ?>
    <span class="keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </button>
</div>
</div>

<? if (array_key_exists ('delete-href', $content['form-tag'])) { ?>

<div class="form-control">
  <div class="toolbar">
    <? if (array_key_exists ('delete-href', $content['form-tag'])) { ?>
      <a href="<?= @$content['form-tag']['delete-href'] ?>"><button type="button" class="button">
        <span class="i-remove"></span> <?= _S ('ff--delete') ?>...
      </button></a>
    <? } ?>
    <div class="toolbar-end"></div>
  </div>
</div>
<? if (@$content['form-note']['note']['published?']) { ?>
<? } ?>


<? } ?>

</div>

</form>

