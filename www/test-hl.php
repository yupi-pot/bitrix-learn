<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест HL-блока");

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

Loader::includeModule('highloadblock');

$hlblock = HighloadBlockTable::getList([
    'filter' => ['=NAME' => 'DrugForms'],
    'limit'  => 1,
])->fetch();
?>

<div class="page">
    <h1 class="page-title">HL-блок «DrugForms»</h1>

    <? if (!$hlblock): ?>
        <div class="alert alert--error">HL-блок DrugForms не найден</div>
    <? else:
        $entity = HighloadBlockTable::compileEntity($hlblock);
        $entityClass = $entity->getDataClass();
        $result = $entityClass::getList([
            'select' => ['ID', 'UF_NAME'],
            'order'  => ['UF_NAME' => 'ASC'],
        ]); ?>

        <div class="card">
            <? while ($row = $result->fetch()): ?>
                <div class="card__row">
                    <span class="card__label">#<?= (int)$row['ID'] ?></span>
                    <span class="card__value"><?= htmlspecialcharsbx($row['UF_NAME']) ?></span>
                </div>
            <? endwhile; ?>
        </div>
    <? endif; ?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
