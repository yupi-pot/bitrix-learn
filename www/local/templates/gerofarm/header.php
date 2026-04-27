<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="<?=SITE_TEMPLATE_PATH?>/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?=SITE_TEMPLATE_PATH?>/template_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?$APPLICATION->ShowPanel();?>

<header class="site-header">
    <div class="site-header__inner">
        <a href="/" class="site-header__logo">
            ГЕРОФАРМ
        </a>

        <nav class="site-nav">
            <a href="/about/" class="site-nav__item">Компания</a>
            <a href="/drugs/" class="site-nav__item">Препараты</a>
            <a href="/science/" class="site-nav__item">Наука</a>
            <a href="/infrastructure/" class="site-nav__item">Инфраструктура</a>
            <a href="/career/" class="site-nav__item">Карьера</a>
            <a href="/contacts/" class="site-nav__item">Контакты</a>
        </nav>

        <div class="site-header__hotline">
            <span class="site-header__hotline-label">горячая линия</span>
            <a href="tel:+78003334376" class="site-header__hotline-number">+7 800-333-43-76</a>
        </div>

        <div class="site-header__actions">
            <a href="/en/" class="circle-btn">EN</a>
            <button class="circle-btn" aria-label="Поиск">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<main class="site-main">
