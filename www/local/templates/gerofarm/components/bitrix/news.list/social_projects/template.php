<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);
?>
<div class="social-grid">
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
            "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'),
        ]);

        $hasPic = !empty($arItem['PREVIEW_PICTURE']['SRC']);
        ?>
        <article
            class="social-card"
            id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
        >
            <?php if ($hasPic): ?>
                <img
                    class="social-card__image"
                    src="<?= htmlspecialcharsbx($arItem['PREVIEW_PICTURE']['SRC']) ?>"
                    alt="<?= htmlspecialcharsbx($arItem['NAME']) ?>"
                    loading="lazy"
                >
            <?php else: ?>
                <div class="social-card__image social-card__image--placeholder" aria-hidden="true"></div>
            <?php endif; ?>

            <div class="social-card__body">
                <h3 class="social-card__title"><?= htmlspecialcharsbx($arItem['NAME']) ?></h3>
                <?php if (!empty($arItem['PREVIEW_TEXT'])): ?>
                    <p class="social-card__text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
