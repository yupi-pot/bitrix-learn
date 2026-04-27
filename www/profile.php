<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

if (!$USER->IsAuthorized()) {
    LocalRedirect("/login.php");
}
?>

<div class="page page--narrow">
    <h1 class="page-title">
        Привет, <?= htmlspecialcharsbx($USER->GetFirstName() ?: $USER->GetLogin()) ?>!
    </h1>

    <div class="card">
        <div class="card__row">
            <span class="card__label">Логин</span>
            <span class="card__value"><?= htmlspecialcharsbx($USER->GetLogin()) ?></span>
        </div>
        <div class="card__row">
            <span class="card__label">Имя</span>
            <span class="card__value">
                <?= htmlspecialcharsbx($USER->GetFirstName()) ?>
                <?= htmlspecialcharsbx($USER->GetLastName()) ?>
            </span>
        </div>
        <div class="card__row">
            <span class="card__label">Email</span>
            <span class="card__value"><?= htmlspecialcharsbx($USER->GetEmail()) ?></span>
        </div>
    </div>

    <a href="/login.php?logout=yes&sessid=<?= bitrix_sessid() ?>" class="btn btn--outline" style="margin-top: 16px">
        Выйти
    </a>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
