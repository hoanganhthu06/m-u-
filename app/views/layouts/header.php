
<?php
// Lấy thông tin người dùng từ session
$username = $_SESSION['username'] ?? 'Khách';
$role = $_SESSION['role'] ?? 'user';

// Xác định lời chào và vai trò
if ($role == 'admin') {
    $welcome = 'Xin chào, Admin!';
    $roleName = 'Quản trị viên';
} else {
    $welcome = 'Xin chào, Thành viên!';
    $roleName = 'Thành viên';
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thư viện Đại học Thủy Lợi</title>

    <!-- Kết nối CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

        <!-- Thanh menu bên trái -->
        <?php require_once APP_ROOT . '/app/views/layouts/sidebar.php'; ?>

        <!-- Khu vực nội dung bên phải -->
        <div class="main-area">

            <!-- Thanh đầu trang -->
            <header class="topbar">

                <div class="topbar-left">
                    <h3>Hệ thống quản lý thư viện</h3>
                </div>

                <div class="topbar-right">

                    <?php if (isset($_SESSION['user_id'])): ?>

                        <!-- Đã đăng nhập -->
                        <div class="user-avatar">👤</div>

                        <div class="user-details">
                            <strong>
                                <?= htmlspecialchars($username) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars($roleName) ?>
                            </span>
                        </div>

                        <a href="?controller=auth&action=logout"
                           class="topbar-btn">
                            Đăng xuất
                        </a>

                    <?php else: ?>

                        <!-- Chưa đăng nhập -->
                        <a href="?controller=auth&action=login"
                           class="topbar-btn">
                            Đăng nhập
                        </a>

                        <a href="?controller=auth&action=register"
                           class="topbar-btn register-btn">
                            Đăng ký
                        </a>

                    <?php endif; ?>

                </div>

            </header>

            <!-- Bắt đầu nội dung từng trang -->
            <main class="content">
