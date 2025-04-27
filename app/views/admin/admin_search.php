<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/search/ketquatimkiem.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <script>
      function viewProduct(product_name ,id_product, id_product_type) {
        window.location.href = "thong-tin-sp/" + encodeURIComponent(product_name) +'/'+ id_product +'/' + id_product_type;
      }
    </script>
</head>
<body>
<?php include_once _DIR_ROOT . '/app/views/blocks/header-admin.php'; ?> 
<?php include_once _DIR_ROOT . '/app/views/blocks/menu-admin.php'; ?>
    <h1>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($keyword); ?>"</h1>
    <main>
        <h2>Sản phẩm</h2>
        <ul>
        <?php foreach ($results['products'] as $product): ?>
            <li><?php echo htmlspecialchars($product['name']); ?> - <?php echo $product['price']; ?> VNĐ</li>
        <?php endforeach; ?>
        </ul>

        <h2>Người dùng</h2>
        <ul>
        <?php foreach ($results['users'] as $user): ?>
            <li><?php echo htmlspecialchars($user['username']); ?> - <?php echo htmlspecialchars($user['email']); ?></li>
        <?php endforeach; ?>
        </ul>

        <h2>Đơn hàng</h2>
        <ul>
        <?php foreach ($results['orders'] as $order): ?>
            <li>Mã đơn: <?php echo htmlspecialchars($order['order_code']); ?> - Trạng thái: <?php echo htmlspecialchars($order['status']); ?></li>
        <?php endforeach; ?>
        </ul>

        <h2>Mã giảm giá</h2>
        <ul>
        <?php foreach ($results['coupons'] as $coupon): ?>
            <li><?php echo htmlspecialchars($coupon['code']); ?> - Giảm: <?php echo $coupon['discount_value']; ?>%</li>
        <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
