<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("ГЕРОФАРМ — биотехнологическая компания");
?>

<section class="home-hero">
    <div class="home-hero__inner">
        <h1 class="home-hero__title">
            ГЕРОФАРМ — биотехнологическая компания, которая выводит Россию в лидеры по продолжительности активной жизни
        </h1>

        <div class="home-hero__counter" aria-hidden="true">
            <span class="home-hero__counter-num">1/3</span>
        </div>
    </div>
</section>

<section class="home-flagships container">
    <header class="home-flagships__head">
        <h2 class="home-flagships__title">
            Лидеры на рынке препаратов для борьбы с ожирением в России
        </h2>
        <a href="/drugs/" class="btn-pill btn-pill--dark">Препараты ГЕРОФАРМ</a>
    </header>

    <?php
    $arrFilterFlagships = ["PROPERTY_IS_FLAGSHIP_VALUE" => "Да"];

    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "flagships",
        [
            "IBLOCK_TYPE"          => "gerofarm",
            "IBLOCK_ID"            => "5",
            "SET_TITLE"            => "N",
            "NEWS_COUNT"           => 3,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "FILTER_NAME"          => "arrFilterFlagships",
            "PROPERTY_CODE"        => [],
            "CACHE_TYPE"           => "A",
            "CACHE_TIME"           => "3600",
            "DETAIL_URL"           => "",
            "DISPLAY_PICTURE"      => "N",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_NAME"         => "Y",
            "DISPLAY_DATE"         => "N",
        ]
    );
    ?>
</section>

<section class="home-figures container">
    <header class="home-figures__head">
        <h2 class="home-figures__title">ГЕРОФАРМ в цифрах</h2>
        <a href="/about/" class="btn-pill btn-pill--dark">О компании</a>
    </header>
    <p class="home-figures__intro">
        Более 25 лет компания разрабатывает и производит жизненно важные лекарства
        и является надёжным партнёром государства в лечении социально значимых заболеваний
    </p>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "figures",
        [
            "IBLOCK_TYPE"          => "gerofarm",
            "IBLOCK_ID"            => "6",
            "SET_TITLE"            => "N",
            "NEWS_COUNT"           => 4,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "PROPERTY_CODE"        => ["VALUE", "CAPTION", "LINK_TEXT", "LINK_URL"],
            "CACHE_TYPE"           => "A",
            "CACHE_TIME"           => "36000000",
            "CACHE_GROUPS"         => "N",
            "DETAIL_URL"           => "",
            "DISPLAY_PICTURE"      => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_NAME"         => "N",
            "DISPLAY_DATE"         => "N",
        ]
    );
    ?>
</section>

<section class="home-reviews">
    <div class="container">
        <h2 class="home-reviews__title">
            Мы гордимся теми, кто вдохновляет нас стремиться к новым вершинам в нашей работе
        </h2>
    </div>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "reviews",
        [
            "IBLOCK_TYPE"          => "gerofarm",
            "IBLOCK_ID"            => "9",
            "SET_TITLE"            => "N",
            "NEWS_COUNT"           => 10,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "PROPERTY_CODE"        => ["AUTHOR_NAME", "AUTHOR_BIO", "AUTHOR_PHOTO", "FULL_REVIEW_URL"],
            "CACHE_TYPE"           => "A",
            "CACHE_TIME"           => "36000000",
            "CACHE_GROUPS"         => "N",
            "DETAIL_URL"           => "",
            "DISPLAY_PICTURE"      => "N",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_NAME"         => "N",
            "DISPLAY_DATE"         => "N",
        ]
    );
    ?>
</section>

<section class="home-social container">
    <header class="home-social__head">
        <h2 class="home-social__title">
            Комплексный подход к решению<br>
            социальных проблем
        </h2>
        <a href="/social-projects/" class="btn-pill btn-pill--dark">Социальные проекты</a>
    </header>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "social_projects",
        [
            "IBLOCK_TYPE"          => "gerofarm",
            "IBLOCK_ID"            => "7",
            "SET_TITLE"            => "N",
            "NEWS_COUNT"           => 3,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "PROPERTY_CODE"        => [],
            "CACHE_TYPE"           => "A",
            "CACHE_TIME"           => "36000000",
            "CACHE_GROUPS"         => "N",
            "DETAIL_URL"           => "",
            "DISPLAY_PICTURE"      => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_NAME"         => "Y",
            "DISPLAY_DATE"         => "N",
        ]
    );
    ?>
</section>

<section class="home-press container">
    <h2 class="home-press__title">
        Пресс-центр: новости, проекты и истории компании
    </h2>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main_news",
        [
            "IBLOCK_TYPE"          => "gerofarm",
            "IBLOCK_ID"            => "8",
            "SET_TITLE"            => "N",
            "NEWS_COUNT"           => 4,
            "SORT_BY1"             => "ACTIVE_FROM",
            "SORT_ORDER1"          => "DESC",
            "SORT_BY2"             => "ID",
            "SORT_ORDER2"          => "DESC",
            "FIELD_CODE"           => ["NAME", "ACTIVE_FROM", "PREVIEW_PICTURE"],
            "PROPERTY_CODE"        => [],
            "DETAIL_URL"           => "",
            "ACTIVE_DATE_FORMAT"   => "j F",
            "DISPLAY_TOP_PAGER"    => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "CACHE_TYPE"           => "A",
            "CACHE_TIME"           => "36000000",
            "CACHE_GROUPS"         => "N",
            "FILTER_NAME"          => "",
            "AJAX_MODE"            => "N",
            // На учебном стенде — показывать всё, см. /news/index.php
            "CHECK_DATES"          => "N",
        ]
    );
    ?>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
