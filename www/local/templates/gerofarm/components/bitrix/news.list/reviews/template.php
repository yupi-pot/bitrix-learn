<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
/** @global CMain $APPLICATION */

// Swiper 11 через CDN. AddHeadString с defer гарантирует:
// 1) не блокирует рендер страницы
// 2) скрипты выполняются в порядке DOM после парсинга — Swiper раньше нашего init
$APPLICATION->AddHeadString('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">');
$APPLICATION->AddHeadString('<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>');
$APPLICATION->AddHeadString('<script src="' . SITE_TEMPLATE_PATH . '/components/bitrix/news.list/reviews/script.js" defer></script>');

$this->setFrameMode(true);
?>
<div class="swiper reviews-swiper">
    <div class="swiper-wrapper">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
                "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'),
            ]);

            $authorName = htmlspecialcharsbx($arItem['PROPERTIES']['AUTHOR_NAME']['VALUE'] ?? '');
            $authorBio  = htmlspecialcharsbx($arItem['PROPERTIES']['AUTHOR_BIO']['VALUE'] ?? '');
            $reviewUrl  = htmlspecialcharsbx($arItem['PROPERTIES']['FULL_REVIEW_URL']['VALUE'] ?? '');
            // PREVIEW_TEXT в news.list уже прошёл через GetNext(true) — не экранируем повторно
            $reviewText = $arItem['PREVIEW_TEXT'] ?? '';

            // FILE-свойство: VALUE может быть строкой ID или массивом, CFile::GetPath может вернуть false
            $photoProp = $arItem['PROPERTIES']['AUTHOR_PHOTO'] ?? [];
            $photoSrc  = '';
            if (!empty($photoProp['VALUE'])) {
                $fileId = is_array($photoProp['VALUE'])
                    ? (int)current($photoProp['VALUE'])
                    : (int)$photoProp['VALUE'];
                if ($fileId > 0) {
                    $path = CFile::GetPath($fileId);
                    $photoSrc = $path ? htmlspecialcharsbx($path) : '';
                }
            }
            ?>
            <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                <div class="review-card">
                    <span class="review-card__quote" aria-hidden="true">&ldquo;</span>
                    <p class="review-card__text"><?= $reviewText ?></p>
                    <footer class="review-card__footer">
                        <div class="review-card__author">
                            <?php if ($photoSrc): ?>
                                <img
                                    class="review-card__avatar"
                                    src="<?= $photoSrc ?>"
                                    alt="<?= $authorName ?>"
                                    loading="lazy"
                                >
                            <?php else: ?>
                                <div class="review-card__avatar review-card__avatar--placeholder" aria-hidden="true"></div>
                            <?php endif; ?>
                            <div class="review-card__meta">
                                <p class="review-card__name"><?= $authorName ?></p>
                                <?php if ($authorBio): ?>
                                    <p class="review-card__bio"><?= $authorBio ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($reviewUrl !== ''): ?>
                            <a
                                href="<?= $reviewUrl ?>"
                                class="review-card__more"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Полный отзыв
                                <svg class="review-card__more-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M4.5 13.5L13.5 4.5M13.5 4.5H6.75M13.5 4.5V11.25" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </footer>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="swiper-pagination reviews-swiper__pagination"></div>
