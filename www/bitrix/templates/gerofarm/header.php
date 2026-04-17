<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?$APPLICATION->ShowHead();?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/styles.css">
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="<?=SITE_DIR?>" class="header__logo">Герофарм</a>
            <nav class="header__nav">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
                    "ROOT_MENU_TYPE" => "top",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array()
                ), false);?>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="container">