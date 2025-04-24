<?php

class ConfigLoader
{
    private static $configs = [];

    public static function load($filePath)
    {
        if (!isset(self::$configs[$filePath])) {
            if (file_exists($filePath)) {
                $jsonContent = file_get_contents($filePath);
                self::$configs[$filePath] = json_decode($jsonContent, true);
            } else {
                throw new Exception("File config không tồn tại: " . $filePath);
            }
        }
        return self::$configs[$filePath];
    }
}