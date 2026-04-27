#!/usr/bin/env bash
# Запуск CLI-скриптов Битрикса внутри контейнера bitrix_web.
# Использование:
#   ./tools.sh db-info
#   ./tools.sh clear-cache
#   ./tools.sh <имя-файла-без-.php>

set -e

if [ -z "$1" ]; then
    echo "Доступные скрипты:"
    ls www/tools/*.php | xargs -n1 basename | grep -v '^_' | sed 's/\.php$//' | sed 's/^/  /'
    exit 0
fi

MSYS_NO_PATHCONV=1 docker exec bitrix_web php "/var/www/html/tools/$1.php" "${@:2}"
