<? // mui ?>

<? _JS ('form-password') ?>

<form
  action="<?= @$content['form-password']['form-action'] ?>"
  method="post"
  class="e2-enterable"
>

<div class="form">

<div class="form-control">
  <div class="icon">
    <span class="i-lock"></span>
  </div>
  <input type="text"
    class="text required width-2"
    id="password"
    name="password"
		value=""
  />
  <div class="form-control-sublabel"><?= _S ('ff--displayed-as-plain-text') ?></div>
</div>


<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-password']['submit-text'] ?>
  </button>
</div>

</div>

</form>
