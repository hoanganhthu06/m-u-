<?php require_once APP_ROOT . '/app/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-8">
        <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
        </a>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header card-header-tlu py-3">
                <h5 class="fw-bold mb-0"><i class="fa-solid fa-plus me-2"></i>Thêm sách mới vào kho</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/index.php?controller=book&action=add" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tên sách <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Ví dụ: Lập trình Web với PHP & MySQL">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Thể loại <span class="text-danger">*</span></label>
                            <select name="id_category" class="form-select" required>
                                <option value="">-- Chọn thể loại --</option>
                                <?php foreach ($categories as $cat): ?>
                                   <option value="<?= $cat->getIdCategory() ?>"><?= htmlspecialchars($cat->getNameCategory()) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tác giả <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control" required placeholder="Nhập tên tác giả...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nhà xuất bản</label>
                            <input type="text" name="publisher" class="form-control" placeholder="Ví dụ: NXB Giáo Dục">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Năm xuất bản</label>
                            <input type="number" name="publish_year" class="form-control" value="2026" placeholder="2026">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Số lượng nhập kho <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" value="10" min="1" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Mô tả tóm tắt nội dung</label>
                            <textarea name="des" class="form-control" rows="4" placeholder="Nhập tóm tắt nội dung cuốn sách..."></textarea>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-primary fw-bold px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Lưu sách mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>