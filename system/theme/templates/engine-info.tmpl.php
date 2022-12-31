<? // mui ?>

<div class="engine-info">
<?# please do not remove: #?>
<?=$content['engine']['about']?>

<? if ($content['sign-in']['done?']) { ?>
&nbsp;&nbsp;&nbsp;
<span title="<?= _S ('gs--pgt') ?>"><?=$content['engine']['pgt']?> <?= _S ('gs--seconds-contraction') ?></span>
<? } ?>

</div>
