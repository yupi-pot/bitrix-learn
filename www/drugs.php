<?php
// Постоянный редирект на каноничный URL страницы препаратов
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
LocalRedirect("/drugs/", true);
