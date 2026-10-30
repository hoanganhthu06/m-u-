
<?php

class AuthMiddleware
{
    // Kiem tra nguoi dung da dang nhap chua
    public static function checkLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
    }

    // Kiem tra nguoi dung co phai Admin khong
    public static function checkAdmin()
    {
        // Truoc tien phai dang nhap
        self::checkLogin();

        // Kiem tra quyen Admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            echo 'Ban khong co quyen truy cap chuc nang nay!';
            exit;
        }
    }
}
