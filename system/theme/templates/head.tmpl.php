<meta http-equiv="Content-Type" content="text/html; charset=<?= $content['output-charset'] ?>" />

<base href="<?= $content['base-href'] ?>" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

<?php foreach ($content['stylesheets'] as $stylesheet): ?>
<link rel="stylesheet" type="text/css" href="<?= $stylesheet ?>" />
<?php endforeach ?>

<?php foreach ($content['newsfeeds'] as $newsfeed): ?>
<link rel="alternate" type="application/rss+xml" title="<?= $newsfeed['title'] ?>" href="<?= $newsfeed['href'] ?>" />
<?php endforeach ?>

<?php foreach ($content['navigation-links'] as $link): ?>
<link rel="<?= $link['rel'] ?>" id="<?= $link['id'] ?>" href="<?= $link['href'] ?>" />
<?php endforeach ?>

<?php if (array_key_exists ('robots', $content)): ?>
<meta name="robots" content="<?= $content['robots'] ?>" />
<?php endif ?>

<?php if (array_key_exists ('summary', $content)): ?>
<meta name="description" content="<?= $content['summary'] ?>" />
<?php endif ?>

<?php foreach ($content['og-images'] as $image): ?>
<meta property="og:image" content="<?= $image ?>" />
<?php endforeach ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= $content['title'] ?></title>

<?php _X ('head-extras') ?>

