<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý Đơn hàng - Cần xử lý</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/orders/donhang.css" />
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
            <h2>Quản lý đơn hàng - Cần xử lý</h2>

            <div class="tabs">
                <button class="tab active" id="tab-can-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/canxuly'; ?>')">Cần xử lý (<span id="count-can-xu-ly">0</span>)</button>
                <button class="tab" id="tab-da-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/daxuly'; ?>')">Đã xử lý (<span id="count-da-xu-ly">0</span>)</button>
            </div>
            <div class="actions"><input type="date" class="date-picker" /></div>
            <div id="order-actions"><button id="add-order-btn">Thêm đơn hàng mới</button></div>
            <table id="order-table">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Người nhận</th>
                        <th>Tổng hóa đơn</th>
                        <th>Phương thức thanh toán</th>
                        <th>Phương thức vận chuyển</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($orders) == 0): ?>
                        <tr>
                            <td colspan="8" class="no-data">Không có bản ghi nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                                <td><?php echo htmlspecialchars($order['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                                <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                                <td><?php echo htmlspecialchars($order['transport_name']); ?></td>

                                <td><?php switch ($order['trangThaiGiao']) {
                                        case '0':
                                            echo 'Chờ xác nhận';
                                            break;
                                        case '1':
                                            echo 'Đang giao hàng';
                                            break;
                                        case '2':
                                            echo 'Đã hủy';
                                            break;
                                        default:
                                            echo 'Không xác định';
                                    } ?></td>
                                <!--Trạng thái 0: chờ xác nhận nên có thể sửa thôn tin đơn hàng.
                                tráng thái 1: đang giao hàng nên có thể hủy
                                trạng thái 2: đã hủy nên có thể xóa 
                                vì là giao diện cho đơn cần xử lí nên không có trạng thái 3(đã giao thành công)-->
                                <?php if ($order['trangThaiGiao'] == 0) : ?>
                                    <td><button class="edit-btn" data-id="<?php echo $order['order_id']; ?>">Sửa</button></td>
                                <?php elseif ($order['trangThaiGiao'] == 1) : ?>
                                    <td><button class="huy-bn" data-id="<?php echo $order['order_id']; ?>">Hủy đơn</button></td>
                                <?php else: ?>
                                    <td><button class="delete-btn" data-id="<?php echo $order['order_id']; ?>">Xóa</button></td>
                                <?php endif; ?>
                                <td><button class="viewOrderDetail-btn" data-id="<?php echo $order['order_id']; ?>">Xem chi tiết</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Thêm đơn hàng mới -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Thêm đơn hàng mới</h2>
                    <form id="order-form">
                        <div class="form-group">
                            <label for="ma">Mã đơn hàng:</label>
                            <input type="text" id="ma" name="ma" />
                        </div>
                        <div class="form-group">
                            <label for="ngay">Ngày đặt hàng:</label>
                            <input type="date" id="ngay" name="ngay" />
                        </div>
                        <div class="form-group">
                            <label for="nguoi">Người nhận:</label>
                            <input type="text" id="nguoi" name="nguoi" />
                        </div>
                        <div class="form-group">
                            <label for="tong">Tổng hóa đơn:</label>
                            <input type="text" id="tong" name="tong" />
                        </div>
                        <div class="form-group">
                            <label for="thanhtoan">Phương thức thanh toán:</label>
                            <input type="text" id="thanhtoan" name="thanhtoan" />
                        </div>
                        <div class="form-group">
                            <label for="vanchuyen">Phương thức vận chuyển:</label>
                            <input type="text" id="vanchuyen" name="vanchuyen" />
                        </div>
                        <div class="form-actions">
                            <button type="button" id="cancel-btn">Hủy</button>
                            <button type="submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sủa thông tin đơn hàng -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Sửa đơn hàng</h2>
                    <form id="edit-order-form">
                        <div class="form-group">
                            <label for="edit-ma">Mã đơn hàng:</label>
                            <input type="text" id="edit-ma" name="edit-ma" readonly />
                        </div>
                        <div class="form-group">
                            <label for="edit-ngay">Ngày đặt hàng:</label>
                            <input type="date" id="edit-ngay" name="edit-ngay" />
                        </div>
                        <div class="form-group">
                            <label for="edit-nguoi">Người nhận:</label>
                            <input type="text" id="edit-nguoi" name="edit-nguoi" />
                        </div>
                        <div class="form-group">
                            <label for="edit-tong">Tổng hóa đơn:</label>
                            <input type="text" id="edit-tong" name="edit-tong" />
                        </div>
                        <div class="form-group">
                            <label for="edit-thanhtoan">Phương thức thanh toán:</label>
                            <input type="text" id="edit-thanhtoan" name="edit-thanhtoan" />
                        </div>
                        <div class="form-group">
                            <label for="edit-vanchuyen">Phương thức vận chuyển:</label>
                            <input type="text" id="edit-vanchuyen" name="edit-vanchuyen" />
                        </div>
                        <div class="form-actions">
                            <button type="button" id="edit-cancel-btn">Hủy</button>
                            <button type="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Xóa đơn hàng -->
            <div id="confirmDeleteModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Xác nhận xóa</h2>
                    <p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
                    <div class="form-actions">
                        <button type="button" id="cancelDeleteBtn">Hủy</button>
                        <button id="confirmDeleteBtn">Xóa</button>
                    </div>
                </div>
            </div>


            <!-- Modal hiển thị chi tiết đơn hàng -->
            <div id="viewDetailModal" class="modal">
                <span class="close">&times;</span>
                <table id="orderDetailtable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên đơn hàng</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá </th>
                            <th>Giá vận chuyển</th>
                            <th>Giá cuối cùng</th>
                        </tr>
                    </thead>
                    <tbody id="order-details-table-body"></tbody>
                </table>

                <!-- Nút Sửa sẽ được hiển thị nếu trạng thái giao là 0 -->
                <div style="text-align: right; margin-bottom: 10px;">
                    <button id="xacNhan" value="">Xác nhận</button>
                </div>
            </div>


            <!-- Sửa chi tiết đơn hàng -->
            <div id="editDetailModal" class="modal">
                <span class="close">&times;</span>
                <form id="editOrderDetailForm" method="POST" action="<?php echo _WEB_ROOT ?>/updateOrderDetail">
                    <input type="hidden" name="order_detail_id" id="edit_order_detail_id">
                    <input type="hidden" name="order_id" id="edit_order_id">

                    <label>Tên đơn hàng:</label>
                    <input type="text" name="tenDonHang" id="edit_tenDonHang" required><br>

                    <label>Số điện thoại:</label>
                    <input type="text" name="phone" id="edit_phone" required><br>

                    <label>Địa chỉ:</label>
                    <input type="text" name="address" id="edit_address" required><br>

                    <label>Ghi chú:</label>
                    <textarea name="ghiChu" id="edit_ghiChu"></textarea><br>

                    <label>Giá sản phẩm:</label>
                    <input type="number" name="edit_priceCurrent" id="edit_priceCurrent" step="0.01" readonly><br>

                    <label>Số lượng:</label>
                    <input type="number" name="quantity" id="edit_quantity" required><br>

                    <label>Phương thức vận chuyển:</label>
                    <select name="transport_id" id="edit_transport_id" required></select><br>

                    <button type="submit">Cập nhật</button>
                </form>
            </div>




        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>
    <script>
        const baseURL = "<?php echo _BASE_URL; ?>";
    </script>
    <script type="text/javascript" src="<?php echo _BASE_URL; ?>/public/assets/clients/js/admin/orders/donhang.js"></script>
</body>

</html>