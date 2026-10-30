
<?php

// Khoi tao duong dan goc cua du an
define('APP_ROOT', dirname(__DIR__));

// Khoi tao session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nap cac file can thiet
require_once APP_ROOT . '/app/libs/DBConnection.php';
require_once APP_ROOT . '/app/models/User.php';
require_once APP_ROOT . '/app/services/AuthService.php';
require_once APP_ROOT . '/app/controllers/AuthController.php';
require_once APP_ROOT . '/app/libs/AuthMiddleware.php';
require_once APP_ROOT . '/app/models/Book.php';
require_once APP_ROOT . '/app/services/BookService.php';
require_once APP_ROOT . '/app/controllers/BookController.php';
require_once APP_ROOT . '/app/services/CategoryService.php';

// Lay controller va action tu URL
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Khoi tao controller
switch ($controller) {

    // =========================
    // DANG NHAP, DANG KY
    // =========================
    case 'auth':

        $authController = new AuthController();

        switch ($action) {

            case 'register':
                $authController->register();
                break;

            case 'store':
                $authController->store();
                break;

            case 'login':
                $authController->login();
                break;

            case 'authenticate':
                $authController->authenticate();
                break;

            case 'logout':
                $authController->logout();
                break;

            default:
                echo 'Chuc nang khong ton tai!';
                break;
        }

        break;


    // =========================
    // TRANG CHU DUNG CHUNG
    // =========================
    case 'home':

        require_once APP_ROOT . '/app/views/home/index.php';

        break;


    // =========================
    // KHU VUC ADMIN
    // =========================
    case 'admin':

        AuthMiddleware::checkAdmin();

        switch ($action) {

            case 'index':
                require_once APP_ROOT . '/app/views/home/index.php';
                break;

            default:
                echo 'Chuc nang Admin khong ton tai!';
                break;
        }

        break;


    // =========================
    // QUAN LY SACH
    // =========================
    case 'book':
    AuthMiddleware::checkLogin();

    $bookController = new BookController();

    switch ($action) {
        case 'index':
            $bookController->index();
            break;

        case 'add':
            $bookController->add();
            break;

        case 'edit':
            $bookController->edit();
            break;

        case 'delete':
            $bookController->delete();
            break;

        default:
            echo 'Chức năng sách không tồn tại!';
            break;
    }
    break;


    // =========================
    // CAC CHUC NANG KHAC
    // =========================
    case 'reader':
    case 'category':
    case 'borrow':
    case 'review':
    case 'account':

        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        echo 'Chuc nang nay dang duoc xay dung!';

        break;


    // =========================
    // DUONG DAN KHONG TON TAI
    // =========================
    default:

        echo 'Trang khong ton tai!';

        break;
}
