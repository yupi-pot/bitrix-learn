<?php
require __DIR__ . '/_bootstrap.php';

BXClearCache(true);

$managedCache = \Bitrix\Main\Application::getInstance()->getManagedCache();
$managedCache->cleanAll();

$taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
$taggedCache->clearByTag(true);

echo "✓ Кеш очищен (файловый + managed + tagged)\n";
