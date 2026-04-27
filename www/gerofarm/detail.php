<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "drug-detail",
    [
        "IBLOCK_TYPE"   => "gerofarm",
        "IBLOCK_ID"     => IBLOCK_DRUGS_ID,
        "ELEMENT_ID"    => (int)($_GET["ID"] ?? 0),
        "CACHE_TYPE"    => "A",
        "CACHE_TIME"    => "3600",
        "PROPERTY_CODE" => ["MNN", "FORM", "INDICATIONS"],
    ]
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
