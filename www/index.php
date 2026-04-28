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

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
