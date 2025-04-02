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

    <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/app.min.js"></script>
  <!-- JS Libraies -->
  <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script type="text/javascript"  src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/index.js"></script>
  <!-- Template JS File -->
  <script type="text/javascript"  src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/scripts.js"></script>
  <!-- Custom JS File -->
  <script type="text/javascript"  src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/custom.js"></script>
        
</head>
<body>
    
<header class="header">
    <div class="logo">
        <div class="logo-text">
            <a href="<?php echo _WEB_ROOT; ?>/admin_layout"><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/logo.png" ></a>
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
            <div class="dropdown-user">
                <a href="<?php echo _WEB_ROOT . '/signin'; ?>">Đăng nhập</a>
                <a href="<?php echo _WEB_ROOT . '/register'; ?>">Đăng ký</a>
            </div>
        </div>

    </div>
    
</header>
<div class="breadcrumb-banner">
    <div class="container">
        <p><a href="<?php echo _WEB_ROOT;?>/admin_layout">Trang chủ</a> / <span>Loading...</span> / <h2>Loading...</h2></p>
    </div>
</div>

<div>
<button id="backToTop" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
</div>

<div class="settingSidebar">
          <a href="<?php echo _WEB_ROOT;?> /javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Chủ đề</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Sáng</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Tối</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>

</body>
</html>
