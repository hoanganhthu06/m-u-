<?php
require_once APP_ROOT . '/app/services/CategoryService.php';

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    public function index() {
        $categories = $this->categoryService->getAllCategories();
        require_once APP_ROOT . '/views/categories/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $des = trim($_POST['des']);
            $this->categoryService->addCategory($name, $des);
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }
        require_once APP_ROOT . '/views/categories/add.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $des = trim($_POST['des']);
            $this->categoryService->updateCategory($id, $name, $des);
            header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
            exit();
        }
        $category = $this->categoryService->getCategoryById($id);
        require_once APP_ROOT . '/views/categories/edit.php';
    }

    public function delete() {
    $id = $_GET['id'] ?? null;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Người dùng bấm "Đồng ý xóa" -> Thực hiện xóa trong CSDL
        $this->categoryService->deleteCategory($id);
        header('Location: ' . BASE_URL . '/index.php?controller=category&action=index');
        exit();
    }

    // Người dùng bấm nút Xóa ở danh sách -> Load trang delete.php xác nhận
    $category = $this->categoryService->getCategoryById($id);
    require_once APP_ROOT . '/views/categories/delete.php';
}
}