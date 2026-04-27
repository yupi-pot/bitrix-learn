<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вход");

if ($USER->IsAuthorized() && !isset($_GET["logout"])) {
    LocalRedirect("/profile.php");
}
?>

<div class="page page--narrow">
    <h1 class="page-title">Вход</h1>

    <div class="card auth-wrap">
        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "",
            [
                "REGISTER_URL"        => "/register.php",
                "FORGOT_PASSWORD_URL" => "/forgot.php",
                "CACHE_TYPE"          => "N",
            ]
        ); ?>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
