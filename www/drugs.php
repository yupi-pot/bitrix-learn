<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("iblock");

$selectedForm = isset($_GET["form"]) ? intval($_GET["form"]) : 0;

if ($selectedForm) {
    $myFilter = array("PROPERTY_FORM" => $selectedForm);
} else {
    $myFilter = array();
}

$formValues = array(
    5 => "Таблетки",
    6 => "Раствор для инъекций",
    7 => "Капсулы",
);
?>

<form method="get" action="/drugs.php">
    <select name="form">
        <option value="0">Все формы выпуска</option>
        <?foreach($formValues as $id => $name):?>
        <option value="<?=$id?>" <?=$selectedForm==$id?"selected":""?>><?=$name?></option>
        <?endforeach;?>
    </select>
    <button type="submit">Показать</button>
    <a href="/drugs.php">Сбросить</a>
</form>

<?$APPLICATION->IncludeComponent(
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
        "FILTER_NAME" => "myFilter",
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>