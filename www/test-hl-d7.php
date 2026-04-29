<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\ElementPropertyTable;
use Bitrix\Highloadblock\HighloadBlockTable;

$APPLICATION->SetTitle('Учебно: чтение HL-справочника через D7');

$DRUGS_IBLOCK_ID         = 5;
$INDICATIONS_PROPERTY_ID = 13;
$HL_TABLE_NAME           = 'b_hlbd_drug_indications';

// 1. Все препараты — 1 запрос
$drugs = ElementTable::getList([
    'filter' => ['=IBLOCK_ID' => $DRUGS_IBLOCK_ID, '=ACTIVE' => 'Y'],
    'select' => ['ID', 'NAME'],
    'order'  => ['SORT' => 'ASC', 'NAME' => 'ASC'],
])->fetchAll();

$drugIds = array_column($drugs, 'ID');

// 2. Все привязки HL-показаний к этим препаратам — 1 запрос
$bindings = ElementPropertyTable::getList([
    'filter' => [
        '=IBLOCK_PROPERTY_ID'  => $INDICATIONS_PROPERTY_ID,
        '=IBLOCK_ELEMENT_ID'   => $drugIds,
    ],
    'select' => ['IBLOCK_ELEMENT_ID', 'VALUE'],
])->fetchAll();

$xmlIdsByDrug = [];
foreach ($bindings as $b) {
    $xmlIdsByDrug[$b['IBLOCK_ELEMENT_ID']][] = $b['VALUE'];
}

$allXmlIds = array_unique(array_column($bindings, 'VALUE'));

// 3. Все нужные показания из HL разом — 1 запрос (если есть привязки)
$indicationsByXmlId = [];

if (!empty($allXmlIds)) {
    $hlBlock     = HighloadBlockTable::getList(['filter' => ['=TABLE_NAME' => $HL_TABLE_NAME]])->fetch();
    $entity      = HighloadBlockTable::compileEntity($hlBlock);
    $entityClass = $entity->getDataClass();

    $rows = $entityClass::getList([
        'filter' => ['=UF_XML_ID' => $allXmlIds],
        'select' => ['UF_NAME', 'UF_CODE_ICD10', 'UF_XML_ID'],
    ])->fetchAll();

    foreach ($rows as $row) {
        $indicationsByXmlId[$row['UF_XML_ID']] = $row;
    }
}

// 4. Склейка
foreach ($drugs as &$drug) {
    $resolved = [];
    foreach ($xmlIdsByDrug[$drug['ID']] ?? [] as $xmlId) {
        if (isset($indicationsByXmlId[$xmlId])) {
            $resolved[] = $indicationsByXmlId[$xmlId];
        }
    }
    $drug['INDICATIONS_RESOLVED'] = $resolved;
}
unset($drug);
?>

<style>
    .drug-card { border: 1px solid #ddd; padding: 16px; margin: 12px 0; border-radius: 6px; background: #fff; }
    .drug-card h3 { margin: 0 0 8px; color: #222; }
    .drug-card ul { margin: 0; padding-left: 20px; color: #333; }
    .drug-card .empty { color: #888; font-style: italic; }
    .icd { color: #666; font-family: monospace; }
    .stats { background: #eef6ff; border: 1px solid #b3d4ff; padding: 12px; margin: 12px 0; border-radius: 6px; color: #003a75; }
</style>

<h1>Препараты и показания (D7)</h1>

<div class="stats">
    <strong>Запросов в БД:</strong> 3 (препараты + привязки + показания), независимо от количества препаратов.<br>
    <strong>Сравни:</strong> старый API делал 1 + N (по запросу на каждый препарат через GetProperty) + запросы за HL.
</div>

<?php foreach ($drugs as $drug): ?>
    <div class="drug-card">
        <h3><?= htmlspecialcharsbx($drug['NAME']) ?></h3>
        <?php if (empty($drug['INDICATIONS_RESOLVED'])): ?>
            <div class="empty">Показания не указаны</div>
        <?php else: ?>
            <ul>
                <?php foreach ($drug['INDICATIONS_RESOLVED'] as $indication): ?>
                    <li>
                        <?= htmlspecialcharsbx($indication['UF_NAME']) ?>
                        <?php if ($indication['UF_CODE_ICD10']): ?>
                            <span class="icd">(<?= htmlspecialcharsbx($indication['UF_CODE_ICD10']) ?>)</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
