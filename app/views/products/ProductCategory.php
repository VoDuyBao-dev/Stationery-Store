<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/products/ProductCategory.css">
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
        }
        main{
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>
</head>

<body>
<header><?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?></header>
<menu><?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?></menu>
<main>
    <div class="container">
        <div class="filter-container">
            <span>Sắp xếp:</span>
            <button class="filter-button active" data-filter="name-asc">Tên A → Z</button>
            <button class="filter-button" data-filter="name-desc">Tên Z → A</button>
            <button class="filter-button" data-filter="price-asc">Giá tăng dần</button>
            <button class="filter-button" data-filter="price-desc">Giá giảm dần</button>
            <button class="filter-button" data-filter="newest">Hàng mới</button>
        </div>

        <div class="product-list">
            <div class="product">
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút xóa giấy">
                <p class="name">Bút xóa giấy</p>
                <p class="price"><span class="new">18.000đ</span> <span class="old">53.000đ</span></p>
                <button class="btn">Tùy chọn</button>
            </div>
            <div class="product">
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút mực nhiều màu">
                <p class="name">9 cây bút mực nhiều màu sắc xinh xắn</p>
                <p class="price"><span class="new">44.000đ</span> <span class="old">63.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút highlight">
                <p class="name">Bút highlight pastel dạ quang ghi nhớ</p>
                <p class="price"><span class="new">15.000đ</span> <span class="old">35.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút đánh dấu">
                <p class="name">Màu Sắc Bút Đánh Dấu Hai Đầu</p>
                <p class="price"><span class="new">24.000đ</span> <span class="old">43.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/but.webp" alt="Bút đánh dấu">
                <p class="name">Màu Sắc Bút Đánh Dấu Hai Đầu</p>
                <p class="price"><span class="new">24.000 <span class="old">43.0 0đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
        </div>
        </div>
        <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>

    
    </main>
</body>
</html>