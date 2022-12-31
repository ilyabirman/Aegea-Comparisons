<? // mui

if (
  array_key_exists ('admin-hrefs', $content) and (
    array_key_exists ('new-note', $content['admin-hrefs']) or
    array_key_exists ('drafts', $content['admin-hrefs'])
  )
):

?>

<div class="admin-menu admin-links" id="e2-author-menu">
  <div class="admin-menu-writing-and-comments">

    
    <? # NEW # ?>
    
    <? if (_AT ($content['admin-hrefs']['new-note'])) { ?>
      
    <span class="admin-menu-new-selected e2-admin-menu-new-selected">
      <b><span class="i-new"></span><?= _S ('ln--new-post') ?></b>
    </span>
    <span class="admin-menu-new e2-admin-menu-new" style="display: none">
      <b>
        <a href="<?= $content['admin-hrefs']['new-note'] ?>"><span class="i-new"></span><?= _S ('ln--new-post') ?></a>
      </b>
    </span>
        
    
    <? } else { ?>
      
    <span class="admin-menu-new">
      <b>
        <a href="<?= $content['admin-hrefs']['new-note'] ?>"><span class="i-new"></span><?= _S ('ln--new-post') ?></a>
      </b>
    </span>
        
    <? } ?>


    <? # DRAFTS # ?>
    
    <? if (array_key_exists ('drafts', $content['admin-hrefs'])) { ?>
      
    &nbsp;&nbsp;&nbsp;

    <span class="admin-menu-drafts" id="e2-drafts-item"
       <?= ((
         array_key_exists ('drafts-count', $content['blog']) and
         $content['blog']['drafts-count'] > 0
       )? '' : ' style="display: none"') ?>
    >
      <span id="e2-drafts">
        <b><?=
          _A (
            '<a href="'. $content['admin-hrefs']['drafts'] .'">'. _S ('ln--drafts') .'</a>'
          )
        ?></b>
        <span class="count" id="e2-drafts-count"><?= $content['blog']['drafts-count'] ?></span>
      </span>
    </span>
    
    <? } ?>

    &nbsp;&nbsp;&nbsp;

    <? # COMMENTS # ?>
      
    <? if (array_key_exists ('new-comments', $content)) { ?>
    <span class="admin-menu-comments">
      <a href="<?= @$content['new-comments']['href'] ?>"><span class="admin-menu-comments-tail"></span><span class="admin-menu-comments-balloon">+<?= $content['new-comments']['count'] ?></span></a>
    </span>
    <?= @$content['new-comments']['texts'] ?>
    <? } ?>
    
  </div>
  
  <div class="admin-menu-service">
  
    <span class="admin-menu-comments-fadeout"></span>
    
    <? if (array_key_exists ('admin-hrefs', $content)): ?>
    <span class="admin-links">

    <? if ($content['sessions']['multiple?']): ?>
      <span class="admin-menu-service-item">
      <?=
        _A (
          '<a href="'. $content['admin-hrefs']['sessions'] .'" class="nu"><span class="i-sessions"></span></a>'
        )
      ?><span class="tsp">&nbsp;</span><span class="count"><?= $content['sessions']['count'] ?></span>
      </span>
    <? endif ?>

    
    <? # SETTINGS # ?>
      
    <? if (array_key_exists ('settings', $content['admin-hrefs'])) { ?>
      <span class="admin-menu-service-item">
      <?=
        _A (
          '<a href="'. $content['admin-hrefs']['settings'] .'" class="nu"><span class="i-settings"></span></a>'
        )
      ?>
      </span>
    <? } ?>


    <? # LOGOUT # ?>

    <? if (array_key_exists ('logout', $content['admin-hrefs'])): ?>
      <form action="<?= $content['admin-hrefs']['logout'] ?>" method="post"><button type="submit" class="button   submit-button"><?= _S ('fb--sign-out') ?></button></form>
    <? endif ?>
    
    </span>
    <? endif ?>
    
  </div>
  
</div>

<? endif ?>