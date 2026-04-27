<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Материалы для врачей");

if (!$USER->IsAuthorized() || !in_array(GROUP_DOCTORS_ID, $USER->GetUserGroupArray())) {
    LocalRedirect("/login.php");
}
?>

<div class="page">
    <h1 class="page-title">Материалы для врачей</h1>
    <p class="page-lead">
        Раздел доступен только для зарегистрированных специалистов.
    </p>

    <div class="card">
        <p>Здесь будут клинические исследования, инструкции и научные материалы.</p>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
