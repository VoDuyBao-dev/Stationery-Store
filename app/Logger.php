<?php

class Logger
{
    private static $file = _DIR_ROOT . '/app/logs/error.log';

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