<?php
/**
 * Подключение ядра Битрикса для CLI-скриптов.
 * Требует запуска ВНУТРИ контейнера bitrix_web:
 *   docker exec bitrix_web php /var/www/html/tools/<script>.php
 */

if (PHP_SAPI !== 'cli') {
    exit("Этот скрипт предназначен только для CLI\n");
}

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);

$_SERVER['DOCUMENT_ROOT'] = '/var/www/html';
$_SERVER['HTTP_HOST']     = 'localhost';
$_SERVER['REQUEST_URI']   = '/';

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
