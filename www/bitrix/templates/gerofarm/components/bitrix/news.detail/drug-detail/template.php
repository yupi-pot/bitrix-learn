<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="drug-detail">
    <h1><?=$arResult["NAME"]?></h1>
    <p><strong>МНН:</strong> <?=$arResult["PROPERTIES"]["MNN"]["VALUE"]?></p>
    <p><strong>Форма выпуска:</strong> <?=$arResult["PROPERTIES"]["FORM"]["VALUE"]?></p>
    <p><strong>Показания:</strong> <?=$arResult["PROPERTIES"]["INDICATIONS"]["VALUE"]["TEXT"]?></p>
    <a href="/drugs.php">← Назад к списку</a>
</div>