<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "",
    array(
        "SITE_ID" => "s1",
        "CACHE_TYPE" => "N",
        "PAGE_RESULT_COUNT" => "10",
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>