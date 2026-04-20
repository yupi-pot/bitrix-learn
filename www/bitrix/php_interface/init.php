<?php
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementUpdate",
    function($arFields) {
        $logFile = $_SERVER["DOCUMENT_ROOT"] . "/drug_changes.log";
        $user = isset($GLOBALS["USER"]) ? $GLOBALS["USER"]->GetLogin() : "unknown";
        $time = date("Y-m-d H:i:s");
        $name = isset($arFields["NAME"]) ? $arFields["NAME"] : "unknown";
        
        file_put_contents(
            $logFile,
            "[{$time}] Пользователь '{$user}' сохранил элемент '{$name}'\n",
            FILE_APPEND
        );
    }
);

// Второй обработчик — добавляем
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    function($arFields) {
        $logFile = $_SERVER["DOCUMENT_ROOT"] . "/drug_changes.log";
        $user = isset($GLOBALS["USER"]) ? $GLOBALS["USER"]->GetLogin() : "unknown";
        $time = date("Y-m-d H:i:s");
        $name = isset($arFields["NAME"]) ? $arFields["NAME"] : "unknown";
        
        file_put_contents(
            $logFile,
            "[{$time}] Пользователь '{$user}' добавил новый элемент '{$name}'\n",
            FILE_APPEND
        );
    }
);