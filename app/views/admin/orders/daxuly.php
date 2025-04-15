<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/orders/donhang.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet"
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/orders/donhang.js"></script>
    <style>
        menu {
            float: left;
        }

        main {
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>

</head>

<body>
    <header>
        <?php require_once _DIR_ROOT . "/app/views/blocks/header-admin.php"; ?>
    </header>

    <menu>
        <?php require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php"; ?>
    </menu>
    <main>
        <div class="order-container">
            <h2>Quản lý đơn hàng</h2>
            <div class="tabs">
                <button class="tab" onclick="redirectTo('<?php echo _WEB_ROOT . '/canxuly'; ?>')">Cần xử lý (0)</button>
                <button class="tab active" onclick="redirectTo('<?php echo _WEB_ROOT . '/daxuly'; ?>')">Đã xử lý (0)</button>
            </div>

            <div class="actions">
                <input type="date" class="date-picker">
            </div>
            <div class="search-container">
                <input type="text" id="order-id" placeholder="Nhập mã đơn hàng">
                <button id="search-btn">Q</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Người sửa đơn</th>
                        <th>Thời gian sửa đơn</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($ordersDone) == 0): ?>
                        <tr>
                            <td colspan="6" class="no-data">Không có bản ghi nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($ordersDone as $order): ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['fullname']; ?></td>
                                <td><?php echo $order['updated_at']; ?></td>
                                <td><button class="delete-btn" data-id="<?= $order['order_id'] ?>">Xem chi tiết</button></td>
                                <!-- vì đơn hàng đã hoàn thành nên không nên xóa để có dữ liệu làm báo cáo doanh thu -->
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Modal xác nhận xóa -->
            <div id="confirmDeleteModal" style="display: none;">
                <form action="<?php echo _BASE_URL; ?>/destroyOrder" method="POST">
                    <div class="modal-content">
                        <h3>Bạn có chắc chắn muốn xóa đơn hàng này?</h3>
                        <div class="form-actions">
                            <input type="hidden" name="order_id" id="delete-order_id">
                            <button id="cancelDeleteBtn" class="cancel-btn" type="button">Hủy</button>
                            <button id="confirmDeleteBtn" type='submit'>Xóa</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="footer">
                <span>Bản Ghi Mỗi Trang</span>
                <select>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <span>0 of 0</span>
                <button>&lt;</button>
                <button>&gt;</button>
            </div>
        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>
</body>

</html>