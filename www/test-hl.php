<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

CModule::IncludeModule('highloadblock');

// Получаем блок по названию
$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList([
    'filter' => ['=NAME' => 'DrugForms']
])->fetch();

// Получаем класс для работы с данными
$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entityClass = $entity->getDataClass();

// Читаем все записи
$result = $entityClass::getList([
    'order' => ['UF_NAME' => 'ASC']
]);

while ($row = $result->fetch()) {
    echo $row['ID'] . ' — ' . $row['UF_NAME'] . '<br>';
}
?>