<?php defined("B_PROLOG_INCLUDED") or die();
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 */
?>

<div class="drugs-grid">
    <?php if (empty($arResult["ITEMS"])): ?>
        <p class="drugs-grid__empty">Препараты не найдены.</p>
    <?php else: ?>
        <?php foreach ($arResult["ITEMS"] as $arItem):
            $category = $arItem['PROPERTIES']['THERAPY_AREA']['VALUE'] ?? '';
            $picSrc   = $arItem['PREVIEW_PICTURE']['SRC'] ?? '';
        ?>
            <div class="drug-card">
                <div class="drug-card__image-wrap">
                    <?php if ($picSrc): ?>
                        <img class="drug-card__image"
                             src="<?= htmlspecialcharsbx($picSrc) ?>"
                             alt="<?= htmlspecialcharsbx($arItem['NAME']) ?>"
                             loading="lazy">
                    <?php endif; ?>
                </div>
                <?php if ($category): ?>
                    <span class="drug-card__badge">
                        <?= htmlspecialcharsbx($category) ?>
                    </span>
                <?php endif; ?>
                <p class="drug-card__name">
                    <?= htmlspecialcharsbx($arItem['NAME']) ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php if (!empty($arResult["NAV_STRING"])): ?>
    <div class="drugs-pager">
        <?= $arResult["NAV_STRING"] ?>
    </div>
<?php endif; ?>
