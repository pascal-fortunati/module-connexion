<?php
namespace App\Core;

class Csrf
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }

    public static function check($token)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return isset($_SESSION['_csrf_token']) && hash_equals($_SESSION['_csrf_token'], (string)$token);
    }
}