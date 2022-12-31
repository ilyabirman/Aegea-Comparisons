<? // mui ?>

<p class="month-days">

<? foreach ($content['month-days'] as $day): ?>
<? if ($day['this?']): ?>
<span class="month-day current"><?= _DT ('j', $day['start-time']) ?></span>
<? elseif ($day['fruitful?']): ?>
<span class="month-day"><a href="<?= $day['href'] ?>"><?= _DT ('j', $day['start-time']) ?></a></span>
<? elseif ($day['real?']): ?>
<span class="month-day"><?= _DT ('j', $day['start-time']) ?></span>
<? else: ?>
<span class="month-day unexistent"><?= _DT ('j', $day['start-time']) ?></span>
<? endif; ?>

<? endforeach ?>

</p>