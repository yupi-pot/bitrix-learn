<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="drugs-list">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="drug-card">
        <h2><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h2>
        <p><strong>МНН:</strong> <?=$arItem["PROPERTIES"]["MNN"]["VALUE"]?></p>
        <p><strong>Форма выпуска:</strong> <?=$arItem["PROPERTIES"]["FORM"]["VALUE"]?></p>
        <p><strong>Показания:</strong> <?=$arItem["PROPERTIES"]["INDICATIONS"]["VALUE"]["TEXT"]?></p>
    </div>
    <?endforeach;?>
</div>