<? // mui ?>

<? foreach ($content['notes-list'] as $note): ?>
<p>
  <a href="<?= $note['href'] ?>" title=""><?= $note['title']?></a>
  <? if (array_key_exists ('text-fragment', $note)) { ?>
  &nbsp; <?= $note['text-fragment']?>
  <? } ?>
</p>
<? endforeach; ?>