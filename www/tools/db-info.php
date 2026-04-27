<?php
require __DIR__ . '/_bootstrap.php';

use Bitrix\Main\Loader;

Loader::includeModule('iblock');
Loader::includeModule('highloadblock');

function h(string $title): void
{
    echo "\n" . str_repeat('─', 60) . "\n $title\n" . str_repeat('─', 60) . "\n";
}

// ─── Инфоблоки ──────────────────────────────────────────────
h('ИНФОБЛОКИ');
$rs = \Bitrix\Iblock\IblockTable::getList([
    'select' => ['ID', 'CODE', 'NAME', 'IBLOCK_TYPE_ID'],
    'order'  => ['ID' => 'ASC'],
]);
printf("%-4s %-20s %-25s %s\n", 'ID', 'CODE', 'TYPE', 'NAME');
while ($r = $rs->fetch()) {
    printf(
        "%-4d %-20s %-25s %s\n",
        $r['ID'],
        $r['CODE'] ?? '—',
        $r['IBLOCK_TYPE_ID'] ?? '—',
        $r['NAME']
    );
}

// ─── Свойства инфоблоков ────────────────────────────────────
h('СВОЙСТВА ИНФОБЛОКОВ');
$rs = \Bitrix\Iblock\PropertyTable::getList([
    'select' => ['ID', 'IBLOCK_ID', 'CODE', 'NAME', 'PROPERTY_TYPE', 'USER_TYPE'],
    'order'  => ['IBLOCK_ID' => 'ASC', 'SORT' => 'ASC'],
]);
printf("%-4s %-9s %-15s %-8s %-12s %s\n", 'ID', 'IB_ID', 'CODE', 'TYPE', 'USER_TYPE', 'NAME');
while ($r = $rs->fetch()) {
    printf(
        "%-4d %-9d %-15s %-8s %-12s %s\n",
        $r['ID'],
        $r['IBLOCK_ID'],
        $r['CODE'] ?? '—',
        $r['PROPERTY_TYPE'],
        $r['USER_TYPE'] ?? '—',
        $r['NAME']
    );
}

// ─── Highload-блоки ─────────────────────────────────────────
h('HIGHLOAD-БЛОКИ');
$rs = \Bitrix\Highloadblock\HighloadBlockTable::getList([
    'select' => ['ID', 'NAME', 'TABLE_NAME'],
    'order'  => ['ID' => 'ASC'],
]);
printf("%-4s %-25s %s\n", 'ID', 'NAME', 'TABLE');
while ($r = $rs->fetch()) {
    printf("%-4d %-25s %s\n", $r['ID'], $r['NAME'], $r['TABLE_NAME']);
}

// ─── Группы пользователей ───────────────────────────────────
h('ГРУППЫ ПОЛЬЗОВАТЕЛЕЙ');
$rs = CGroup::GetList('c_sort', 'asc', ['ACTIVE' => 'Y']);
printf("%-4s %-20s %s\n", 'ID', 'STRING_ID', 'NAME');
while ($r = $rs->Fetch()) {
    printf(
        "%-4d %-20s %s\n",
        $r['ID'],
        $r['STRING_ID'] ?? '—',
        $r['NAME']
    );
}

// ─── Константы из init.php ──────────────────────────────────
h('КОНСТАНТЫ ПРОЕКТА (из init.php)');
foreach (['IBLOCK_DRUGS_ID', 'GROUP_DOCTORS_ID'] as $const) {
    $val = defined($const) ? constant($const) : '<не определена>';
    printf("%-20s = %s\n", $const, var_export($val, true));
}

echo "\n";
