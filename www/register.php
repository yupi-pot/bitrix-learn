<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");

if ($USER->IsAuthorized()) {
    LocalRedirect("/profile.php");
}
?>

<div class="page page--narrow">
    <h1 class="page-title">Регистрация</h1>

    <div class="card auth-wrap">
        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.registration",
            "",
            [
                "LOGIN_URL"  => "/login.php",
                "CACHE_TYPE" => "N",
            ]
        ); ?>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
