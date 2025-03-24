<?php
// session_start();
// include 'db.php'; // Kết nối database

// // Xử lý thêm sản phẩm vào giỏ hàng
// if (isset($_POST['product_id'])) {
//     $product_id = $_POST['product_id'];
//     $quantity = $_POST['quantity'] ?? 1;

//     if (!isset($_SESSION['cart'][$product_id])) {
//         $_SESSION['cart'][$product_id] = $quantity;
//     } else {
//         $_SESSION['cart'][$product_id] += $quantity;
//     }
// }

// // Xử lý cập nhật số lượng
// if (isset($_POST['update_id'])) {
//     $update_id = $_POST['update_id'];
//     $new_quantity = $_POST['new_quantity'];
//     $_SESSION['cart'][$update_id] = $new_quantity;
// }

// // Xử lý xóa sản phẩm khỏi giỏ hàng
// if (isset($_POST['remove_id'])) {
//     $remove_id = $_POST['remove_id'];
//     unset($_SESSION['cart'][$remove_id]);
// }

// // Lấy danh sách sản phẩm từ database
// $cart_items = [];
// $total_price = 0;
// if (!empty($_SESSION['cart'])) {
//     $ids = implode(',', array_keys($_SESSION['cart']));
//     $query = "SELECT * FROM products WHERE id IN ($ids)";
//     $result = mysqli_query($conn, $query);
//     while ($row = mysqli_fetch_assoc($result)) {
//         $row['quantity'] = $_SESSION['cart'][$row['id']];
//         $row['subtotal'] = $row['price'] * $row['quantity'];
//         $total_price += $row['subtotal'];
//         $cart_items[] = $row;
//     }
// }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Stationery</title>
    <link type="text/css" rel="stylesheet" 
            href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <script type="text/javascript" hrf="
        <?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
</head>
<body>
    
<header class="header">
    <div class="logo">
        <div class="logo-text">
            <a href="./index.php"><span class="s-letter">S</span>
            <span class="stationery">tationery</span>
            <p class="tagline">Lựa chọn số 1 cho bạn</p> </a>
        </div>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm sản phẩm...">
        <button><i class="fas fa-search"></i></button>
    </div>

    <div class="hotline">
        <i class="fab fa-whatsapp"></i>
        <span><b>Hotline:</b> 19006750</span>
    </div>

    <div class="icons">
        <div class="icon"><i class="fas fa-heart"></i><span class="badge">2</span></div>
        <div class="icon" onclick="toggleCart()"><i class="fas fa-shopping-basket"></i><span class="badge">1</span></div>
            <div class="cart-floating" id="cartPanel">
                <div class="cart-header">
                    <span>Giỏ Hàng</span>
                    <button onclick="toggleCart()">✖</button>
                </div>
                <div class="cart-content">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <div>
                                <p><?php echo $item['name']; ?></p>
                                <p><?php echo number_format($item['price']); ?>đ</p>
                            </div>
                            <button onclick="removeItem(<?php echo $item['id']; ?>)">Xóa</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="cart-footer">
                    <h3>Tổng tiền: <?php echo number_format($total_price); ?>đ</h3>
                    <button class="cart-button" onclick="checkout()">Thanh toán</button>
                </div>
            </div>
        <div class="icon user-menu">
            <i class="fas fa-user" id="userIcon"></i>
            <div class="dropdown-user" id="dropdownUser">
                <a href="./signin.php">Đăng nhập</a>
                <a href="./register.php">Đăng ký</a>
            </div>
        </div>

    </div>
    
</header>
<div class="breadcrumb-banner">
    <div class="container">
        <p><a href="./index.php">Trang chủ</a> / <span>Loading...</span> / <h2>Loading...</h2></p>
    </div>
</div>


</body>
</html>
