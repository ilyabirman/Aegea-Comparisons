<!DOCTYPE html>
<html>

<head>

<?php _LIB ('jquery') ?>
<?php _LIB ('pseudohover') ?>
<?php _LIB ('smart-title') ?>

<?php _CSS ('main') ?>
<?php _JS ('main') ?>

<?php if ($content['sign-in']['done?']) { ?>
<?php _LIB ('stickyfill') ?>
<?php _CSS ('admin') ?>
<?php _JS ('admin') ?>
<?php } ?>

<e2:head-data />
<e2:scripts-data />

</head>

<body>

<?php _T_FOR ('form-install') ?>
<?php _T_FOR ('form-login') ?>

<?php if ($content['engine']['installed?']): ?>
<?php _T ('layout'); ?>
<?php endif ?>

<?= @$content['pre-body-end'] ?>

</body>

</html>

<!-- <?=$content['engine']['version-description']?> -->