<? // mui ?>

<form
  action="<?= $content['form-login']['form-action'] ?>"
  method="post"
  class="form-login e2-enterable <? if (!$content['sign-in']['necessary?']) { ?>e2-hideable<? } ?>"
  id="form-login"
  <?= $content['sign-in']['necessary?']? '' : 'style="display: none"' ?>
>

<a id="e2-check-password-action" href="<?= $content['form-login']['form-check-password-action'] ?>"></a>
  
<? if ($content['sign-in']['necessary?']): ?>
<div class="sunglass">
</div>
<div class="sunglass-text">
	<? if (array_key_exists ('sign-in-prompt', $content)) { ?>
	<h1>&uarr;<br /><?= $content['sign-in-prompt'] ?></h1>
	<? } ?>
	<p><?= _A ('<a href="'. $content['blog']['href']. '">'. _S ('gs--frontpage') .'</a>') ?></p>
</div>
<? endif ?>

<div class="login-sheet-wrapper" id="e2-login-sheet">

<div class="login-sheet">

<input type="text" name="login" value="<?= $content['form-login']['login-name'] ?>" style="display: none" />

<table width="100%" cellpadding="0" cellspacing="0" border="0">

<tr height="10">
	<td width="40" rowspan="6">&nbsp;</td><td></td>
	<td width="10" rowspan="6">&nbsp;</td><td></td>
	<td width="80" rowspan="6">&nbsp;</td>
</tr>

<tr valign="middle">
	<td><span class="i-lock"></span></td>
	<td><input type="password" name="password" id="e2-password" class="input-disableable" style="width: 100%" /></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<label><input type="checkbox"
			class="checkbox input-disableable"
			name="is_public_pc"
			id="is_public_pc"
			<?= $content['form-login']['public-pc?']? ' checked="checked"' : '' ?>
		/>&nbsp;<?= _S ('ff--public-computer') ?></label>
	</td>
</tr>

<tr height="10"></tr>

<tr>
	<td>&nbsp;</td>
	<td>
	  <button type="submit" id="login-button" class="button submit-button sign-in-button input-disableable">
      <?= _S ('fb--sign-in') ?>
    </button>
    &nbsp;&nbsp;&nbsp;
    <span id="password-checking" class="i-loading" style="display: none"></span><span id="password-correct" class="i-tick" style="display: none"></span>
	</td>
</tr>

</table>
</div>

<div class="login-sheet-bottom"></div>

</div>

</form>