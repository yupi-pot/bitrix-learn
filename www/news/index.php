<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Пресс центр — ГЕРОФАРМ");
?>

<section class="press-center container">

    <nav class="breadcrumbs" aria-label="Хлебные крошки">
        <a href="/" class="breadcrumbs__item breadcrumbs__item--muted">Главная</a>
        <span class="breadcrumbs__sep" aria-hidden="true">→</span>
        <span class="breadcrumbs__item">Компания</span>
    </nav>

    <h1 class="press-center__title">Пресс центр</h1>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news",
        [
            "IBLOCK_TYPE"            => "gerofarm",
            "IBLOCK_ID"              => "8",
            "NEWS_COUNT"             => 8,
            "SORT_BY1"               => "ACTIVE_FROM",
            "SORT_ORDER1"            => "DESC",
            "SORT_BY2"               => "ID",
            "SORT_ORDER2"            => "DESC",
            "FILTER_NAME"            => "",
            "FIELD_CODE"             => ["NAME", "ACTIVE_FROM", "PREVIEW_PICTURE", "PREVIEW_TEXT"],
            "PROPERTY_CODE"          => [],

            "DETAIL_URL"             => "",
            "ACTIVE_DATE_FORMAT"     => "j F",

            "DISPLAY_TOP_PAGER"      => "N",
            "DISPLAY_BOTTOM_PAGER"   => "Y",
            "PAGER_TITLE"            => "Новостей",
            "PAGER_TEMPLATE"         => "load-more",
            "PAGER_SHOW_ALWAYS"      => "N",
            "PAGER_DESC_NUMBERING"   => "N",
            "PAGER_SHOW_ALL"         => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_LAST_MODIFIED"      => "Y",

            "CACHE_TYPE"             => "A",
            "CACHE_TIME"             => "36000000",
            "CACHE_FILTER"           => "N",
            "CACHE_GROUPS"           => "Y",

            "AJAX_MODE"              => "N",
            "DISPLAY_DATE"           => "Y",
            "DISPLAY_NAME"           => "Y",
            "DISPLAY_PICTURE"        => "Y",
            "DISPLAY_PREVIEW_TEXT"   => "N",
            "PREVIEW_TRUNCATE_LEN"   => "",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN"     => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            // Учебный стенд: показываем все новости вне зависимости от ACTIVE_FROM.
            // На проде переключить на "Y" — тогда отложенные публикации (с датой
            // в будущем) появятся автоматически в момент наступления даты.
            "CHECK_DATES"            => "N",
        ]
    );
    ?>

</section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
