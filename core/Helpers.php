<?php

namespace core;

class Helpers {
    public static function setFlash($key, $message) {
        $_SESSION[$key] = $message;
    }

    public static function getFlash($key) {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $message;
        }
        return null;
    }

    public static function format_currency($amount) {
        return number_format($amount, 0, ',', '.') . '₫';
    }
}
