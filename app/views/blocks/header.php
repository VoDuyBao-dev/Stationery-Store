<?php
            $totalQuantity = 0;
            if(isset($_SESSION['giohang'])) {
                foreach($_SESSION['giohang'] as $item) {
                    $totalQuantity += $item['quantity'];
                }
            }
        
?>
  
  <header class="header">
    <div class="logo">
        <div class="logo-img">
            <a href="<?php echo _WEB_ROOT; ?>/trang-chu"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/logo.png" ></i></a>
            
        </div>
    </div>

    <div class="search-bar">
        <form action="<?php echo _WEB_ROOT; ?>/kqtim-kiem" method="GET" style="display: flex; align-items: center; width: 100%;">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..."/><i class="fas fa-search"></i>
        </form>
        
    </div>

    <div class="hotline">
        <i class="fab fa-whatsapp"></i>
        <span><b>Hotline:</b> 19006750</span>
    </div>
    <div class="icons">
        <div class="icon"><a href="<?php echo _WEB_ROOT . '/view_cart'; ?>"> <i class="fas fa-shopping-basket"></i><span id="cart-count" class="badge"><?= $totalQuantity?></span></a></div>
        <div class="icon user-menu">
            
            <?php if(isset($_SESSION['user'])): ?>
                <i class="fas fa-user" id="userIcon"></i>
                <p>Xin chào, <?= $_SESSION['user']['fullname'] ?? ""?> !</p>
                <div class="dropdown-user" id="dropdownUser">
                <a href="<?php echo _WEB_ROOT . '/chinh-sua-thong-tin'; ?>">Thông tin cá nhân</a>
                <a href="<?php echo _WEB_ROOT . '/dang-xuat'; ?>">Đăng xuất</a>
                
            </div>
            <?php else:?>
                <i class="fas fa-user-cog" id="userIcon"></i>
            <div class="dropdown-user" id="dropdownUser">
                <a href="<?php echo _WEB_ROOT . '/dang-nhap'; ?>">Đăng nhập</a>
                <a href="<?php echo _WEB_ROOT . '/dang-ky'; ?>">Đăng ký</a>
            </div>
            <?php endif;?>
        </div>
        

    </div>
    
</header>
    <div class="breadcrumb-banner">
        <div class="container">
            <p><a href="<?php echo _WEB_ROOT; ?>/trang-chu ">Trang chủ</a> / <span>Loading...</span> / <h2>Loading...</h2></p>
        </div>
    </div>
<div>
<button id="backToTop" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
<button id="chat"><a href="#"><i class="fas fa-envelope"></i></a></button>
</div>

