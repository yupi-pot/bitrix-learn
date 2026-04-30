<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 */

// JS подгрузки «Показать ещё». Битрикс автоматически подключает только style.css
// шаблона компонента — JS надо подключать вручную через Asset.
$APPLICATION->AddHeadScript(
    SITE_TEMPLATE_PATH . "/components/bitrix/news.list/news/script.js"
);
?>

<div class="news-list">
    <?php if (empty($arResult["ITEMS"])): ?>
        <p class="news-list__empty">Пока нет новостей.</p>
    <?php else: ?>
        <ul class="news-list__grid">
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
                            <h2 class="news-card__title"><?= $arItem["NAME"] ?></h2>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!empty($arResult["NAV_STRING"])): ?>
        <div class="news-list__pager">
            <?= $arResult["NAV_STRING"] ?>
        </div>
    <?php endif; ?>
</div>
