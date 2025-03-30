<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header-admin Stationery</title>
    <link type="text/css" rel="stylesheet" 
            href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
        
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
        <div class="icon"><a href="#"><i class="far fa-envelope"></i><span class="badge">1</span></a></div>
        <div class="icon user-menu">
            <i class="fas fa-user" id="userIcon"></i>
            <div class="dropdown-user" id="dropdownUser">
                <a href="<?php echo _WEB_ROOT . '/dang-nhap'; ?>">Đăng nhập</a>
                <a href="<?php echo _WEB_ROOT . '/dang-ky'; ?>">Đăng ký</a>
            </div>
        </div>

    </div>
    
</header>
<div class="breadcrumb-banner">
    <div class="container">
        <p><a href="../layouts/admin_layout.php">Trang chủ</a> / <span>Loading...</span> / <h2>Loading...</h2></p>
    </div>
</div>


</body>
</html>
