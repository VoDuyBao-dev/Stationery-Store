<?php

use core\Helpers;

?>

<?php $breadcrumb = "Theo dõi đơn hàng"; ?>

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
    <?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>
    <?php require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?>


    <main>
        <div class="order-container">
            <h1>Danh sách đơn hàng</h1>


            <div class="actions">
                <div class="date-filter">
                    <label>Lọc theo ngày:</label>
                    <input type="date" id="from-date" class="date-picker" name="from_date">
                    <span>đến</span>
                    <input type="date" id="to-date" class="date-picker" name="to_date">
                    <button id="filter-btn" class="filter-btn">Lọc</button>
                    <button id="reset-filter" class="reset-btn">Đặt lại</button>
                </div>
            </div>
            <div class="search-main">
                <form action="<?php echo _WEB_ROOT; ?>/tim-kiem-don-hang" method="GET">
                    <input type="text" name="order_id" placeholder="Nhập mã đơn hàng" required>
                    <button class="search-button" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Thành tiền</th>
                        <th>TT thanh toán</th>
                        <th>TT vận chuyển</th>
                        <th>Trạng thái</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($order_list) == 0): ?>
                        <tr>
                            <td colspan="6" class="no-data">Không có đơn hàng nào</td>
                        </tr>
                    <?php else: $i = 1 ?>
                        <?php foreach ($order_list as $order): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo Helpers::format_currency($order['total_price']); ?></td>
                                <td><?php echo $order['payment_method']; ?></td>
                                <td><?php echo $order['transport_name']; ?></td>
                                <td><?php
                                    switch ($order['trangThaiGiao']) {
                                        case 0:
                                            echo "Đang xử lý";
                                            break;
                                        case 1:
                                            echo "Đang giao";
                                            break;
                                        case 2:
                                            echo "Đã hủy";
                                            break;
                                        default:
                                            echo "Giao thành công";
                                    }
                                    ?></td>
                                <td>
                                    <button class="detail-btn" xem-id="<?= $order['order_id'] ?>">Xem chi tiết</button>
                                    <?php if ($order['trangThaiGiao'] == 0): ?>
                                        <button class="cancel-btn" data-id="<?= $order['order_id'] ?>">Hủy đơn</button>
                                    <?php elseif ($order['trangThaiGiao'] == 3): ?>
                                        <button class="review-btn" data-order_id="<?= $order['order_id'] ?>">Đánh giá</button>
                                    <?php endif; ?>
                                </td>
                                <!-- vì đơn hàng đã hoàn thành nên không nên xóa để có dữ liệu làm báo cáo doanh thu -->
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>


            <!-- Modal hiển thị chi tiết đơn hàng -->
            <div id="viewDetailModal" class="modal">
                <!-- <span class="close" onclick='document.getElementById("viewDetailModal").style.display = "none";'>&times;</span> -->
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
                            <th>Thành tiền</th>
                            <th>Phí vận chuyển</th>

                        </tr>
                    </thead>
                    <tbody id="order-details-table-body"></tbody>
                </table>

            </div>


            <div id="reviewModal" class="modal-feedback">
                <div class="modal-feedback-content">
                    <span class="close" onclick="closeModal('reviewModal')">&times;</span>
                    <h1>Đánh giá sản phẩm</h1>
                    <form id="reviewForm" method="POST" action="<?php echo _BASE_URL ?>/addReview">
                        <input type="hidden" name="order_id" id="order_id">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>"> <!-- Hoặc lấy từ session -->

                        <label for="rating">Chọn số sao đánh giá:</label>
                        <select id="rating" name="rating" required>
                            <option value="">-- Chọn số sao --</option>
                            <option value="5">5 sao - Rất tuyệt vời</option>
                            <option value="4">4 sao - Tốt</option>
                            <option value="3">3 sao - Bình thường</option>
                            <option value="2">2 sao - Tạm ổn</option>
                            <option value="1">1 sao - Tệ</option>
                        </select>

                        <label for="comment">Nhận xét chi tiết:</label>
                        <textarea id="comment" name="comment" placeholder="Hãy chia sẻ cảm nhận của bạn..." required></textarea>

                        <button type="submit">Gửi đánh giá</button>
                    </form>
                </div>
            </div>



        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>
    <script>
        const baseURL = "<?php echo _BASE_URL; ?>";
        const _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Khi click nút Đánh giá
        document.querySelectorAll('.review-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-order_id');
                document.getElementById('order_id').value = productId;
                document.getElementById('reviewModal').style.display = 'block';
            });
        });

        // Khi click ra ngoài modal thì tắt modal
        window.onclick = function(event) {
            const reviewModal = document.getElementById('reviewModal');
            const detailModal = document.getElementById('viewDetailModal');
            if (event.target == reviewModal) {
                reviewModal.style.display = "none";
            }
            if (event.target == detailModal) {
                detailModal.style.display = "none";
            }
        }
    </script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/order_list.js"></script>

</body>

</html>