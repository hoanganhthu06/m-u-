<?php
require_once APP_ROOT . '/app/views/layouts/header.php';

$role = $_SESSION['role'] ?? 'user';
$username = $_SESSION['username'] ?? 'bạn';

if ($role == 'admin') {
    $welcome = 'Xin chào, Admin!';
    $description = 'Chào mừng quản trị viên đến với hệ thống thư viện.';
} else {
    $welcome = 'Xin chào, Thành viên!';
    $description = 'Chào mừng bạn đến với thư viện trực tuyến Đại học Thủy Lợi.';
}
?>

<section class="welcome-section">

    <span class="welcome-label">THƯ VIỆN TRỰC TUYẾN THỦY LỢI</span>

    <h1><?= $welcome ?></h1>

    <p><?= $description ?></p>

    <p class="welcome-name">
        Tài khoản: <?= htmlspecialchars($username) ?>
    </p>

</section>

<!-- Khu vực sách -->
<section class="book-section">

    <div class="book-heading">
        <div>
            <h2>Khám phá kho sách</h2>
            <p>Những cuốn sách nổi bật tại thư viện</p>
        </div>

        <a href="?controller=book&action=index" class="view-all">
            Xem tất cả →
        </a>
    </div>

    <div class="book-grid">

        <!-- Sách 1 -->
        <div class="book-card">
            <div class="book-image">
                <img src="python.jpg"
                     alt="Sách lập trình Python">
            </div>

            <div class="book-info">
                <span class="book-category">Công nghệ thông tin</span>
                <h3>Lập trình Python</h3>
                <p>Tác giả: Đang cập nhật</p>
                <a href="?controller=book&action=index">Xem chi tiết</a>
            </div>
        </div>

        <!-- Sách 2 -->
        <div class="book-card">
            <div class="book-image">
                <img src="images/vanhoc.jpg"
                     alt="Sách văn học">
            </div>

            <div class="book-info">
                <span class="book-category">Văn học</span>
                <h3>Tủ sách văn học</h3>
                <p>Tác giả: Đang cập nhật</p>
                <a href="?controller=book&action=index">Xem chi tiết</a>
            </div>
        </div>

        <!-- Sách 3 -->
        <div class="book-card">
            <div class="book-image">
                <img src="kinhte.jpg"
                     alt="Sách kinh tế">
            </div>

            <div class="book-info">
                <span class="book-category">Kinh tế</span>
                <h3>Quản trị kinh doanh</h3>
                <p>Tác giả: Đang cập nhật</p>
                <a href="?controller=book&action=index">Xem chi tiết</a>
            </div>
        </div>

    </div>

</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
