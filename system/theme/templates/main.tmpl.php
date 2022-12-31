<!DOCTYPE html>
<html>

<head>

<? _LIB ('jquery') ?>
<? _LIB ('pseudohover') ?>

<? _CSS ('main') ?>
<? _JS ('main') ?>

<? if ($content['sign-in']['done?']) { ?>
<? _CSS ('admin') ?>
<? _JS ('admin') ?>
<? } ?>

<e2:head-data />

</head>

<body>

<?#= _GUIDES (array (3, 11, 19, 27, 35, 43, 51, 59, 67, 75, 83, 91, 99)) ?>
<?#= _GUIDES (array (12, 20, 28, 36, 44, 52, 60, 68, 76, 84, 92)) ?>

<? _T_FOR ('short-message') ?>
<? _T_FOR ('form-install') ?>
<? _T_FOR ('form-login') ?>

<? if ($content['engine']['installed?']): ?>
<? _T ('layout'); ?>
<? endif ?>


</body>

</html>