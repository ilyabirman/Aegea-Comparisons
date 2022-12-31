<? _JS ('form-install') ?>
<? _CSS ('install') ?>

<? if ($content['form-install']['installation-possible?']) { ?>

<div class="sunglass" style="display: none">
<div class="sunglass-text">
  <h1><?= _S ('pt--installer-loading') ?></h1>
</div>
</div>

<script>if ($) $ ('.sunglass').show () </script>

<? } ?>

<div class="installer-picture">
  <i class="i-lemon"></i>
</div>


<div class="installer-title">

  <h1>
    <? if (array_key_exists ('heading', $content)): ?>
    <?= $content['heading'] ?>
    <? endif ?>
  </h1>

</div>

<div class="clear"></div>

<? _T_FOR ('message') ?>

<? if ($content['form-install']['installation-possible?']) { ?>

<div class="main-content">

<form
  id="form-install"
  action="<?= @$content['form-install']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  id="gmt-offset"
  name="gmt-offset"
  value="unknown"
/>

<script>
d = new Date ()
document.getElementById ('gmt-offset').value = - d.getTimezoneOffset()
</script>

<a id="e2-check-db-config-action" href="<?= $content['form-install']['form-check-db-config-action'] ?>"></a>
<a id="e2-list-databases-action" href="<?= $content['form-install']['form-list-databases-action'] ?>"></a>

<div class="form">

<div class="form-part">

<h3><?= _S ('gs--database') ?></h3>

<div class="form-control">
  <div class="label">
    <label><?= _S ('ff--db-host')?></label>
  </div>
  <div class="icon">
    <span class="i-loading ajaxload" id="db-server-checking" style="display: none"></span>
  </div>
  <input type="text"
    style="width: 75%"
    name="db-server"
    id="db-server"
    class="text input-editable livecheckable db-server-ok db-user-password-ok db-database-ok db-everything-ok"
    value="<?= @$content['form-install']['db-server'] ?>"
  />
</div>

<div class="form-control">
  <div class="form-subcontrol">
    <div class="label">
      <label><?= _S ('ff--db-username-and-password')?></label>
    </div>
    <div class="icon">
      <span class="i-loading ajaxload" id="db-user-checking" style="display: none"></span>
    </div>
    <input type="text"
      style="width: 50%"
      name="db-user"
      id="db-user"
      class="text input-editable livecheckable db-user-password-ok db-database-ok db-everything-ok"
      value="<?= @$content['form-install']['db-user'] ?>"
    />
  </div>
  <div class="form-subcontrol">
    <div class="icon">
      <span class="i-loading ajaxload" id="db-password-checking" style="display: none"></span>
    </div>
    <input type="text"
      style="width: 50%"
      name="db-password"
      id="db-password"
      class="text input-editable livecheckable db-user-password-ok db-database-ok db-everything-ok"
      value="<?= @$content['form-install']['db-password'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="label">
      <label><?= _S ('ff--db-name')?></label>
  </div>
  <div class="icon">
    <span class="i-loading ajaxload" id="db-database-checking" style="display: none"></span><span class="i-loading ajaxload" id="db-database-list-checking" style="display: none"></span>
  </div>
  <input type="text"
    style="width: 50%"
    name="db-database"
    id="db-database"
    class="text input-editable livecheckable db-database-ok db-everything-ok"
    value="<?= @$content['form-install']['db-database'] ?>"
  />
  <select id="db-database-list" name="db-database-selected"
    class="livecheckable verified db-database-ok db-everything-ok"
    style="width: 50%; display: none" size="1">
  </select>
</div>

<div class="form-control">
  <label class="checkbox">
  <input
    type="checkbox"
    id="db-exists"
    name="db-exists"
    class="checkbox"
    <?= @$content['form-install']['db-exists?']? ' checked="checked"' : ''?>
  />&nbsp;<?= _S ('ff--just-connect')?>
  </label><br />
</div>

<div class="form-control">
  <div class="label">
    <label><?= _S ('ff--db-prefix')?></label>
  </div>
  <div class="icon">
    <span class="i-loading ajaxload" id="db-prefix-checking" style="display: none"></span>
  </div>
  <input type="text"
    style="width: 25%"
    name="db-prefix"
    id="db-prefix"
    class="text input-editable livecheckable db-everything-ok"
    value="<?= @$content['form-install']['db-prefix'] ?>"
  />
  <span class="input-remark wrong" id="db-prefix-occupied" style="display: none"><?= _S ('ff--prefix-occupied')?></span>
  <span class="input-remark wrong" id="db-prefix-not-found" style="display: none"><?= _S ('ff--tables-not-found')?></span>
</div>

</div>

<div class="form-part">

<h3><?= _S ('gs--password-for-blog') ?></h3>

<div class="form-control">
  <div class="icon"><span class="i-lock"></span></div>
  <input type="text" class="text input-editable" style="width: 50%" name="password" id="password"
  />
</div>


<div class="submit-box">
<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-install']['submit-text'] ?>
    <span class="keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </button>
</div>
</div>

</div>

</div>

</div>

</form>

</div>

<? } ?>


<div class="engine-info">
<?=$content['engine']['about']?> <small><?=$content['engine']['version']?></small>
</div>

<div class="bottom-spacer">
</div>
