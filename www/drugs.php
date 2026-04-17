<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<? $APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "drugs",
  array(
    "IBLOCK_TYPE" => "gerofarm",
    "IBLOCK_ID" => "5",
    "ELEMENT_COUNT" => "20",
    "SORT_BY1" => "SORT",
    "SORT_ORDER1" => "ASC",
    "CACHE_TYPE" => "N",
    "PROPERTY_CODE" => array("MNN", "FORM", "INDICATIONS"),
  )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>