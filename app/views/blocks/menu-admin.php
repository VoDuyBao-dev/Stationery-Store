<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-admin</title>

</head>

<body>
    <header></header>
    <div class="menu">
        <ul class="menu-list">
            <li><a href="<?php echo _WEB_ROOT . '/admin_layout'; ?>"><i class="fas fa-store"></i> Trang chủ <span> </span></a></li>

            <li><a href="<?php echo _WEB_ROOT . '/manage_users'; ?>"><i class="fas fa-user-tag"></i> Quản lý người dùng <span> </span></a></li>

            <li><a href="<?php echo _WEB_ROOT . '/qlsp'; ?>"><i class="fas fa-boxes"></i> Quản lý sản phẩm <span> </span></a></li>

            <li><a href="<?php echo _WEB_ROOT . '/canxuly'; ?>"><i class="fas fa-shipping-fast"></i> Quản lý đơn hàng <span>&gt;</span></a>
                <ul class="submenu">
                    <li><a href="<?php echo _WEB_ROOT . '/canxuly'; ?>">Cần xử lý</a></li>
                    <li><a href="<?php echo _WEB_ROOT . '/daxuly'; ?>">Đã xử lý</a></li>

                </ul>
            </li>

            <li><a href="<?php echo _WEB_ROOT . '/sale'; ?>"><i class="far fa-gem"></i> Khuyến mãi <span> </span></a></li>

            <li><a href="<?php echo _BASE_URL; ?>/beginChat"><i class="far fa-comment-dots"></i> Chat <span> </span></a></li>
        </ul>
    </div>
</body>

</html>