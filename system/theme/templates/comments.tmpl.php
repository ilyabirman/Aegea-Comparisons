<? // mui ?>

<div class="comments">

<? if (array_key_exists ('comments', $content)) { ?>

<? if (!array_key_exists ('only', $content['comments'])) { ?>
<? _T ('comments-heading'); ?>
<? } ?>


<? # THE COMMENTS # ?>

<? foreach ($content['comments'] as $comment): ?>


<? if ($comment['first-new?']) { ?><a name="new"></a><? } ?>
      
<div class="comment-and-reply">

<div class="<?= $comment['spam-suspect?']? 'spam' : '' ?> <?= $comment['visible?']? 'visible' : 'hidden' ?>">

  <div class="comment e2-comment-control-group">
    
    <div class="comment-meta-area">
      <div>
      
      <span
        class="comment-author"
        title="<?= _DT ('j {month-g} Y, H:i, {zone}', $comment['time']) ?>"
      >
      <span class="e2-markable <? if (@$comment['important?']) echo 'e2-marked' ?>"><?= @$comment['name'] ?></span>
      </span>
      
    
      <span class="e2-comment-actions">
        <? if (array_key_exists ('important-toggle-href', $comment)): ?><a href="<?= $comment['important-toggle-href'] ?>" class="e2-important-toggle nu"><span class="i-important-<?= ($comment['important?']? 'set' : 'unset') ?>"></span></a><? endif ?>
      </span>
      
      </div>
      
      <div class="meta" style="display: none">
      <span class="admin-links">
  
      <? if (array_key_exists ('ip-href', $comment)): ?><a href="<?=$comment['ip-href']?>"><?=$comment['ip']?></a><? endif; ?>
  
      </span>
      </div>
      
    </div>
  
    <div class="comment-content-area">
  
      <div class="comment-actions-removed admin-links" style="display: none">
  
      <? if (array_key_exists ('removed-toggle-href', $comment)): ?>
      <a href="<?= $comment['removed-toggle-href'] ?>" class="e2-removed-toggle dashed"><small><?= _S ('gs--comment-restore') ?></small></a>
      <? endif; ?>
      
      </div>
      
      <div class="comment-content <?= $comment['visible?']? 'visible' : 'hidden' ?>">
      <?=@$comment['text']?>
    
      <? if ($comment['visible?'] and !$comment['replying?'] and array_key_exists ('reply-href', $comment)): ?><a href="<?= $comment['reply-href'] ?>" class="nu"><span class="i-reply"></span></a><? endif; ?><? if (array_key_exists ('email', $comment)): ?><a href="mailto:<?=@$comment['email']?>" class="nu"><span class="i-email<?= (@$comment['subscriber?']? '-subscribed' : '') ?>"></span></a><? endif; ?>
      
      </div>
        
    </div>

    <? if (array_key_exists ('edit-href', $comment) or array_key_exists ('removed-toggle-href', $comment)): ?>
    <div class="comment-control-area">
      <span class="comment-secondary-controls e2-comment-actions">
        <? if (array_key_exists ('edit-href', $comment)): ?><a href="<?= $comment['edit-href'] ?>" class="nu"><span class="i-edit-small"></span></a><? endif ?><? if (array_key_exists ('removed-toggle-href', $comment)): ?><a href="<?= $comment['removed-toggle-href'] ?>" class="e2-removed-toggle nu"><span class="i-remove"></span></a><? endif ?>
      </span>
      <span class="i-loading e2-removed-toggling" style="display: none"></span>
    </div>
    <? endif ?>
  
    <div class="clear"></div>
  
  </div>

  <? if (@$content['form'] != 'form-comment-reply' and $comment['replied?']) { ?>

  <div class="comment e2-comment-control-group reply <?#= $comment['reply-visible?']? 'visible' : 'hidden' ?>">

    <div class="comment-meta-area">
      <div>
    
      <span
        class="comment-author"
        title="<?= _DT ('j {month-g} Y, H:i, {zone}', @$comment['reply-time']) ?>"
      >
        <span class="e2-markable <? if (@$comment['reply-important?']) echo 'e2-marked' ?>"><?= @$comment['author-name'] ?></span>
      </span>
  
      <span class="e2-comment-actions" style="margin-right: 16px">
        <? if (array_key_exists ('reply-important-toggle-href', $comment)): ?><a href="<?= $comment['reply-important-toggle-href'] ?>" class="e2-important-toggle nu"><span class="i-important-<?= ($comment['reply-important?']? 'set' : 'unset') ?>"></span></a><? endif ?>
      </span>
      
      </div>
    
    </div>
  
     
    <div class="comment-content-area">

      <div class="comment-content-area-tail"></div>

      <div class="comment-actions-removed admin-links" style="display: none">
  
      <? if (array_key_exists ('removed-reply-toggle-href', $comment)): ?>
      <a href="<?= $comment['removed-reply-toggle-href'] ?>" class="e2-removed-toggle dashed"><small><?= _S ('gs--comment-restore') ?></small></a>
      <? endif; ?>
      
      </div>
      
      <div class="comment-content" <?= $comment['reply-visible?']? '' : 'style="display: none"' ?>>
        <div>
        <?=@$comment['reply']?>
        </div>
    
      </div>
  
    </div>
  
    <? if (array_key_exists ('edit-reply-href', $comment) or array_key_exists ('removed-reply-toggle-href', $comment)): ?>
    <div class="comment-control-area">
      <span class="comment-secondary-controls e2-comment-actions">
        <? if (array_key_exists ('edit-reply-href', $comment)): ?><a href="<?= $comment['edit-reply-href'] ?>" class="nu"><span class="i-edit-small"></span></a><? endif; ?><? if (array_key_exists ('removed-reply-toggle-href', $comment)): ?><a href="<?= $comment['removed-reply-toggle-href'] ?>" class="e2-removed-toggle nu"><span class="i-remove"></span></a><? endif; ?>
      </span>
      <span class="i-loading e2-removed-toggling" style="display: none"></span>
    </div>
    <? endif ?>
  
  
    <div class="clear"></div>

  </div>
  
  <? } ?>
    
</div>

</div>

<? endforeach ?>


<? } ?>


<? if (array_key_exists ('notes', $content)) { ?>
<? if (array_key_exists ('only', $content['notes'])) { ?>
<? if ($content['notes']['only']['can-be-commentable?']) { ?>

<? if ($content['notes']['only']['commentable-now?']) { ?>

  <h3><?= _S ('gs--your-comment') ?></h3>

  <div class="humble-form">
  <? _T_FOR ('form-comment') ?>
  </div>
  

<? } else { ?>

  <p><span class="i-no-comments"></span></p>

<? } ?>

<? } ?>
<? } ?>
<? } ?>



</div>


<? # OPEN / CLOSE # ?>

<? if (array_key_exists ('comments-toggle', $content)) { ?>
<p>
<a href="<?=$content['comments-toggle']['href']?>">
<button class="button"><?= $content['comments-toggle']['text'] ?></button>
</a>
</p>
<? } ?>