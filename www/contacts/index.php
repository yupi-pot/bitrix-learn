<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<h1>Обратная связь</h1>

<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "",
    array(
        "WEB_FORM_ID" => "1",
        "CACHE_TYPE" => "N",
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>