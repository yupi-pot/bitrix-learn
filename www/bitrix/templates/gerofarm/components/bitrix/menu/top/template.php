<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="nav">
    <?foreach($arResult as $arItem):?>
    <li class="nav__item <?=$arItem["SELECTED"] ? "nav__item--active" : ""?>">
        <a class="nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
    </li>
    <?endforeach;?>
</ul>