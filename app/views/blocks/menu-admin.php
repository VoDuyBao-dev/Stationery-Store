<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-admin</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/menu.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</head>

<body>
    <header></header>
    <div class="menu">
        <ul class="menu-list">
            <li><a href="#"><i class="fas fa-store"></i> Trang chủ <span> </span></a></li>

            <li><a href="#"><i class="fas fa-user-tag"></i> Quản lý người dùng <span> </span></a></li>

            <li><a href="#"><i class="fas fa-boxes"></i> Quản lý sản phẩm <span> </span></a></li>

            <li><a href="#"><i class="fas fa-shipping-fast"></i> Quản lý đơn hàng <span>&gt;</span></a>
                <ul class="submenu">
                    <li><a href="#">Đơn hàng đang giao</a></li>
                    <li><a href="#">Đơn hàng đã nhận</a></li>
                    <li><a href="#">Đơn bị hoàn trả về</a></li>
                </ul>
            </li>

            <li><a href="#"><i class="far fa-gem"></i> Chương trình khuyến mãi <span> </span></a></li>

            <li><a href="<?php echo _BASE_URL; ?>/beginChat"><i class="far fa-comment-dots"></i> Chat <span> </span></a></li>
        </ul>
    </div>
</body>

</html>