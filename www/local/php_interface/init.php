<?php

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    throw new \RuntimeException('Не удалось подключить модуль iblock');
}

if (!Loader::includeModule('highloadblock')) {
    throw new \RuntimeException('Не удалось подключить модуль highloadblock');
}
