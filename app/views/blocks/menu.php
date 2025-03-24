<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</head>
<body>
    <header></header>
    <div class="menu">
        <ul class="menu-list">
            <li><a href="#"><i class="fas fa-compass-drafting"></i> Bút <span>&gt;</span></a>
                <ul class="submenu">
                        <li><a href="#">Bút chì</a></li>
                        <li><a href="#">Bút bi</a></li>
                        <li><a href="#">Bút mực</a></li>
                        <li><a href="#">Bút tẩy</a></li>
                        <li><a href="#">Bút dạ quang</a></li>
                        <li><a href="#">Bút lông</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Sản phẩm về giấy <span>&gt;</span></a>
                <ul class="submenu">
                        <li><a href="#">Sổ các loại</a></li>
                        <li><a href="#">Giấy note</a></li>
                        <li><a href="#">Vở</a></li>
                        <li><a href="#">Nhãn vở - Nhãn tên</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-palette"></i> Dụng cụ vẽ <span>&gt;</span></a>
                <ul class="submenu">
                        <li><a href="#">Bút vẽ</a></li>
                        <li><a href="#">Màu vẽ</a></li>
                        <li><a href="#">Khay - Cọ vẽ</a></li>
                        <li><a href="#">Giá - Khung vẽ</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-copy"></i> Sản phẩm khác <span>&gt;</span></a>
                <ul class="submenu">
                        <li><a href="#">Thước</a></li>
                        <li><a href="#">Bìa kẹp</a></li>
                        <li><a href="#">Máy tính cầm tay</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="featured">
        <h3>Danh mục nổi bật</h3>
        <ul>
            <li><a href="#"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/banchay.jpg" alt=""> Sản phẩm bán chạy nhất</a></li>
            <li><a href="#"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/noibat.jpg" alt=""> Sản phẩm nổi bật</a></li>
            <li><a href="#"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/feedback.jpg" alt=""> Phản hồi</a></li>
            <li><a href="#"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/lienhe.jpg" alt=""> Liên hệ</a></li>
        </ul>
    </div>
    
</body>
</html>
