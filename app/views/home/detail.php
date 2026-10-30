<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-8">
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline-secondary btn-sm mb-3"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại trang chủ</a>
        
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header card-header-tlu py-3">
                <h5 class="fw-bold mb-0"><i class="fa-solid fa-book me-2"></i>Chi tiết cuốn sách</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4 text-center bg-light p-4 rounded-3 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-bookmark text-primary" style="font-size: 80px;"></i>
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold text-dark"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="text-primary fw-semibold"><i class="fa-solid fa-user-pen me-2"></i>Tác giả: <?= htmlspecialchars($book->getAuthor()) ?></p>
                        <hr>
                        <p><b>Thể loại:</b> <span class="badge bg-info text-dark"><?= htmlspecialchars($book->getCategoryName()) ?></span></p>
                        <p><b>Nhà xuất bản:</b> <?= htmlspecialchars($book->getPublisher()) ?></p>
                        <p><b>Năm xuất bản:</b> <?= htmlspecialchars($book->getPublishYear()) ?></p>
                        <p><b>Số lượng còn lại trong kho:</b> <span class="badge bg-success"><?= htmlspecialchars($book->getQuantity()) ?> cuốn</span></p>
                        <p><b>Mô tả nội dung:</b></p>
                        <p class="text-muted"><?= nl2br(htmlspecialchars($book->getDes() ?: 'Chưa có mô tả chi tiết cho cuốn sách này.')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>