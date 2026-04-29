<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);
?>
<div class="figures-grid">
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
            "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'),
        ]);

        $value     = $arItem['DISPLAY_PROPERTIES']['VALUE']['DISPLAY_VALUE']     ?? '';
        $caption   = $arItem['DISPLAY_PROPERTIES']['CAPTION']['DISPLAY_VALUE']   ?? '';
        $linkText  = $arItem['DISPLAY_PROPERTIES']['LINK_TEXT']['DISPLAY_VALUE'] ?? '';
        $linkUrl   = $arItem['DISPLAY_PROPERTIES']['LINK_URL']['DISPLAY_VALUE']  ?? '';
        ?>
        <article
            class="figure"
            id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
        >
            <div class="figure__value"><?= $value ?></div>
            <p class="figure__caption"><?= $caption ?></p>

            <?php if ($linkText && $linkUrl): ?>
                <a class="figure__link" href="<?= $linkUrl ?>"><?= $linkText ?></a>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>
