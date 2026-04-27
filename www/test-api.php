<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест API");

$http = new \Bitrix\Main\Web\HttpClient([
    "socketTimeout" => 5,
    "streamTimeout" => 5,
]);

$response = $http->get("https://jsonplaceholder.typicode.com/posts/1");
$data = null;
$error = null;

if ($response === false) {
    $error = "Сетевая ошибка при обращении к API";
} elseif ($http->getStatus() !== 200) {
    $error = "API вернул статус " . $http->getStatus();
} else {
    $decoded = json_decode($response, true);
    if (!is_array($decoded)) {
        $error = "Ответ не является валидным JSON";
    } else {
        $data = $decoded;
    }
}
?>

<div class="page">
    <h1 class="page-title">Ответ от API</h1>

    <? if ($error): ?>
        <div class="alert alert--error"><?= htmlspecialcharsbx($error) ?></div>
    <? else: ?>
        <div class="card">
            <div class="card__row">
                <span class="card__label">ID</span>
                <span class="card__value"><?= (int)$data["id"] ?></span>
            </div>
            <div class="card__row">
                <span class="card__label">Заголовок</span>
                <span class="card__value"><?= htmlspecialcharsbx($data["title"]) ?></span>
            </div>
            <div class="card__row">
                <span class="card__label">Текст</span>
                <span class="card__value"><?= nl2br(htmlspecialcharsbx($data["body"])) ?></span>
            </div>
        </div>
    <? endif; ?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
