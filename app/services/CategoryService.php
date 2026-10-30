
<?php

require_once APP_ROOT . '/app/libs/DBConnection.php';
require_once APP_ROOT . '/app/models/Category.php';

class CategoryService
{
    private $db;

    public function __construct()
    {
        // Khởi tạo kết nối database
        $database = new DBConnection();
        $this->db = $database->getConnection();
    }

    // Lấy tất cả thể loại
    public function getAllCategories()
    {
        $stmt = $this->db->prepare("
            SELECT id_category, name_category, des
            FROM categories
            ORDER BY id_category DESC
        ");

        $stmt->execute();

        $categories = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category(
                $row['id_category'],
                $row['name_category'],
                $row['des']
            );
        }

        return $categories;
    }

    // Lấy thông tin một thể loại theo ID
    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("
            SELECT id_category, name_category, des
            FROM categories
            WHERE id_category = :id
        ");

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row
            ? new Category(
                $row['id_category'],
                $row['name_category'],
                $row['des']
            )
            : null;
    }

    // Thêm thể loại
    public function addCategory($name_category, $des)
    {
        $stmt = $this->db->prepare("
            INSERT INTO categories (name_category, des)
            VALUES (:name_category, :des)
        ");

        return $stmt->execute([
            'name_category' => $name_category,
            'des' => $des
        ]);
    }

    // Cập nhật thể loại
    public function updateCategory($id, $name_category, $des)
    {
        $stmt = $this->db->prepare("
            UPDATE categories
            SET name_category = :name_category,
                des = :des
            WHERE id_category = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'name_category' => $name_category,
            'des' => $des
        ]);
    }

    // Xóa thể loại
    public function deleteCategory($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM categories
            WHERE id_category = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}
