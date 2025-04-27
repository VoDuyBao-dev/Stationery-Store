<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet"
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/search_admin.css">

    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
            float: left;
            margin-top: 125px;
        }

        main {
            margin-top: 90px;
            margin-left: 280px;
        }
    </style>
</head>

<body>
    <?php include_once _DIR_ROOT . '/app/views/blocks/header-admin.php'; ?>
    <?php include_once _DIR_ROOT . '/app/views/blocks/menu-admin.php'; ?>
    <h1>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($keyword); ?>"</h1>
    <main>
        <h2>Sản phẩm</h2>
        <ul>
            <?php foreach ($results['products'] as $product): ?>
                <li><?php echo htmlspecialchars($product['name']); ?> - mã <?php echo $product['product_id']; ?> VNĐ</li>
            <?php endforeach; ?>
        </ul>

        <h2>Người dùng</h2>
        <ul>
            <?php foreach ($results['users'] as $user): ?>
                <li>Tên<?php echo htmlspecialchars($user['fullname']); ?> - email<?php echo htmlspecialchars($user['email']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Đơn hàng</h2>
        <ul>
            <?php foreach ($results['orders'] as $order): ?>
                <li>Mã đơn: <?php echo htmlspecialchars($order['total_price']); ?>
                    - Trạng thái: <?php
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
                                    ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Mã giảm giá</h2>
        <ul>
            <?php foreach ($results['coupons'] as $coupon): ?>
                <li>Mã:<?php echo htmlspecialchars($coupon['code']); ?> - Giảm: <?php echo $coupon['discount']; ?>%</li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>

</html>