<? // mui ?>

<? _JS ('form-name-and-author') ?>

<form
  action="<?= @$content['form-name-and-author']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  id="e2-blog-title-default"
  name="blog-title-default"
  value="<?= @$content['form-name-and-author']['blog-title-default'] ?>"
/>

<input
  type="hidden"
  id="e2-blog-author-default"
  name="blog-author-default"
  value="<?= @$content['form-name-and-author']['blog-author-default'] ?>"
/>

<div class="form">

<div class="form-control">
  <div class="label input-label"><label><?= _S ('ff--blog-title') ?></label></div>
  <input type="text"
    class="text big width-4"
    id="blog-title"
    name="blog-title"
		value="<?= $content['form-name-and-author']['blog-title'] ?>"
  />
</div>

<div class="form-control">
  <div class="label"><label><?= _S ('ff--blog-description') ?></label></div>
	<textarea
	  class="width-4"
		style="height: 6.66em; overflow-x: hidden; overflow-y: visible"
		id="blog-description"
		name="blog-description"
	><?= @$content['form-name-and-author']['blog-description'] ?></textarea>
</div>

<div class="form-control">
  <div class="form-subcontrol">
    <div class="label input-label"><label><?= _S ('ff--blog-author') ?></label></div>
    <input type="text"
      class="text width-2"
      id="blog-author"
      name="blog-author"
      value="<?= $content['form-name-and-author']['blog-author'] ?>"
    />
  </div>
</div>

<div class="submit-box">
<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-name-and-author']['submit-text'] ?>
    <span class="keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </button>
</div>
</div>


</div>

</form>