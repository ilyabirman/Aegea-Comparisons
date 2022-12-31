<? // mui ?>

<? if ($content['sign-in']['done?']): ?>

<div class="center">
  <p><?= _S ('gs--preview-of-future-blog') ?></p>
  
  <p><img src="<?= _IMGSRC ('screenshot.jpg') ?>" width="569" height="548" style="margin: 0 -20px" /></p>
</div>

<? else: ?>

<div class="center">
  <!--
  <span class="i-nothing"></span>
  -->
  <img src="<?= _IMGSRC ('nothing.png')?>" alt="" width="300" height="300" />
</div>

<? endif ?>