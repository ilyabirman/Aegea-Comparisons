<? // mui ?>

<div class="form-search">

<? if (!array_key_exists ('form', $content)) { ?>

<form
  id="e2-form-search"
  class="e2-enterable"
  action="<?= @$content['form-search']['form-action'] ?>"
  method="post"
  accept-charset="utf-8"
>

<div>

  <label>
    <span class="i-loupe"></span>
  	<input type="search" class="text" name="query" id="query"
  		value="<?= @$content['form-search']['query'] ?>"
  	/>
    <button type="submit"><span class="i-enter"></span></button>
  </label>

</div>

</form>

<? } ?>

</div>
