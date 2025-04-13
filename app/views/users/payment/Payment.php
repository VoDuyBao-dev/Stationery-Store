<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/payment/Payment.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <form action="<?php echo _WEB_ROOT . '/dang-ky'; ?>" method="POST" id="checkout-form">
                <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($_SESSION['user']['fullname'] ?? '') ?>" placeholder="Họ và tên" required>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>" placeholder="Số điện thoại (tuỳ chọn)" required>

                <!-- Dropdown tỉnh/quận/phường -->
                <select id="province" name="province">
                    <option value="">Chọn Tỉnh/Thành phố</option>
                </select>
                <select id="district" name="district">
                    <option value="">Chọn Quận/Huyện</option>
                </select>
                <select id="ward" name="ward">
                    <option value="">Chọn Phường/Xã</option>
                </select>
                <input type="text" name="address_detail" placeholder="Địa chỉ (Cụ thể)">
                <textarea name="note" placeholder="Ghi chú (tuỳ chọn)"></textarea>
              
                
            </form>
            <label for="shipping">Phương thức vận chuyển:</label>
    <select id="shipping">
        <?php foreach($listTransport as $trans):?>
        <option value="<?= $trans['transport_id']?>"><?= $trans['name']?></option>
        <?php endforeach;?>
    </select>

<label>Phương thức thanh toán:</label>
<div class="payment-options">
    <input type="radio" id="cod" name="payment" value="cod">
    <label for="cod">Thanh toán khi nhận hàng (COD)</label>

    <input type="radio" id="bank" name="payment" value="bank">
    <label for="bank">Thanh toán qua VNPay</label>

    <input type="radio" id="ewallet" name="payment" value="ewallet">
    <label for="ewallet">Thanh toán qua MoMo</label>
    <div id="momo-options" style="display: none; margin-left: 20px; margin-top: 10px;">
    <!-- option của momo -->
    <input type="radio" id="momo_qr" name="momo_method" value="momo_qr">
    <label for="momo_qr">Quét mã QR</label><br>

    <input type="radio" id="momo_bank" name="momo_method" value="momo_bank">
    <label for="momo_bank">Thẻ ngân hàng</label>
</div>

</div>
            
        </div>
        
        <!-- Phần tóm tắt đơn hàng -->
        <div class="checkout-right">
    <h2>Đơn hàng (<?= count($_SESSION['giohang'])?> sản phẩm)</h2>
    <?php $tongtien = 0;?>
    <?php foreach($_SESSION['giohang'] as $item):
            $tt = $item['quantity']* $item['priceCurrent'];
            $tongtien += $tt;?>
    <div class="cart-item">
        <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $item['image'];?>" alt="<?= $item['name_product_type_id']?>">
        <p><?= $item['product_name']?></p>
        <p><strong><?= $item['name_product_type_id']?></strong></p>
        <p>Số lượng: <?= $item['quantity'] ?></p>
        <span><?= $tt;?>đ</span>
    </div>
    <?php endforeach;?>
   
    <div class="discount-container">
        <input type="text" class="discount-input" placeholder="Nhập mã giảm giá">
        <button class="apply-btn">Áp dụng</button>
    </div>
    <div class="total">
        <p>Tạm tính: <span><?= $tongtien;?>đ</span></p>
        <p>Phí vận chuyển: <span>-</span></p>
        <!-- Nhớ sửa số tiền ít nhất phải là hàng nghìn -->
        <p><strong id="total-amount">Tổng cộng: <?= $tongtien;?>000đ</strong></p>
    </div>
    <button class="checkout-btn" type="button" id="checkout-btn">ĐẶT HÀNG</button>

    </div>
    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    <script>
        const _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
        const countCart = <?php echo count($_SESSION['giohang'] ?? []); ?>;
       
    </script>
   <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/payment/payment.js"></script>
   
</body>
</html>
