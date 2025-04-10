<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khuyến mãi</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/sales/sale.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet"
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
            float: left;
        }

        main {
            margin-top: 120px;
            margin-left: 280px;
        }

        .modal {
            display: none;
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

        <div class="sale-container">
            <h2>Quản lý Khuyến mãi</h2>

            <div id="promotion-actions">
                <button id="add-promotion-btn">Thêm khuyến mãi mới</button>
            </div>

            <table id="promotion-table">
                <thead>
                    <tr>
                        <th>Mã giảm giá</th>
                        <th>Giá tối thiểu</th>
                        <th>Giảm (%)</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($coupons) == 0): ?>
                        <tr id="no-data-row">
                            <td colspan="7" class="no-data">Không có khuyến mãi nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($coupons as $coupon): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($coupon['code']); ?></td>
                                <td><?php echo htmlspecialchars($coupon['price_min']); ?></td>
                                <td><?php echo htmlspecialchars($coupon['discount']); ?></td>
                                <td><?php echo htmlspecialchars($coupon['start_date']); ?></td>
                                <td><?php echo htmlspecialchars($coupon['end_date']); ?></td>
                                <td><?php echo htmlspecialchars($coupon['status']); ?></td>
                                <td class="actions">
                                    <button class="edit-btn" data-id="<?= $coupon['coupon_id'] ?>">Sửa</button>
                                    <button class="delete-btn" data-id="<?= $coupon['coupon_id'] ?>">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close add-modal-close">&times;</span>
                    <h2>Thêm khuyến mãi mới</h2>
                    <form id="promotion-form" method="POST" action="<?php echo _BASE_URL; ?>/store">
                        <div class="form-group">
                            <!-- <label for="code">Mã giảm giá:</label>
                            <input type="text" id="code" name="code" required> -->
                            <label for="price_min">Giá tối thiểu:</label>
                            <input type="number" id="price_min" name="price_min" min="0">
                            <label for="discount">Giảm (%):</label>
                            <input type="number" id="discount" name="discount" min="0" max="100">
                            <label for="start_date">Ngày bắt đầu:</label>
                            <input type="date" id="start_date" name="start_date" required>
                            <label for="end_date">Ngày kết thúc:</label>
                            <input type="date" id="end_date" name="end_date" required>
                            <label for="status">Trạng thái:</label>
                            <select id="status" name="status">
                                <option value="1">Đang áp dụng</option>
                                <option value="0">Hết hạn</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="cancel-btn add-modal-close">Hủy</button>
                            <button type="submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close edit-modal-close">&times;</span>
                    <h2>Sửa khuyến mãi</h2>
                    <form id="edit-promotion-form" action="<?php echo _BASE_URL; ?>/update" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="coupon_id" id="edit-coupon-id">
                            <label for="code">Mã giảm giá:</label>
                            <input type="text" id="code" name="code" value="<?php echo $coupon['code'] ?>" readonly>
                            <label for="price_min">Giá tối thiểu:</label>
                            <input type="number" name="price_min" value="<?php echo $coupon['price_min'] ?>" required>
                            <label for="discount">Giảm (%):</label>
                            <input type="number" name="discount" value="<?php echo $coupon['discount'] ?>" required min="0" max="100">
                            <label for="start_date">Ngày bắt đầu:</label>
                            <input type="date" name="start_date" value="<?php echo date('Y-m-d', strtotime($coupon['start_date'])); ?>">
                            <label for="end_date">Ngày kết thúc:</label>
                            <input type="date" name="end_date" value="<?php echo date('Y-m-d', strtotime($coupon['end_date'])); ?>">
                            <label for="status">Trạng thái:</label>
                            <select id="status" name="status">
                                <option value="1">Đang áp dụng</option>
                                <option value="0">Hết hạn</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="cancel-btn edit-modal-close">Hủy</button>
                            <button type="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal xác nhận xóa -->
        <div id="confirmDeleteModal" class="modal">
            <form action="<?php echo _BASE_URL; ?>/destroy" method="POST">
                <div class="modal-content">
                    <h3>Bạn có chắc chắn muốn xóa khuyến mãi này?</h3>
                    <div class="form-actions">
                        <input type="hidden" name="coupon_id" id="delete-coupon-id">
                        <button id="cancelDeleteBtn" class="cancel-btn">Hủy</button>
                        <button id="confirmDeleteBtn" type='submit'>Xóa</button>
                    </div>
                </div>
            </form>
        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/sales/sale.js"></script>
</body>

</html>