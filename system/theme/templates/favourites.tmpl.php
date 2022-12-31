<? // mui ?>

<?# if there's a list, show it #?>
<? if (array_key_exists ('each', $content['favourites'])): ?> 

<? if (_AT ($content['favourites']['href'])): ?>
<h2><?=$content['favourites']['title']?> <span class="i-favourites"></span> &rarr;</h2>
<? else: ?>
<h2><a href="<?= $content['favourites']['href'] ?>"><?=$content['favourites']['title']?></a> &#9733;</h2>
<? endif ?>

<ul class="links-list">
<? foreach ($content['favourites']['each'] as $item) { ?>
<li><? if ($item['current?']) { ?><?= $item['title'] ?> &rarr;<? } else { ?><a href="<?= $item['href'] ?>" title="<?=_DT ('j {month-g} Y, H:i', $item['time'])?>"><?= $item['title'] ?></a><? } ?></li>
<? } ?>
</ul>


<?# else just show a link #?>
<? else: ?>

<? if (_AT ($content['favourites']['href'])): ?>
<h2><?=$content['favourites']['title']?> &#9733; &rarr;</h2>
<? else: ?>
<h2><a href="<?= $content['favourites']['href'] ?>"><?=$content['favourites']['title']?></a> &#9733;</h2>
<? endif ?>

<? endif ?>