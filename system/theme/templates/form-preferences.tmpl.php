<? // mui ?>

<? _JS ('form-preferences') ?>

<form
  action="<?= @$content['form-preferences']['form-action'] ?>"
  method="post"
>

<div class="form">

<div class="form-control">
  <div class="label input-label"><label><?= _S ('ff--language') ?></label></div>
  <select name="language" size="1">
    <? foreach ($content['form-preferences']['languages'] as $value => $lang) { ?>
    <option value="<?= $value ?>"
      <?= $lang['selected?']? 'selected="selected"':'' ?>
    ><?= $lang['display-name'] ?></option>
    <? } ?>
  </select>
</div>


<div class="form-control">
  <div class="label">
    <p><label><?= _S ('ff--theme') ?></label></p>
    <p class="help"><a href="http://blogengine.ru/help/themes/" target="_blank"><?= _S ('ff--theme-how-to') ?></a>&nbsp;<span class="i-blank"></span></p>
  </div>
  <input type="hidden"
    id="template"
    name="template"
		value="<?= $content['form-preferences']['template-name'] ?>"
  />
  
  <noscript>
  <div>
  <i><?= _S ('ff--theme-selector-wants-js') ?></i>
  </div>
  </noscript>
  
  <div id="e2-template-selector" style="display: none">
  <div class="admin-links">
  <? foreach ($content['form-preferences']['templates'] as $template) { ?>
  <div class="
    e2-template-preview<? if ($template['current?']) echo ' e2-current-template-preview' ?>
  " value="<?= $template['name'] ?>"
  >
    <img src="<?= $template['preview'] ?>" alt="<?= $template['display-name'] ?>" 
      width="100" height="120"
    /><br />
    <a class="dashed" onclick="return false"><?= $template['display-name'] ?></a>
  </div>
  <? } ?>
  </div>
  </div>
  
</div>


<div class="form-control">
  <div class="label input-label"><label><?= _S ('ff--posts') ?></label></div>
  <label><?= _S ('ff--items-per-page-before') ?>&nbsp;<input type="text"
    class="text"
    style="width: 2.33em"
    id="notes-per-page"
    name="notes-per-page"
    maxlength="3"
    value="<?= $content['form-preferences']['notes-per-page'] ?>"
    />
  <?= _S ('ff--items-per-page-after') ?>
  </label>
</div>

<div class="form-control">
  <label class="checkbox">
  <input
    type="checkbox"
    id="favourites-block"
    name="favourites-block"
    class="checkbox"
    <?= @$content['form-preferences']['favourites-block?']? ' checked="checked"' : ''?>
  /> <?= _S ('ff--show-favourites') ?>
  </label><br />
</div>


<div class="form-control">
  <div class="label"><label><?= _S ('ff--comments') ?></label></div>
  <div class="form-subcontrol-master">
    <label class="checkbox">
    <input
      type="checkbox"
      id="comments-on"
      name="comments-on"
      class="checkbox"
      <?= @$content['form-preferences']['comments-on?']? ' checked="checked"' : ''?>
    /> <?= _S ('ff--comments-enable') ?>
    </label><br />
  </div>
  
  <div id="comments-on-slaves">
    <div class="form-subcontrol-slave">
      <label class="checkbox">
      <input
        type="checkbox"
        id="comments-fresh-only"
        name="comments-fresh-only"
        class="checkbox"
        <?= @$content['form-preferences']['comments-fresh-only?']? ' checked="checked"' : ''?>
      /> <?= _S ('ff--only-for-recent-posts') ?>
      </label><br />
    </div>
    <div class="form-subcontrol-slave">
      <label class="checkbox">
      <input
        type="checkbox"
        id="hot-block"
        name="hot-block"
        class="checkbox"
        <?= @$content['form-preferences']['hot-block?']? ' checked="checked"' : ''?>
      /> <?= _S ('ff--show-hot') ?>
      </label><br />
    </div>
    <div class="form-subcontrol-slave">
      <label class="checkbox">
      <input
        type="checkbox"
        id="email-notify"
        name="email-notify"
        class="checkbox"
        <?= @$content['form-preferences']['email-notify?']? ' checked="checked"' : ''?>
      /> <?= _S ('ff--send-to-address') ?>
      </label><br />
      <input type="text"
        class="text width-2"
        id="email"
        name="email"
        value="<?= $content['form-preferences']['email'] ?>"
      /><br />
    </div>
  </div>
</div>

<div class="submit-box">
<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-preferences']['submit-text'] ?>
    <span class="keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </button>
  <!--
  <input
    type="submit"
    id="submit-button"
    tabindex="4"
    value="<?= @$content['form-preferences']['submit-text'] ?>"
  /><span class="keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span><br />
  -->
</div>
</div>


<div class="form-control">
  <div class="form-control-sublabel">
  <p class="admin-links clear"><?= _S ('ff--administration') ?>&nbsp;
  <a href="<?= @$content['admin-hrefs']['password'] ?>"><?= _S ('gs--password') ?></a>,&nbsp;
  <a href="<?= @$content['admin-hrefs']['database'] ?>"><?= _S ('gs--db-connection') ?></a></p>
  </div>
</div>



</div>

</form>