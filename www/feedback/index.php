<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>

<div class="feedback-page">
    <h1 class="feedback-page__title">Обратная связь</h1>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:main.feedback",
        "feedback",
        [
            "EMAIL_TO"        => "potapov@loo.ch",
            "REQUIRED_FIELDS" => ["NAME", "EMAIL", "MESSAGE"],
            "USE_CAPTCHA"     => "N",
            "CACHE_TYPE"      => "N",
        ]
    ); ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
