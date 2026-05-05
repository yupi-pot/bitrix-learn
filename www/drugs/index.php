<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
defined("B_PROLOG_INCLUDED") or die();
global $APPLICATION;

$APPLICATION->SetTitle("Препараты");

// slug => [label, display-value в инфоблоке]
// display-value должен точно совпадать с тем, что введено в админке для свойства THERAPY_AREA.
$arCategories = [
    'flagship'      => ['label' => 'Часто назначаемые', 'value' => null],
    'endocrinology' => ['label' => 'Эндокринология',    'value' => 'Эндокринология'],
    'neurology'     => ['label' => 'Неврология',         'value' => 'Неврология'],
    'ophthalmology' => ['label' => 'Офтальмология',      'value' => 'Офтальмология'],
    'gynecology'    => ['label' => 'Гинекология',        'value' => 'Гинекология'],
    'urology'       => ['label' => 'Урология',           'value' => 'Урология'],
    'cytamins'      => ['label' => 'Цитамины',           'value' => 'Цитамины'],
    ''              => ['label' => 'Все',                'value' => null],
];

// Отображаемое значение IS_FLAGSHIP для «флагмана».
// На главной использовали "Да" — значит именно такое значение в Списке.
define('IS_FLAGSHIP_YES_VALUE', 'Да');

// Валидируем GET-параметры: принимаем только известные ключи
$currentCategory = $_GET['category'] ?? 'flagship';
if (!array_key_exists($currentCategory, $arCategories)) {
    $currentCategory = 'flagship';
}

$searchQueryRaw = trim($_GET['q'] ?? '');
$searchQuery    = htmlspecialcharsbx($searchQueryRaw);

// --- Строим фильтр для news.list ---
// Переменная должна быть global — news.list ищет её в глобальном пространстве.
global $arFilterDrugs;
$arFilterDrugs = ['ACTIVE' => 'Y'];

if ($currentCategory === 'flagship') {
    // PROPERTY_{CODE}_VALUE — фильтр по отображаемому тексту значения Списка
    $arFilterDrugs['PROPERTY_IS_FLAGSHIP_VALUE'] = IS_FLAGSHIP_YES_VALUE;
} elseif ($currentCategory !== '') {
    $therapyValue = $arCategories[$currentCategory]['value'];
    if ($therapyValue !== null) {
        $arFilterDrugs['PROPERTY_THERAPY_AREA_VALUE'] = $therapyValue;
    }
}

if ($searchQueryRaw !== '') {
    $arFilterDrugs['%NAME'] = $searchQueryRaw;
}
?>

<div class="container">
    <div class="drugs-page">

        <h1 class="drugs-page__title">Препараты</h1>

        <div class="drugs-page__controls">

            <!-- Фильтр по категории -->
            <div class="drugs-filter">
                <span class="drugs-filter__label">Категория</span>
                <div class="drugs-filter__chips">
                    <?php foreach ($arCategories as $slug => $cat):
                        $href = '/drugs/?category=' . urlencode($slug);
                        if ($searchQueryRaw !== '') {
                            $href .= '&q=' . urlencode($searchQueryRaw);
                        }
                    ?>
                        <a href="<?= $href ?>"
                           class="chip<?= $currentCategory === $slug ? ' chip--active' : '' ?>">
                            <?= htmlspecialcharsbx($cat['label']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Поиск -->
            <form class="drugs-search" method="get" action="/drugs/">
                <input type="hidden" name="category" value="<?= htmlspecialcharsbx($currentCategory) ?>">
                <span class="drugs-search__label">Поиск</span>
                <div class="drugs-search__field">
                    <input class="drugs-search__input"
                           type="text"
                           name="q"
                           placeholder="Что искать"
                           value="<?= $searchQuery ?>">
                    <button class="drugs-search__btn" type="submit" aria-label="Найти">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="11" cy="11" r="7" stroke="rgba(0,0,0,0.4)" stroke-width="1.5"/>
                            <path d="M16.5 16.5L21 21" stroke="rgba(0,0,0,0.4)" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            </form>

        </div>

        <!-- Сортировка: одна статичная опция А–Я (компонент сортирует по NAME ASC) -->
        <div class="drugs-page__sort">
            <span>Сортировка</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3 6h18M7 12h10M11 18h2" stroke="rgba(0,0,0,0.5)" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span>А – Я</span>
        </div>

        <?php $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "drugs",
            [
                "IBLOCK_TYPE"          => "gerofarm",
                "IBLOCK_ID"            => "5",
                "SORT_BY1"             => "NAME",
                "SORT_ORDER1"          => "ASC",
                "CACHE_TYPE"           => "N",
                "FILTER_NAME"          => "arFilterDrugs",
                "ELEMENTS_COUNT"       => "8",
                "PROPERTY_CODE"        => ["THERAPY_AREA"],
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TEMPLATE"       => "load-more",
                "SET_LAST_ELEMENT_ID"  => "N",
                "CHECK_DATES"          => "N",
            ]
        ); ?>

    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
