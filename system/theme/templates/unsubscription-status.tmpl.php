<? // mui ?>

<? if ($content['unsubscription-status']['success?']) { ?>

<h2><?= _S ('pt--unsubscription-done') ?></h2>
<p><?= _S ('gs--you-are-no-longer-subscribed') ?> <a href="<?= $content['unsubscription-status']['note-href'] ?>"><?= $content['unsubscription-status']['note-title'] ?></a>.</p>

<? } else { ?>

<h2><?= _S ('pt--unsubscription-failed') ?></h2>
<p><?= $content['unsubscription-status']['error-message'] ?></p>

<? } ?>
