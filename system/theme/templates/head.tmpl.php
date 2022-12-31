<? // mui ?>

<meta http-equiv="Content-Type" content="text/html; charset=<?= $content['output-charset'] ?>" />

<base href="<?= $content['base-href'] ?>" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

<? foreach ($content['stylesheets'] as $stylesheet): ?>
<link rel="stylesheet" type="text/css" href="<?= $stylesheet ?>" />
<? endforeach ?>

<? foreach ($content['newsfeeds'] as $newsfeed): ?>
<link rel="alternate" type="application/rss+xml" title="<?= $newsfeed['title'] ?>" href="<?= $newsfeed['href'] ?>" />
<? endforeach ?>

<? foreach ($content['navigation-links'] as $link): ?>
<link rel="<?= $link['rel'] ?>" id="<?= $link['id'] ?>" href="<?= $link['href'] ?>" />
<? endforeach ?>

<? foreach ($content['scripts'] as $script): ?>
<script type="text/javascript" src="<?= $script ?>"></script>
<? endforeach ?>

<? _T ('head-extras') ?>

<? if (array_key_exists ('robots', $content)): ?>
<meta name="robots" content="<?= $content['robots'] ?>" />
<? endif ?>

<? if (array_key_exists ('summary', $content)): ?>
<meta name="description" content="<?= $content['summary'] ?>" />
<? endif ?>

<title><?= $content['title'] ?></title>