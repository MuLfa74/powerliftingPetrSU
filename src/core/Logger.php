<?php

namespace App\Core;

class Logger
{
    public static function info(string $message): void
    {
        error_log('[INFO] ' . $message);
    }

    public static function warning(string $message): void
    {
        error_log('[WARN] ' . $message);
    }

    public static function error(string $message): void
    {
        error_log('[ERROR] ' . $message);
    }
}
