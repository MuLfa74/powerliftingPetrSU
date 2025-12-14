<?php
require __DIR__ . '/config.php'; // содержит параметры БД
use App\Core\Logger;

// Подключение к БД
$dsn = $config['db']['dsn'] ?? '';
$user = $config['db']['user'] ?? null;
$pass = $config['db']['pass'] ?? null;

Logger::info("Try to connect to DB");

if (empty($dsn) || strpos($dsn, ':') === false) {
    Logger::error("DB DSN invalid or empty, falling back to local SQLite database.");
    $dsn = 'sqlite:' . __DIR__ . '/app.db';
}

try {
    $db = new PDO(
        $dsn,
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    Logger::info("DB connection success");
} catch (PDOException $e) {
    Logger::error("DB connection error: " . $e->getMessage());
    $db = null;
}