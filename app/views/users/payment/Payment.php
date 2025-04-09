<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/payment/Payment.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>

</head>
    
<body>
    <header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
    </header>
    <div class="main-container">
        <!-- Phần nhập thông tin -->
        <div class="checkout-left">
            <div class="logo">Stationery</div>
            <h2>Thông tin nhận hàng</h2>
            <form>
                <input type="text" placeholder="Họ và tên">
                <input type="tel" placeholder="Số điện thoại (tuỳ chọn)">

                <!-- Dropdown tỉnh/quận/phường -->
                <select id="province">
                    <option value="">Chọn Tỉnh/Thành phố</option>
                </select>
                <select id="district">
                    <option value="">Chọn Quận/Huyện</option>
                </select>
                <select id="ward">
                    <option value="">Chọn Phường/Xã</option>
                </select>
                <input type="text" placeholder="Địa chỉ (Cụ thể)">
                <textarea placeholder="Ghi chú (tuỳ chọn)"></textarea>
            </form>
            <label for="shipping">Phương thức vận chuyển:</label>
<select id="shipping">
    <option value="">-- Chọn phương thức vận chuyển --</option>
    <option value="express">Giao hàng nhanh</option>
    <option value="standard">Giao hàng hỏa tốc</option>
    <option value="eco">Giao hàng tiết kiệm</option>
</select>

<label>Phương thức thanh toán:</label>
<div class="payment-options">
    <input type="radio" id="cod" name="payment" value="cod">
    <label for="cod">Thanh toán khi giao hàng (COD)</label>

    <input type="radio" id="bank" name="payment" value="bank">
    <label for="bank">Chuyển khoản ngân hàng</label>

    <input type="radio" id="ewallet" name="payment" value="ewallet">
    <label for="ewallet">Thanh toán qua MoMo</label>
</div>
        </div>
        
        <!-- Phần tóm tắt đơn hàng -->
        <div class="checkout-right">
    <h2>Đơn hàng (4 sản phẩm)</h2>
    <div class="cart-item">
        <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút đánh dấu">
        <p>Màu Sắc Bút Đánh Dấu Hai Đầu</p>
        <p>Số lượng: <input type="number" value="1" min="1"></p>
        <span>72.000đ</span>
    </div>
    <div class="cart-item">
        <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Sổ tay mini">
        <p>Sổ tay mini hoạt hình dễ thương</p>
        <p>Số lượng: <input type="number" value="1" min="1"></p>
        <span>38.000đ</span>
    </div>
    <div class="cart-item">
        <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Sổ tay mini">
        <p>Sổ tay mini hoạt hình dễ thương</p>
        <p>Số lượng: <input type="number" value="1" min="1"></p>
        <span>38.000đ</span>
    </div>

    <div class="discount-container">
        <input type="text" class="discount-input" placeholder="Nhập mã giảm giá">
        <button class="apply-btn">Áp dụng</button>
    </div>
    <div class="total">
        <p>Tạm tính: <span>110.000đ</span></p>
        <p>Phí vận chuyển: <span>-</span></p>
        <p><strong>Tổng cộng: 110.000đ</strong></p>
    </div>
    <button class="checkout-btn">ĐẶT HÀNG</button>
    </div>
    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
