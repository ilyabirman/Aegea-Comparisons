<? // mui ?>

<? if ($content['tags-menu']['not-empty?']) { ?> 

<? if (_AT ($content['hrefs']['tags'])): ?> 
<h2><?= _S ('gs--tags') ?> &rarr;</h2>
<? else: ?>
<h2><a href="<?= $content['hrefs']['tags'] ?>"><?= _S ('gs--tags') ?></a></h2>
<? endif ?>

<ul class="links-list">
<? foreach ($content['tags-menu']['each'] as $tag): ?>
<? if ($tag['current?']) { ?>
<li><?=$tag['tag']?>
  <? if ($tag['pinnable?']) { ?>
  <span class="icons"><a href="<?=$tag['pinned-toggle-href']?>" class="e2-pinned-toggle nu"><span class="i-pinned-<?= ($tag['pinned?']? 'set' : 'unset') ?>"></span></a></span>
  <? } ?>
  &rarr;
</li>
<div style="clear: left"></div>
<? } else { ?>
<li><a href="<?=@$tag['href']?>"><?=@$tag['tag']?></a></li>
<? } ?>
<? endforeach ?>
</ul>

<? } else { ?>

<? if (_AT ($content['hrefs']['tags'])): ?> 
<p><?= _S ('gs--tags') ?> &rarr;</p>
<? else: ?>
<p><a href="<?= $content['hrefs']['tags'] ?>"><?= _S ('gs--tags') ?></a></p>
<? endif ?>

<? } ?>