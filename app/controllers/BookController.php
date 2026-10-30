
<?php

require_once APP_ROOT . '/app/services/BookService.php';
require_once APP_ROOT . '/app/services/CategoryService.php';

class BookController
{
    private $bookService;
    private $categoryService;

    public function __construct()
    {
        $this->bookService = new BookService();
        $this->categoryService = new CategoryService();
    }

    /*
    // Hiển thị danh sách sách
    public function index()
    {
        $books = $this->bookService->getAllBooks();

        require_once APP_ROOT . '/app/views/books/index.php';
    }
    */
    // Hiển thị danh sách sách
public function index()
{
    $books = $this->bookService->getAllBooks();

    require_once APP_ROOT . '/app/views/books/index.php';
}
    // Thêm sách mới
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'title'        => trim($_POST['title'] ?? ''),
                'id_category'  => trim($_POST['id_category'] ?? ''),
                'author'       => trim($_POST['author'] ?? ''),
                'publisher'    => trim($_POST['publisher'] ?? ''),
                'publish_year' => trim($_POST['publish_year'] ?? ''),
                'quantity'     => trim($_POST['quantity'] ?? 1),
                'cover_image'  => 'python.jpg',
                'des'          => trim($_POST['des'] ?? '')
            ];

            $this->bookService->addBook($data);

            header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
            exit();
        }

        $categories = $this->categoryService->getAllCategories();

        require_once APP_ROOT . '/app/views/books/add.php';
    }

    // Sửa thông tin sách
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            die('Không tìm thấy mã sách!');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'title'        => trim($_POST['title'] ?? ''),
                'id_category'  => trim($_POST['id_category'] ?? ''),
                'author'       => trim($_POST['author'] ?? ''),
                'publisher'    => trim($_POST['publisher'] ?? ''),
                'publish_year' => trim($_POST['publish_year'] ?? ''),
                'quantity'     => trim($_POST['quantity'] ?? 0),
                'cover_image'  => 'python.jpg',
                'des'          => trim($_POST['des'] ?? '')
            ];

            $this->bookService->updateBook($id, $data);

            header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
            exit();
        }

        $book = $this->bookService->getBookById($id);

        if (!$book) {
            die('Không tìm thấy sách!');
        }

        $categories = $this->categoryService->getAllCategories();

        require_once APP_ROOT . '/app/views/books/edit.php';
    }

    // Xóa sách
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            die('Không tìm thấy mã sách!');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->bookService->deleteBook($id);

            header('Location: ' . BASE_URL . '/index.php?controller=book&action=index');
            exit();
        }

        $book = $this->bookService->getBookById($id);

        if (!$book) {
            die('Không tìm thấy sách!');
        }

        require_once APP_ROOT . '/app/views/books/delete.php';
    }
}
