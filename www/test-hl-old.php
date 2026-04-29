<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Highloadblock\HighloadBlockTable;

$APPLICATION->SetTitle('Учебно: чтение HL-справочника через старый API');

$DRUGS_IBLOCK_ID = 5;
$HL_TABLE_NAME   = 'b_hlbd_drug_indications';

// 1. Получаем все препараты со свойством INDICATIONS_LIST
$drugs = [];
$rsDrugs = CIBlockElement::GetList(
    ['SORT' => 'ASC', 'NAME' => 'ASC'],
    ['IBLOCK_ID' => $DRUGS_IBLOCK_ID, 'ACTIVE' => 'Y'],
    false,
    false,
    ['ID', 'IBLOCK_ID', 'NAME']
);
while ($drug = $rsDrugs->GetNextElement()) {
    $fields = $drug->GetFields();
    $props  = $drug->GetProperty('INDICATIONS_LIST');
    $allProps = $drug->GetProperties();

    $drugs[] = [
        'ID'              => $fields['ID'],
        'NAME'            => $fields['NAME'],
        'INDICATIONS'     => is_array($props['VALUE']) ? $props['VALUE'] : ($props['VALUE'] ? [$props['VALUE']] : []),
        '_GetProperty'    => $props,
        '_AllPropsKeys'   => array_keys($allProps),
        '_INDICATIONS_LIST_RAW' => $allProps['INDICATIONS_LIST'] ?? '<нет такого ключа>',
    ];
}

// 2. По каждому UF_XML_ID идём в HL-блок и достаём UF_NAME + UF_CODE_ICD10
$hlBlock = HighloadBlockTable::getList([
    'filter' => ['=TABLE_NAME' => $HL_TABLE_NAME],
])->fetch();

$entity      = HighloadBlockTable::compileEntity($hlBlock);
$entityClass = $entity->getDataClass();

$indicationsCache = [];
foreach ($drugs as &$drug) {
    $resolved = [];
    foreach ($drug['INDICATIONS'] as $xmlId) {
        if (isset($indicationsCache[$xmlId])) {
            $resolved[] = $indicationsCache[$xmlId];
            continue;
        }

        $row = $entityClass::getList([
            'filter' => ['=UF_XML_ID' => $xmlId],
            'select' => ['UF_NAME', 'UF_CODE_ICD10'],
            'limit'  => 1,
        ])->fetch();

        if ($row) {
            $indicationsCache[$xmlId] = $row;
            $resolved[] = $row;
        }
    }
    $drug['INDICATIONS_RESOLVED'] = $resolved;
}
unset($drug);
?>

<style>
    .drug-card { border: 1px solid #ddd; padding: 16px; margin: 12px 0; border-radius: 6px; }
    .drug-card h3 { margin: 0 0 8px; }
    .drug-card ul { margin: 0; padding-left: 20px; }
    .drug-card .empty { color: #999; font-style: italic; }
    .icd { color: #666; font-family: monospace; }
</style>

<h1>Препараты и показания (старый API)</h1>

<details style="margin: 16px 0; padding: 12px; background: #f5f5f5; border: 1px solid #ccc;">
    <summary style="cursor: pointer; font-weight: bold;">Отладка: что в массиве $drugs</summary>
    <pre style="font-size: 12px; overflow-x: auto;"><?= htmlspecialcharsbx(print_r($drugs, true)) ?></pre>
</details>

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
