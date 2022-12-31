<? // mui ?>

<? if ($content['pages']['later-href'] and $content['pages']['later-title']): ?>

<div class="pages">
  <span class="keyboard-shortcut"><?= _SHORTCUT ('navigation-later') ?></span>
  <a href="<?= $content['pages']['later-href'] ?>"><?= $content['pages']['later-title'] ?></a><br />
  <? if ($content['pages']['later-jump?']) { ?>...<br /><? } ?>
</div>

<? endif ?>