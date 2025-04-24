<?php $breadcrumb = "Đơn hàng cần xử lý"; ?>

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
            margin-top: 0;
        }

        main {
            margin-top: 130px;
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
            <h1>Quản lý đơn hàng - Cần xử lý</h1>

            <div class="tabs">
                <button class="tab active" id="tab-can-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/canxuly'; ?>')">Cần xử lý (<span id="count-can-xu-ly">0</span>)</button>
                <button class="tab" id="tab-da-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/daxuly'; ?>')">Đã xử lý (<span id="count-da-xu-ly">0</span>)</button>
            </div>
            <div class="actions"><input type="date" class="date-picker" /></div>
            <!-- <div id="order-actions"><button id="add-order-btn">Thêm đơn hàng mới</button></div> -->
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
                                    <td><button class="edit-btn" sua-id="<?php echo $order['order_id']; ?>">Sửa</button></td>
                                <?php elseif ($order['trangThaiGiao'] == 1) : ?>
                                    <td><button class="huy-btn" huy-id="<?php echo $order['order_id']; ?>">Hủy đơn</button></td>
                                <?php else: ?>
                                    <td><button class="delete-btn" xoa-id="<?php echo $order['order_id']; ?>">Xóa</button></td>
                                <?php endif; ?>
                                <td><button class="viewOrderDetail-btn" xem-id="<?php echo $order['order_id']; ?>">Xem chi tiết</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Thêm đơn hàng mới -->
            <!-- <div id="myModal" class="modal">
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
            </div> -->

            <!-- Sủa thông tin đơn hàng -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h3>Sửa đơn hàng</h3>
                    <form id="edit-order-form" action="<?php echo _BASE_URL ?>/suaDon" method="POST">
                        <div class="form-group">
                            <label for="edit_ma">Mã đơn hàng:</label>
                            <input type="text" id="edit_ma" name="edit_ma" readonly />

                            <label for="edit_ngay">Ngày đặt hàng:</label>
                            <input type="date" id="edit_ngay" name="edit_ngay" readonly />

                            <label for="edit_nguoi">Người nhận:</label>
                            <input type="text" id="edit_nguoi" name="edit_nguoi" readonly />

                            <label for="edit_tong">Tổng hóa đơn:</label>
                            <input type="text" id="edit_tong" name="edit_tong" readonly />

                            <label for="edit_thanhtoan">Phương thức thanh toán:</label>
                            <input type="text" id="edit_thanhtoan" name="edit_thanhtoan" readonly />

                            <input type="hidden" id="transportOldPrice" name="transportOldPrice" />

                            <label for="edit_vanchuyen">Phương thức vận chuyển:</label>
                            <select name="edit_vanchuyen" id="edit_vanchuyen" required></select><br>
                            <button type="button" id="edit-cancel-btn">Hủy</button>
                            <button type="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- hủy đơn hàng -->
            <div id="confirmCancelModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick='document.getElementById("confirmCancelModal").style.display = "none";'>&times;</span>
                    <h3>Xác nhận xóa</h3>
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này không?</p>
                    <form class="form-actions" action="<?php echo _BASE_URL; ?>/huyDon" method="post">
                        <input type="hidden" name="order_id" value="">
                        <button type="button" id="cancelBtnOrder" onclick='document.getElementById("confirmCancelModal").style.display = "none";'>Thoát</button>
                        <button type="submit" id="cancelBtn">Hủy đơn</button>
                    </form>
                </div>
            </div>

            <!-- Xóa đơn hàng -->
            <div id="confirmDeleteModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick='document.getElementById("confirmDeleteModal").style.display = "none";'>&times;</span>
                    <h3>Xác nhận xóa</h3>
                    <p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
                    <form class="form-actions" action="<?php echo _BASE_URL . '/xoaDon' ?>" method="post">
                        <input type="hidden" name="order_id" value="">
                        <button type="button" id="deleteBtnOrder" onclick='document.getElementById("confirmDeleteModal").style.display = "none";'>Hủy</button>
                        <button type="submit" id="deleteBtn">Xóa</button>
                    </form>
                </div>
            </div>


            <!-- Modal hiển thị chi tiết đơn hàng -->
            <div id="viewDetailModal" class="modal">
                <span class="close" onclick='document.getElementById("viewDetailModal").style.display = "none";'>&times;</span>
                <table id="orderDetailtable">
                    <thead>
                        <tr id="thead_row">
                            <th>STT</th>
                            <th>Tên đơn hàng</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Giá</th>
                            <th>Giá vận chuyển</th>
                            <!-- <th>Giá cuối cùng</th> -->
                        </tr>
                    </thead>
                    <tbody id="order-details-table-body"></tbody>
                </table>

                <!-- Nút Sửa sẽ được hiển thị nếu trạng thái giao là 0 -->

            </div>


            <!-- Sửa chi tiết đơn hàng -->
            <div id="editDetailModal" class="modal">
                <span class="close" onclick='document.getElementById("editDetailModal").style.display = "none";'>&times;</span>
                <form id="editOrderDetailForm" method="POST" action="<?php echo _WEB_ROOT ?>/updateOrderDetail">
                    <input type="hidden" name="order_detail_id" id="edit_order_detail_id">
                    <input type="hidden" name="order_id" id="edit_order_id">

                    <label>Tên đơn hàng:</label>
                    <input type="text" name="tenDonHang" id="edit_tenDonHang" required><br>

                    <label for="product_type_id">Sản phẩm - Giá:</label>
                    <select name="product_type_id" id="product_type_id" required></select><br>

                    <label>Số điện thoại:</label>
                    <input type="text" name="phone" id="edit_phone" required><br>

                    <label>Địa chỉ:</label>
                    <input type="text" name="address" id="edit_address" required><br>

                    <label>Ghi chú:</label>
                    <textarea name="ghiChu" id="edit_ghiChu"></textarea><br>

                    <!-- <label>Giá sản phẩm:</label> -->
                    <!-- <input type="hidden" name="priceCurrent" id="edit_priceCurrent"><br> -->

                    <label>Số lượng:</label>
                    <input type="number" name="quantity" id="edit_quantity" min="1" required><br>

                    <!-- <label for="edit_transport_id">Phương thức vận chuyển:</label>
                    <select name="transport_id" id="edit_transport_id" required></select><br> -->

                    <button type="submit">Cập nhật</button>
                </form>
            </div>

            <!-- Xóa đơn hàng -->
            <div id="deleteDetailModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick='document.getElementById("deleteDetailModal").style.display = "none";'>&times;</span>
                    <h3>Xác nhận xóa</h3>
                    <p>Bạn có chắc chắn muốn xóa sản phẩm này trong đơn hàng không?</p>
                    <form class="form-actions" method="POST" action="<?php echo _BASE_URL ?>/deleteDetail">
                        <input type="hidden" name="order_detail_id" value="">
                        <button type="button" id="cancelDeleteBtn" onclick='document.getElementById("deleteDetailModal").style.display = "none";'>Hủy</button>
                        <button type="submit" id="confirmDeleteBtn">Xóa</button>
                    </form>
                </div>
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