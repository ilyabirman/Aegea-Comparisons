<? // mui ?>

<? if ($content['tags']['many?']) { ?>

<? _JS ('tags') ?>

<?/* js uses
    #e2-tag-slide - for the shaft
    #e2-tag-slider - for the lift
*/?>

<div id="e2-tag-filter" class="tags-filter">
<?= _S ('gs--tags-important') ?><span id="e2-tag-slide-area" class="tags-filter-slide-area"><span id="e2-tag-slide" class="tags-filter-slide">
  <div class="tags-filter-slide-shaft">
    <div id="e2-tag-slider" class="tags-filter-slider" style="display: none"><span></span></div>
  </div>
</span></span><?= _S ('gs--tags-all') ?>
</div>

<? } ?>

<?/* js uses
    .e2-tag-weight-X - for tags with specific weight
*/?>

<div class="tags">
<? foreach ($content['tags']['each'] as $tag): ?>
<span class="tag e2-tag-weight-<?= 1 + (int) ($tag['weight'] * 99)?>">
<a
  href="<?=@$tag['href']?>"
  style="opacity: <?= 0.2 + 0.8 * pow ($tag['weight'], 0.7) ?>"
  <? if ($tag['weight'] == 0): ?> class="tag-never-used" <? endif ?>
><?=@$tag['tag']?></a>
</span>
<? endforeach ?>
</div>
