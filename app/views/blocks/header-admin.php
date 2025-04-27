<header class="header">
    <div class="logo">
        <div class="logo-text">
            <a href="<?php echo _WEB_ROOT; ?>/admin_layout"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/logo.png"></a>
        </div>
    </div>

    <div class="search-bar">
        <form action="<?php echo _WEB_ROOT; ?>/search" method="GET" style="display: flex; align-items: center; width: 100%;">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." /><button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
        </form>

    </div>
    <!-- <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm sản phẩm...">
        <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
    </div> -->

    <div class="hotline">
        <i class="fab fa-whatsapp"></i>
        <span><b>Hotline:</b> 19006750</span>
    </div>

    <div class="icons">
        <div class="icon"><a href="<?php echo _BASE_URL; ?>/beginChat"><i class="far fa-envelope"></i><span class="badge" id="message-count">1</span></a></div>

        <div class="icon user-menu">
            <?php if (isset($_SESSION['user'])): ?>
                <i class="fas fa-user" id="userIcon"></i>
                <p>Xin chào, <?= $_SESSION['user']['fullname'] ?? "" ?> !</p>
                <div class="dropdown-user" id="dropdownUser">
                    <a href="<?php echo _WEB_ROOT . '/dang-xuat'; ?>">Đăng xuất</a>
                </div>
            <?php else: ?>
                <i class="fas fa-user-cog" id="userIcon"></i>
                <div class="dropdown-user" id="dropdownUser">
                    <a href="<?php echo _WEB_ROOT . '/dang-nhap'; ?>">Đăng nhập</a>
                    <a href="<?php echo _WEB_ROOT . '/dang-ky'; ?>">Đăng ký</a>
                </div>
            <?php endif; ?>
        </div>

    </div>

</header>
<div class="breadcrumb-banner">
    <div class="container">
        <p><a href="<?php echo _WEB_ROOT; ?>/admin_layout">Trang chủ</a> <?php if(isset($breadcrumb)) echo  '<span>'." / " . $breadcrumb .'</span>'; ?>
        </p>
    </div>
</div>

<div>
    <button id="backToTop" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
</div>