<?php $breadcrumb = "Liên hệ"; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Liên Hệ Chúng Tôi</title>

    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/reply/reply.css"/>">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
           float: left;
           margin-top: 120px;
        }
    </style>
</head>
<body>
<header><?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?></header>
<menu><?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php";?></menu>


    <div class="contact-container">
        <!-- Phần Bản Đồ -->
        <div class="contact-map">
            <iframe 
    src="https://www.google.com/maps?q=10.866029984955874,106.61884746083764&hl=vi&z=17&output=embed" 
    width="600" 
    height="450" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy">
</iframe>

        </div>
    
        <!-- Phần Form Liên Hệ -->
        <div class="contact-form">
            <h2>LIÊN HỆ CHÚNG TÔI</h2>
            <p>Để liên hệ nhận các thông tin khuyến mãi sớm nhất, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.</p>
    
            <label>Họ và tên*</label>
            <input type="text" placeholder="Nhập họ và tên" required>
    
            <label>Email*</label>
            <input type="email" placeholder="Nhập địa chỉ Email" required>
    
            <label>Điện thoại*</label>
            <input type="tel" placeholder="Nhập số điện thoại" required>
    
            <label>Nội dung*</label>
            <textarea placeholder="Nội dung liên hệ" rows="4" required></textarea>
    
            <button>GỬI LIÊN HỆ NGAY</button>
        </div>
    </div>
    
    <div class="contact-footer">
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </div>
    
</body>
</html>
