<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Quản lý Đơn hàng - Cần xử lý</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/orders/donhang.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <script type="text/javascript"
    src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/orders/donhang.js"></script>
    <style>
        menu {
            float: left;
        }
        main{
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>
</head>
<body>
<header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header-admin.php";?>
  </header>  

  <menu>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php";?>
  </menu> 
  <main>
    <div class="order-container">
        <h2>Quản lý đơn hàng - Cần xử lý</h2>

        <div class="tabs">
            <button class="tab active" id="tab-can-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/canxuly'; ?>')">Cần xử lý (<span id="count-can-xu-ly">0</span>)</button>
            <button class="tab" id="tab-da-xu-ly" onclick="redirectTo('<?php echo _WEB_ROOT . '/daxuly'; ?>')">Đã xử lý (<span id="count-da-xu-ly">0</span>)</button>
        </div>

        <div class="actions">
            <input type="date" class="date-picker" />
        </div>

        <div id="order-actions">
            <button id="add-order-btn">Thêm đơn hàng mới</button>
        </div>

        <table id="order-table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Người nhận</th>
                    <th>Tổng hóa đơn</th>
                    <th>Phương thức thanh toán</th>
                    <th>Phương thức vận chuyển</th>
                    <th>Thao tác</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="8" class="no-data">Không có bản ghi nào</td>
                </tr>
            </tbody>
        </table>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Thêm đơn hàng mới</h2>
                <form id="order-form">
                    <div class="form-group">
                        <label for="ma">Mã đơn hàng:</label>
                        <input type="text" id="ma" name="ma"/>
                    </div>
                    <div class="form-group">
                        <label for="ngay">Ngày đặt hàng:</label>
                        <input type="date" id="ngay" name="ngay"/>
                    </div>
                    <div class="form-group">
                        <label for="nguoi">Người nhận:</label>
                        <input type="text" id="nguoi" name="nguoi"/>
                    </div>
                    <div class="form-group">
                        <label for="tong">Tổng hóa đơn:</label>
                        <input type="text" id="tong" name="tong"/>
                    </div>
                    <div class="form-group">
                        <label for="thanhtoan">Phương thức thanh toán:</label>
                        <input type="text" id="thanhtoan" name="thanhtoan"/>
                    </div>
                    <div class="form-group">
                        <label for="vanchuyen">Phương thức vận chuyển:</label>
                        <input type="text" id="vanchuyen" name="vanchuyen"/>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancel-btn">Hủy</button>
                        <button type="submit">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Sửa đơn hàng</h2>
                <form id="edit-order-form">
                    <div class="form-group">
                        <label for="edit-ma">Mã đơn hàng:</label>
                        <input type="text" id="edit-ma" name="edit-ma" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="edit-ngay">Ngày đặt hàng:</label>
                        <input type="date" id="edit-ngay" name="edit-ngay"/>
                    </div>
                    <div class="form-group">
                        <label for="edit-nguoi">Người nhận:</label>
                        <input type="text" id="edit-nguoi" name="edit-nguoi"/>
                    </div>
                    <div class="form-group">
                        <label for="edit-tong">Tổng hóa đơn:</label>
                        <input type="text" id="edit-tong" name="edit-tong"/>
                    </div>
                    <div class="form-group">
                        <label for="edit-thanhtoan">Phương thức thanh toán:</label>
                        <input type="text" id="edit-thanhtoan" name="edit-thanhtoan"/>
                    </div>
                    <div class="form-group">
                        <label for="edit-vanchuyen">Phương thức vận chuyển:</label>
                        <input type="text" id="edit-vanchuyen" name="edit-vanchuyen"/>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="edit-cancel-btn">Hủy</button>
                        <button type="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="viewModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Chi tiết đơn hàng</h2>
                <div id="order-details"></div>
            </div>
        </div>
        <div id="confirmDeleteModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Xác nhận xóa</h2>
                <p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
                <div class="form-actions">
                    <button type="button" id="cancelDeleteBtn">Hủy</button>
                    <button type="button" id="confirmDeleteBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </main>
</body>
</html>