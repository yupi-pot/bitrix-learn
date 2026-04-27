<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест D7: фильтр по дате");

use Bitrix\Main\Type\DateTime;

$result = \Bitrix\Iblock\ElementTable::getList([
    'filter' => [
        'IBLOCK_ID'    => IBLOCK_DRUGS_ID,
        'ACTIVE'       => 'Y',
        '>DATE_CREATE' => new DateTime('01.04.2026 00:00:00', 'd.m.Y H:i:s'),
    ],
    'select' => ['ID', 'NAME', 'DATE_CREATE'],
    'order'  => ['NAME' => 'ASC'],
]);
?>

<div class="page">
    <h1 class="page-title">Препараты, созданные после 01.04.2026</h1>

    <div class="card">
        <? while ($row = $result->fetch()): ?>
            <div class="card__row">
                <span class="card__label">#<?= (int)$row['ID'] ?> · <?= htmlspecialcharsbx((string)$row['DATE_CREATE']) ?></span>
                <span class="card__value"><?= htmlspecialcharsbx($row['NAME']) ?></span>
            </div>
        <? endwhile; ?>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
