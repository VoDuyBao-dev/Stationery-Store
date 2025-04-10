  <header class="header">
      <div class="logo">
          <div class="logo-img">
              <a href="<?php echo _WEB_ROOT; ?>/ "><img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/logo.png"></i></a>
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
              <div class="icon"><a href="<?php echo _WEB_ROOT . '/view_cart'; ?>"> <i class="fas fa-shopping-basket"></i><span class="badge">1</span></a></div>
              <div class="icon user-menu">
                  <i class="fas fa-user" id="userIcon"></i>
                  <div class="dropdown-user" id="dropdownUser">
                      <a href="<?php echo _WEB_ROOT . '/dang-nhap'; ?>">Đăng nhập</a>
                      <a href="<?php echo _WEB_ROOT . '/dang-ky'; ?>">Đăng ký</a>
                  </div>

              </div>

  </header>
  <div class="breadcrumb-banner">
      <div class="container">
          <p><a href="<?php echo _WEB_ROOT; ?>/ ">Trang chủ</a> / <span>Loading...</span> /
          <h2>Loading...</h2>
          </p>
      </div>
  </div>
  <div>
      <button id="backToTop" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
      <button id="chat"><a href="#"><i class="fas fa-envelope"></i></a></button>
  </div>