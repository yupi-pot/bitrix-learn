<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Препараты");

$selectedForm = isset($_GET["form"]) ? (int)$_GET["form"] : 0;

$myFilter = $selectedForm ? ["PROPERTY_FORM" => $selectedForm] : [];

$formValues = [];
$rsEnum = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC"],
    ["IBLOCK_ID" => IBLOCK_DRUGS_ID, "CODE" => "FORM"]
);
while ($enum = $rsEnum->Fetch()) {
    $formValues[(int)$enum["ID"]] = $enum["VALUE"];
}
?>

<h1 class="page-title">Препараты</h1>

<form class="filter-bar" method="get" action="/drugs.php">
    <label>
        <select name="form">
            <option value="0">Все формы выпуска</option>
            <? foreach ($formValues as $id => $name): ?>
                <option value="<?= $id ?>" <?= $selectedForm === $id ? "selected" : "" ?>>
                    <?= htmlspecialcharsbx($name) ?>
                </option>
            <? endforeach; ?>
        </select>
    </label>
    <button type="submit" class="btn btn--primary">Показать</button>
    <? if ($selectedForm): ?>
        <a href="/drugs.php" class="filter-bar__reset">Сбросить</a>
    <? endif; ?>
</form>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "drugs",
    [
        "IBLOCK_TYPE"    => "gerofarm",
        "IBLOCK_ID"      => IBLOCK_DRUGS_ID,
        "ELEMENT_COUNT"  => "20",
        "SORT_BY1"       => "SORT",
        "SORT_ORDER1"    => "ASC",
        "CACHE_TYPE"     => "A",
        "CACHE_TIME"     => "3600",
        "CACHE_GROUPS"   => "N",
        "PROPERTY_CODE"  => ["MNN", "FORM", "INDICATIONS"],
        "FILTER_NAME"    => "myFilter",
        "DETAIL_URL"     => "/gerofarm/detail.php?ID=#ELEMENT_ID#",
    ]
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
