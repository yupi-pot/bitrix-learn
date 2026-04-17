<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("iblock");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "drug-detail",
    array(
        "IBLOCK_TYPE" => "gerofarm",
        "IBLOCK_ID" => "5",
        "ELEMENT_ID" => $_GET["ID"],
        "CACHE_TYPE" => "N",
        "PROPERTY_CODE" => array("MNN", "FORM", "INDICATIONS"),
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>