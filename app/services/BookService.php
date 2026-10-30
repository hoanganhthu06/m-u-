
<?php

require_once APP_ROOT . '/app/libs/DBConnection.php';
require_once APP_ROOT . '/app/models/Book.php';

class BookService
{
    private $db;

    public function __construct()
    {
        // Khởi tạo đối tượng DBConnection
        $database = new DBConnection();

        // Lấy kết nối PDO
        $this->db = $database->getConnection();
    }

    // Lấy danh sách sách có tìm kiếm và lọc thể loại
    public function searchAndFilterBooks($keyword = '', $category_id = '')
    {
        $sql = "SELECT books.*, categories.name_category AS category_name
                FROM books
                LEFT JOIN categories
                ON books.id_category = categories.id_category
                WHERE 1=1";

        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (books.title LIKE :kw OR books.author LIKE :kw)";
            $params['kw'] = "%$keyword%";
        }

        if (!empty($category_id)) {
            $sql .= " AND books.id_category = :cat_id";
            $params['cat_id'] = $category_id;
        }

        $sql .= " ORDER BY books.id_book DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $books = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Lấy tất cả sách
    public function getAllBooks($keyword = '')
    {
        return $this->searchAndFilterBooks($keyword);
    }

    // Lấy chi tiết một cuốn sách
    public function getBookById($id)
    {
        $sql = "SELECT books.*, categories.name_category AS category_name
                FROM books
                LEFT JOIN categories
                ON books.id_category = categories.id_category
                WHERE books.id_book = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Book($row) : null;
    }

    // Thêm sách mới
    public function addBook($data)
    {
        $sql = "INSERT INTO books
                (id_category, title, author, publisher, publish_year, quantity, cover_image, des)
                VALUES
                (:id_category, :title, :author, :publisher, :publish_year, :quantity, :cover_image, :des)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_category' => $data['id_category'],
            'title' => $data['title'],
            'author' => $data['author'],
            'publisher' => $data['publisher'],
            'publish_year' => $data['publish_year'],
            'quantity' => $data['quantity'],
            'cover_image' => $data['cover_image'],
            'des' => $data['des']
        ]);
    }

    // Cập nhật thông tin sách
    public function updateBook($id, $data)
    {
        $sql = "UPDATE books SET
                id_category = :id_category,
                title = :title,
                author = :author,
                publisher = :publisher,
                publish_year = :publish_year,
                quantity = :quantity,
                cover_image = :cover_image,
                des = :des
                WHERE id_book = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_category' => $data['id_category'],
            'title' => $data['title'],
            'author' => $data['author'],
            'publisher' => $data['publisher'],
            'publish_year' => $data['publish_year'],
            'quantity' => $data['quantity'],
            'cover_image' => $data['cover_image'],
            'des' => $data['des'],
            'id' => $id
        ]);
    }

    // Xóa sách
    public function deleteBook($id)
    {
        $sql = "DELETE FROM books WHERE id_book = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
