<?php

/**
 * Модуль для ручной загрузки переменных из .env и создания хелпера env()
 */

// 1. Путь к .env (на два уровня выше от site/config)
$envPath = dirname(__DIR__, 2) . '/.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Пропускаем комментарии и пустые строки
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        
        // Разбиваем строку только по первому знаку "="
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name  = trim($name);
            $value = trim($value);
            
            // Убираем кавычки, если они есть
            $value = trim($value, '"\'');
            
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value; // На всякий случай дублируем в SERVER
        }
    }
}

// 2. Глобальная функция-хелпер
if (!function_exists('env')) {
    function env(string $key, $default = null) {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

        if ($value === false || $value === null) {
            return $default;
        }

        // Приведение строковых значений из .env к типам PHP
        switch (strtolower($value)) {
            case 'true':  return true;
            case 'false': return false;
            case 'null':  return null;
            case 'empty': return '';
        }

        return $value;
    }
}
