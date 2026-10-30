<?php require_once APP_ROOT . '/app/views/layouts/header.php'; ?>

<div class="container-fluid p-4">

    <h2 class="text-primary mb-4">QUẢN LÝ SÁCH THƯ VIỆN</h2>

    <h4>Số lượng sách: <?= count($books) ?></h4>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-primary">
            <tr>
                <th>Mã sách</th>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Thể loại</th>
                <th>Nhà xuất bản</th>
                <th>Năm xuất bản</th>
                <th>Số lượng</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book->getIdBook()) ?></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars($book->getCategoryName()) ?></td>
                    <td><?= htmlspecialchars($book->getPublisher()) ?></td>
                    <td><?= htmlspecialchars($book->getPublishYear()) ?></td>
                    <td><?= htmlspecialchars($book->getQuantity()) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>