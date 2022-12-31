<? // mui ?>

<p class="year-months">
<? foreach ($content['year-months'] as $month): ?>
<? if ($month['fruitful?']): ?>
<a href="<?= $month['href'] ?>"><?=  (_DT ('{month}', $month['start-time'])) ?></a>
<? elseif ($month['real?']): ?>
<?=  (_DT ('{month}', $month['start-time'])) ?>
<? else: ?>
<span class="unexistent"><?=  (_DT ('{month}', $month['start-time'])) ?></span>
<? endif; ?> &nbsp;

<? endforeach ?>
</p>