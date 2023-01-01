<?php if (array_key_exists ('tags', $content) and $content['class'] == 'tags') { ?>

<?php if ($content['tags']['many?']) { ?>

<?php /* js uses
    #e2-tag-slide - for the shaft
    #e2-tag-slider - for the lift
*/?>

<div class="e2-tag-filter" id="e2-tag-filter">
<?= _S ('gs--tags-important') ?><span id="e2-tag-slide-area" class="e2-tag-filter-slide-area"><span id="e2-tag-slide" class="e2-tag-filter-slide">
  <div class="e2-tag-filter-slide-shaft">
    <div id="e2-tag-slider" class="e2-tag-filter-slider" style="display: none"><span></span></div>
  </div>
</span></span><?= _S ('gs--tags-all') ?>
</div>

<?php } ?>

<?php /* js uses
    data-weight - for tags with specific weight
*/?>

<div class="e2-tags" id="e2-tags">
<?php foreach ($content['tags']['each'] as $tag): ?>
<a
  href="<?=@$tag['href']?>"
  class="e2-tag<?php if ($tag['weight'] == 0) { echo ' e2-tag-disused'; } ?>"
  style="opacity: <?= 0.2 + 0.8 * pow ($tag['weight'], 0.7) ?>"
  data-weight="<?= 1 + (int) ($tag['weight'] * 99)?>"
><?=@$tag['tag']?></a>
<?php endforeach ?>
</div>

<?php } ?>
