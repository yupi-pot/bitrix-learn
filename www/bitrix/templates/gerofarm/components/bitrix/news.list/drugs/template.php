<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="drugs-list">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="drug-card">
            <h2><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a></h2>
            <p><strong>МНН:</strong> <?= $arItem["PROPERTIES"]["MNN"]["VALUE"] ?></p>
            <p><strong>Форма выпуска:</strong> <?= $arItem["PROPERTIES"]["FORM"]["VALUE"] ?></p>
            <? if (!empty($arItem["PROPERTIES"]["INDICATIONS"]["VALUE"])): ?>
                <p><strong>Показания:</strong> <?= is_array($arItem["PROPERTIES"]["INDICATIONS"]["VALUE"]) ? $arItem["PROPERTIES"]["INDICATIONS"]["VALUE"]["TEXT"] : $arItem["PROPERTIES"]["INDICATIONS"]["VALUE"] ?></p>
            <? endif; ?>
        </div>
    <? endforeach; ?>
</div>