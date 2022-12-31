<div class="footer">

<? _X ('footer-pre') ?>

<div class="visual-login">
<? if (!$content['sign-in']['done?'] and !$content['sign-in']['necessary?']) { ?>
<a id="e2-visual-login" href="<?= $content['hrefs']['sign-in'] ?>" class="nu"><span class="i-login"></span></a>
<? } ?>
</div>

<? _T ('copyrights') ?>

<? _T ('engine-info') ?>

<? _X ('footer-post') ?>

</div>
