<?php

namespace App;

class Logger
{
    private static $file;

    public static function init()
    {
        // Định nghĩa đường dẫn tệp log
        self::$file = _DIR_ROOT . '/app/logs/error.log';

        // Kiểm tra và tạo thư mục logs nếu chưa tồn tại
        $logDir = dirname(self::$file);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
    }

    public static function logError($message)
    {
        self::writeLog('ERROR', $message);
    }

    public static function logInfo($message)
    {
        self::writeLog('INFO', $message);
    }

    public static function logWarning($message)
    {
        self::writeLog('WARNING', $message);
    }

    private static function writeLog($type, $message)
    {
        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date] [$type] $message" . PHP_EOL;
        file_put_contents(self::$file, $logMessage, FILE_APPEND);
    }
}

// Khởi tạo Logger
Logger::init();
