<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Шаблон news.list/main_news — превью новостей в секции «Пресс-центр» на главной.
 *
 * Дизайн: Figma node 143:259. 4 карточки в ряд, без пагинации, без кнопки.
 * Стили карточки .news-card* — общие, см. template_styles.css.
 *
 * @var array $arParams
 * @var array $arResult
 */
?>

<?php if (!empty($arResult["ITEMS"])): ?>
    <ul class="main-news__grid">
        <?php foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => 'Удалить новость?']);
        ?>
            <li class="news-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-card__link">
                    <div class="news-card__media">
                        <?php if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
                            <img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                alt="<?= htmlspecialcharsbx($arItem["PREVIEW_PICTURE"]["ALT"] ?: $arItem["NAME"]) ?>"
                                width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                loading="lazy"
                            />
                        <?php endif; ?>
                    </div>
                    <div class="news-card__body">
                        <?php if (!empty($arItem["DISPLAY_ACTIVE_FROM"])): ?>
                            <time class="news-card__date" datetime="<?= $arItem["ACTIVE_FROM"] ?>">
                                <?= $arItem["DISPLAY_ACTIVE_FROM"] ?>
                            </time>
                        <?php endif; ?>
                        <h3 class="news-card__title"><?= $arItem["NAME"] ?></h3>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
