<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult["OK_MESSAGE"])): ?>

    <div class="feedback-success">
        <p><?= htmlspecialchars($arResult["OK_MESSAGE"]) ?></p>
    </div>

<?php else: ?>

    <?php if (!empty($arResult["ERROR_MESSAGE"])): ?>
        <div class="feedback-errors">
            <?php foreach ($arResult["ERROR_MESSAGE"] as $error): ?>
                <p class="feedback-error"><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form class="feedback-form" method="post" action="<?= $APPLICATION->GetCurPage() ?>">

        <?= bitrix_sessid_post() ?>
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="hidden" name="submit" value="Y">

        <div class="feedback-field">
            <label for="f-name">Имя *</label>
            <input type="text" id="f-name" name="user_name"
                   value="<?= htmlspecialchars($arResult["AUTHOR_NAME"] ?? "") ?>">
        </div>

        <div class="feedback-field">
            <label for="f-email">Email *</label>
            <input type="email" id="f-email" name="user_email"
                   value="<?= htmlspecialchars($arResult["AUTHOR_EMAIL"] ?? "") ?>">
        </div>

        <div class="feedback-field">
            <label for="f-message">Сообщение *</label>
            <textarea id="f-message" name="MESSAGE" rows="5"><?= htmlspecialchars($arResult["MESSAGE"] ?? "") ?></textarea>
        </div>

        <button type="submit" class="btn-pill btn-pill--dark">Отправить</button>

    </form>

<?php endif; ?>
