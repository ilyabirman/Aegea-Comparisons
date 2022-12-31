<? // mui

$larr = $rarr = '';

if ($content['pages']['prev-href']) {
	$prev_link = '<a href="'. $content['pages']['prev-href'] .'">'. $content['pages']['prev-title'] .'</a>';
	if ($content['pages']['prev-jump?']) $prev_link = $prev_link .'&nbsp;&nbsp;.&nbsp;.&nbsp;.';
	$larr = '&larr;';
} else {
	$prev_link = '<span class="unexistent">'. strip_tags ($content['pages']['prev-title']) .'</span>';
	$larr = '<span class="unexistent">&larr;</span>';
}

if ($content['pages']['next-href']) {
	$next_link = '<a href="'. $content['pages']['next-href'] .'">'. $content['pages']['next-title'] .'</a>';
	if ($content['pages']['next-jump?']) $next_link = '.&nbsp;.&nbsp;.&nbsp;&nbsp;'. $next_link;
	$rarr = '&rarr;';
} else {
	$next_link = '<span class="unexistent">'. strip_tags ($content['pages']['next-title']) .'</span>';
	$rarr = '<span class="unexistent">&rarr;</span>';
}

?>

<? #if (!array_key_exists ('count', $content['pages']) or ($content['pages']['count']) > 1): ?>
<? if (!@$content['pages']['timeline?']):?>
<div class="pages">

<? if ($content['pages']['prev-title'] or $content['pages']['next-title']): ?>
<div class="pages-prev-next">
<table cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td><?= $prev_link ?></td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td><?= $larr ?></td>
<td>&nbsp;</td>
<td><span class="keyboard-shortcut"><?= _SHORTCUT ('navigation') ?></span></td>
<td>&nbsp;</td>
<td><?= $rarr ?></td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td><?= $next_link ?></td>
</tr>
</table>
</div>
<? endif ?>

</div>
<? endif ?>
