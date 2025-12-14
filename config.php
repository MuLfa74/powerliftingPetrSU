<?php
require __DIR__ . '/vendor/autoload.php';
use App\Core\Logger;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// capture returned values in case getenv() doesn't see them (some environments)
$loaded = $dotenv->load();

$config = [
    'db' => [
        'dsn' => getenv('DB_DSN') ?: ($loaded['DB_DSN'] ?? ''),
        'user' => getenv('DB_USER') ?: ($loaded['DB_USER'] ?? ''),
        'pass' => getenv('DB_PASS') ?: ($loaded['DB_PASS'] ?? '')
    ]
];
Logger::info("Config file DB loaded: " . ($config['db']['dsn'] ?: '<empty>'));
