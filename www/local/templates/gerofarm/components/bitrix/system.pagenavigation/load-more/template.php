<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Кастомный шаблон пагинации: одна кнопка «Показать ещё».
 *
 * Рисует кнопку только если есть следующая страница. Кнопка несёт реальный
 * href на ?PAGEN_N=M+1 — без JS работает как обычная пагинация (страница
 * перезагружается, юзер видит следующую порцию). JS поверх делает AJAX-
 * подгрузку и апендит карточки в текущий грид (см. news.list/news/script.js).
 *
 * @var array $arResult — массив, формируемый компонентом system.pagenavigation
 */

$currentPage = (int) $arResult["NavPageNomer"];
$pageCount   = (int) $arResult["NavPageCount"];

if ($currentPage >= $pageCount) {
    return;
}

$nextPage = $currentPage + 1;
$navParam = "PAGEN_" . (int) $arResult["NavNum"];

$queryString = $arResult["NavQueryString"] ?? "";
$urlPath     = $arResult["sUrlPath"] ?? $APPLICATION->GetCurPage();

$separator = ($queryString !== "") ? "&" : "";
$href      = $urlPath . "?" . $queryString . $separator . $navParam . "=" . $nextPage;
?>

<a href="<?= htmlspecialcharsbx($href) ?>"
   class="load-more-btn"
   data-page-current="<?= $currentPage ?>"
   data-page-total="<?= $pageCount ?>">
    Показать ещё
</a>
