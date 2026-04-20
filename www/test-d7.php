<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule("iblock");

$result = \Bitrix\Iblock\ElementTable::getList([
  'filter' => [
    'IBLOCK_ID' => 5,
    'ACTIVE' => 'Y',
    '>DATE_CREATE' => '01.04.2026',  // больше чем 1 апреля
  ],
  'select' => ['ID', 'NAME', 'DATE_CREATE'],
  'order' => ['NAME' => 'ASC'],
]);

while ($row = $result->fetch()) {
  echo $row['ID'] . ' — ' . $row['NAME'] . ' — ' . $row['DATE_CREATE'] . '<br>';
}
