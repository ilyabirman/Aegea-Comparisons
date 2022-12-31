<? // mui ?>

<? if ($content['pages']['earlier-href'] and $content['pages']['earlier-title']): ?>

<div class="pages">
  <? if ($content['pages']['earlier-jump?']) { ?>...<br /><? } ?>
  <span class="keyboard-shortcut"><?= _SHORTCUT ('navigation-earlier') ?></span>
  <a href="<?= $content['pages']['earlier-href'] ?>"><?= $content['pages']['earlier-title'] ?></a><br />
</div>

<? endif ?>
