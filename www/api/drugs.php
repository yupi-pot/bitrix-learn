<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

header("Content-Type: application/json; charset=utf-8");

$limit  = min(max((int)($_GET["limit"]  ?? 50), 1), 100);
$offset = max((int)($_GET["offset"] ?? 0), 0);

$result = \Bitrix\Iblock\ElementTable::getList([
    'filter' => ['IBLOCK_ID' => IBLOCK_DRUGS_ID, 'ACTIVE' => 'Y'],
    'select' => ['ID', 'NAME'],
    'order'  => ['NAME' => 'ASC'],
    'limit'  => $limit,
    'offset' => $offset,
]);

$drugs = [];
while ($row = $result->fetch()) {
    $drugs[] = [
        "id"   => (int)$row["ID"],
        "name" => $row["NAME"],
    ];
}

echo json_encode([
    "limit"  => $limit,
    "offset" => $offset,
    "items"  => $drugs,
], JSON_UNESCAPED_UNICODE);
