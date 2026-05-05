<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?php if (empty($arResult["ITEMS"])) return; ?>

<?php $firstItem = reset($arResult["ITEMS"]); ?>
<div class="home-infra__media">
    <img class="home-infra__img"
         src="<?= htmlspecialchars($firstItem["PREVIEW_PICTURE"]["SRC"] ?? "") ?>"
         alt="<?= htmlspecialchars($firstItem["NAME"]) ?>">
</div>

<div class="home-infra__content">
    <p class="home-infra__desc">
        Компания занимается выпуском лекарственных препаратов по полному циклу,
        инвестирует в технологическое развитие и создание современной фармацевтической инфраструктуры
    </p>

    <div class="home-infra__list">
        <?php foreach ($arResult["ITEMS"] as $i => $arItem): ?>
        <div class="infra-item<?= $i === 0 ? " infra-item--active" : "" ?>"
             data-img="<?= htmlspecialchars($arItem["PREVIEW_PICTURE"]["SRC"] ?? "") ?>">

            <div class="infra-item__num">
                <svg width="64" height="64" viewBox="0 0 64 64" aria-hidden="true">
                    <circle cx="32" cy="32" r="30" fill="#ededed"/>
                    <circle cx="32" cy="32" r="28"
                            fill="none"
                            stroke="rgba(0,0,0,0.8)"
                            stroke-width="2"
                            stroke-dasharray="175.93"
                            stroke-dashoffset="175.93"
                            stroke-linecap="round"
                            transform="rotate(-90 32 32)"
                            class="infra-progress"/>
                </svg>
                <span class="infra-item__index"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
            </div>

            <div class="infra-item__body">
                <p class="infra-item__title"><?= htmlspecialchars($arItem["NAME"]) ?></p>
                <p class="infra-item__desc"><?= htmlspecialchars($arItem["PREVIEW_TEXT"]) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
