<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

$totalItems = count($arResult["ITEMS"]);
?>
<div class="flagships-grid">
    <?php foreach ($arResult["ITEMS"] as $i => $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
            "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'),
        ]);

        $isWide = ($i === $totalItems - 1) && ($totalItems % 2 === 1);
        $modifier = $isWide ? 'flagship--wide' : 'flagship--square';
        ?>
        <article
            class="flagship <?= $modifier ?>"
            id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
        >
            <h3 class="flagship__title"><?= htmlspecialcharsbx($arItem["NAME"]) ?>&reg;</h3>

            <?php if (!empty($arItem["PREVIEW_TEXT"])): ?>
                <p class="flagship__text"><?= $arItem["PREVIEW_TEXT"] ?></p>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>
