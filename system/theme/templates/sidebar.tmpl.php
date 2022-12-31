<? // mui ?>

<div class="sidebar">

<? _T ('user-picture') ?>

<? _X ('sidebar-pre') ?>

<div class="sidebar-element tags">
<? _T_FOR ('tags-menu') ?>
</div>

<div class="sidebar-element">
<? _T_FOR ('favourites') ?>
</div>

<div class="sidebar-element">
<? _T_FOR ('most-commented') ?>
</div>

<div class="sidebar-element">
<a class="rss" href="<?=@$content['blog']['rss-href']?>"><?= _S ('gs--rss') ?></a>
</div>



<? _X ('sidebar-post') ?>


<? if ($content['sign-in']['done?']) { ?>
<div class="sidebar-element">
<p class="help"><a href="http://blogengine.ru/help/extras/" target="_blank"><?= _S ('ff--changing-sidebar') ?></a>&nbsp;<span class="i-blank"></span></p>
</div>
<? } ?>

</div>
