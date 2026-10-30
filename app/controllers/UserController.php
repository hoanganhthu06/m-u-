<?php
require_once APP_ROOT . '/app/services/ReaderService.php';

class UserController {
    private $readerService;

    public function __construct() {
        $this->readerService = new ReaderService();
    }

    // Quản lý độc giả (Admin)
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $search = $_GET['search'] ?? '';
        $readers = $this->readerService->getAllUsersWithReaders($search);
        require_once APP_ROOT . '/views/readers/index.php';
    }

    // Trang Hồ sơ cá nhân (User)
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
            exit();
        }

        $id_user = $_SESSION['user']['id_user'];
        $reader_info = $this->readerService->getReaderByUserId($id_user);
        require_once APP_ROOT . '/views/users/profile.php';
    }

    // Xóa độc giả
   public function delete() {
    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->readerService->deleteUserAndReader($id);
        header('Location: ' . BASE_URL . '/index.php?controller=user&action=index');
        exit();
    }

    $user = $this->readerService->getReaderByUserId($id);
    require_once APP_ROOT . '/views/readers/delete.php';
}
}