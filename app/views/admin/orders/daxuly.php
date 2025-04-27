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
    <style>
        menu {
            float: left;
            margin-top: 0px;
        }

        main {
            margin-top: 150px;
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
            <h1>Quản lý đơn hàng</h1>
            <div class="tabs">
                <button class="tab" onclick="redirectTo('<?php echo _WEB_ROOT . '/canxuly'; ?>')">Cần xử lý (0)</button>
                <button class="tab active" onclick="redirectTo('<?php echo _WEB_ROOT . '/daxuly'; ?>')">Đã xử lý (0)</button>
            </div>

            <form id="date_filter_form" class="actions" method="GET" action="<?php echo _BASE_URL; ?>/daxuly">
                <input type="date" name="date" class="data-picker" value="<?php echo $_GET['date'] ?? ''; ?>" onchange="this.form.submit()" required />
                <!-- Giữ lại các tham số cũ của 'limit' và 'page' -->
                <input type="hidden" name="limit" value="<?php echo $_GET['limit'] ?? 10; ?>" />
                <input type="hidden" name="page" value="<?php echo $_GET['page'] ?? 1; ?>" />
            </form>

            <table>
                <thead>
                    <tr>
                        <th>STT</th>
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
                        <?php $stt = 1; ?>
                        <?php foreach ($ordersDone as $order): ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td>mdh<?php echo $order['order_id']; ?>kl</td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['fullname']; ?></td>
                                <td><?php echo $order['updated_at']; ?></td>
                                <td><button class="detail-btn" xem-id="<?= $order['order_id'] ?>">Xem chi tiết</button></td>
                                <!-- vì đơn hàng đã hoàn thành nên không nên xóa để có dữ liệu làm báo cáo doanh thu -->
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>


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

            </div>

            <!-- Modal xác nhận xóa
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
            </div> -->

            <form id="pagination_form" method="GET" action="<?php echo _WEB_ROOT . '/daxuly'; ?>">
                <div class="footer">
                    <div class="left">
                        <span>Bản ghi mỗi trang:</span>
                        <select name="limit" onchange="this.form.submit()">
                            <option value="5" <?php if (isset($_GET['limit']) && $_GET['limit'] == 5) echo 'selected'; ?>>5</option>
                            <option value="10" <?php if (isset($_GET['limit']) && $_GET['limit'] == 10) echo 'selected'; ?>>10</option>
                            <option value="20" <?php if (isset($_GET['limit']) && $_GET['limit'] == 20) echo 'selected'; ?>>20</option>
                            <option value="50" <?php if (isset($_GET['limit']) && $_GET['limit'] == 50) echo 'selected'; ?>>50</option>
                        </select>
                    </div>
                    <input type="hidden" name="date" value="<?php echo $_GET['date'] ?? ''; ?>" required />

                    <div class="right">
                        <button type="submit" name="page" value="<?php echo max($currentPage - 1, 1); ?>">&lt;</button>
                        <span><?php echo $currentPage . "/" . $totalPages; ?></span>
                        <button type="submit" name="page" value="<?php echo min($currentPage + 1, $totalPages) ?>">&gt;</button>
                    </div>
                </div>
            </form>
        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>
    <script>
        const baseURL = "<?php echo _BASE_URL; ?>";
    </script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/orders/daxuli.js"></script>

</body>

</html>