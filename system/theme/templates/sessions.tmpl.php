<? // mui ?>

<? if (count ($content['sessions']['each'])): ?>

<p><?= _S ('gs--sessions-description') ?></p>

<table class="e2-sessions" id="e2-files" cellspacing="0">

<thead>
<tr valign="baseline">
  <th align="left"><?= _S ('gs--sessions-browser-or-device') ?></th>
  <th align="left"><?= _S ('gs--sessions-when') ?></th>
  <th align="left"><?= _S ('gs--sessions-from-where') ?></th>
<tr>
</thead>

<tbody>
<? foreach ($content['sessions']['each'] as $session): ?>
<tr valign="baseline" class="e2-table-row<?= $session['current?']? ' e2-current-session' : '' ?>">
  <td><span class="relative"><div class="e2-balls">&nbsp;<?= $session['current?']? '&bull;' : '' ?></div></span><span title="<?= $session['user-agent'] ?>"><?= $session['title'] ?></span></td>
  <td><span title="<?=_DT ('j {month-g} Y, H:i', $session['opened'])?>"><?= _AGO ($session['opened']) ?></span></td>
  <td><?= $session['source'] ?></td>
<tr>
<? endforeach ?>

</tbody>

</table>

<p></p>

<? endif ?>
