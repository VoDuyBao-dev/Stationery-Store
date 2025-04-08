<!doctype html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stationery</title>
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/TrangChu.css">
  <link
    type="text/css"
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css" />
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
  <style>
    menu {
      float: left;
    }

    main {
      margin-top: 120px;
      margin-left: 280px;
    }
  </style>
</head>

<body>
  <header>
    <?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>
  </header>

  <menu>
    <?php require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?>
  </menu>
  <main>
    <!-- ========== Slider ========== -->
    <section class="section-1">
      <div class="home-slider">
        <div class="main clearfix">
          <div class="clearfix">
            <a href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/slider_1.webp" alt="Văn phòng phẩm" /></a>
          </div>
        </div>
        <button class="fa-solid fa-arrow-left"></button><button class="fa-solid fa-arrow-right"></button>
      </div>
    </section>
    <!-- ========== Danh mục sản phẩm ========== -->
    <section class="section-2">
      <div class="cate-list">
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/vvphocsinh.webp" alt="Văn phòng phẩm học sinh" /></a>
            <h3 class="title_cate"><a href="http://">Vpp học sinh</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/vpp_vanphong.jpg" alt="Văn phòng phẩm văn phòng" /></a>
            <h3 class="title_cate"><a href="http://">Vpp văn phòng</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Phu_kien.jpg" alt="Phụ kiện" /></a>
            <h3 class="title_cate"><a href="http://">Phu kiện</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Cặp-Túi xách" /></a>
            <h3 class="title_cate"><a href="http://">Cặp-Túi xách</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Dungcuvp.jpg" alt="Dụng cụ văn phòng" /></a>
            <h3 class="title_cate"><a href="http://">Dụng cụ văn phòng</a></h3>
          </div>
        </div>
      </div>
    </section>
    <!-- ========== Flash Sale ==========  -->
    <section class="section-3">
      <div class="container">
        <div class="block-title">
          <h2>
            <a href="" title="Flash sale"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/fs.png" alt="fash-sale" /></a>
          </h2>
        </div>
        <div class="block-product">
          <!-- Sản phẩm 1 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 2 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 3 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 4 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 5-->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 6 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
          <!-- Sản phẩm 7 -->
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Hộp bút" />
            <div class="product-name">Hộp đựng văn phòng phẩm</div>
            <div class="price">
              15.000₫ <span class="old-price">25.000₫</span>
            </div>
            <button class="buy-button">Xem ngay </button>
          </div>
        </div>
        <div class="fa-solid fa-arrow-left"></div>
        <div class="fa-solid fa-arrow-right"></div>
      </div>
    </section>
    <!-- ========== Sản phẩm nổi bật ========== -->
    <section class="section-4">
      <div class="container">
        <div class="block-title">
          <h2><a href="spnb">Sản phẩm nổi bật</a></h2>
        </div>
        <div class="block-product">
          <div class="product-featured-swiper">
            <!-- Sản phẩm 1 -->
            <div class="product-block">
              <div class="product-block-item">
                <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Vở viết" /></a>
              </div>
              <div class="product-info">
                <a href="#">Vở viết kẻ ngang nhiều hình ngộ nghĩnh</a>
                <div class="product-price">
                  <span class="price">12.000₫</span>
                  <span class="old-price">41.000₫</span>
                </div>
              </div>
            </div>
            <!-- Sản phẩm 2 -->
            <div class="product-block">
              <div class="product-block-item">
                <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Vở viết" /></a>
              </div>
              <div class="product-info">
                <a href="#">Vở viết kẻ ngang nhiều hình ngộ nghĩnh</a>
                <div class="product-price">
                  <span class="price">12.000₫</span>
                  <span class="old-price">41.000₫</span>
                </div>
              </div>
            </div>
            <!-- Sản phẩm 3-->
            <div class="product-block">
              <div class="product-block-item">
                <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Vở viết" /></a>
              </div>
              <div class="product-info">
                <a href="#">Vở viết kẻ ngang nhiều hình ngộ nghĩnh</a>
                <div class="product-price">
                  <span class="price">12.000₫</span>
                  <span class="old-price">41.000₫</span>
                </div>
              </div>
            </div>
            <!-- Sản phẩm 4 -->
            <div class="product-block">
              <div class="product-block-item">
                <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Vở viết" /></a>
              </div>
              <div class="product-info">
                <a href="#">Vở viết kẻ ngang nhiều hình ngộ nghĩnh</a>
                <div class="product-price">
                  <span class="price">12.000₫</span>
                  <span class="old-price">41.000₫</span>
                </div>
              </div>
            </div>
            <!-- Sản phẩm 5 -->
            <div class="product-block">
              <div class="product-block-item">
                <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Vở viết" /></a>
              </div>
              <div class="product-info">
                <a href="#">Vở viết kẻ ngang nhiều hình ngộ nghĩnh</a>
                <div class="product-price">
                  <span class="price">12.000₫</span>
                  <span class="old-price">41.000₫</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination">
          <span
            class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
          <span class="swiper-pagination-bullet"></span>
          <span class="swiper-pagination-bullet"></span>
        </div>
      </div>
    </section>

    <!-- ========== Văn phòng phẩm cho bạn ==========  -->
    <section class="section-5">
      <section class="block-tab-product">
        <div class="container">
          <div class="content">
            <div class="block-title clearfix">
              <h2>Văn phòng phẩm cho bạn</h2>
              <ul class="tab-menu">
                <li class="tabs-title active" data-tab="tab1">
                  <span>Sách</span>
                </li>
                <li class="tabs-title" data-tab="tab2"><span>Vở</span></li>
                <li class="tabs-title" data-tab="tab3"><span>Bút</span></li>
                <li class="tabs-title" data-tab="tab4"><span>Bút màu</span></li>
              </ul>
            </div>

            <div class="tab-1 tab-content current">
              <div class="product-list">
                <!-- Sản phẩm 1 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>

                <!-- Sản phẩm 2 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ bìa cứng" /></a>
                  <div class="product-info">
                    <a href="#">Sổ bìa cứng</a>
                    <div class="product-price">
                      <span class="price">40.000đ</span>
                      <span class="old-price">50.000đ</span>
                    </div>
                  </div>
                </div>

                <!-- Sản phẩm 3 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ da cao cấp" /></a>
                  <div class="product-info">
                    <a href="#">Sổ da cao cấp</a>
                    <div class="product-price">
                      <span class="price">100.000đ</span>
                      <span class="old-price">120.000đ</span>
                    </div>
                  </div>
                </div>

                <!-- Sản phẩm 4 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>
                <!-- Sản phẩm 5 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>
                <!-- Sản phẩm 6 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>
                <!-- Sản phẩm 7 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>
                <!-- Sản phẩm 88 -->
                <div class="product-block-item">
                  <a href="#"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Cap.jpg" alt="Sổ tay dễ thương" /></a>
                  <div class="product-info">
                    <a href="#">Sổ dễ thương</a>
                    <div class="product-price">
                      <span class="price">28.000đ</span>
                      <span class="old-price">35.000đ</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination">
              <button>Xem thêm</button>
            </div>
          </div>
        </div>
        </div>
      </section>
    </section>
    <!-- ========= Dịch vụ =========== -->
    <section class="section-6">
      <section class="section-service">
        <div class="container">
          <div class="row">
            <div class="col-md-6 s-left">
              <div class="block-title">
                <h2>Dịch vụ của chúng tôi</h2>
              </div>
              <div class="block-content">
                <div class="item">
                  <div class="icon">
                    <img
                      src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/icongiaohang.svg"
                      alt="Giao hàng nội thành" />
                  </div>
                  <div class="info">
                    <h3>Giao hàng free nội thành</h3>
                    <p>Giao free trong nội thành HN và HCMHCM</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/icontrahang.svg" alt="Trả hàng trong 24h" />
                  </div>
                  <div class="info">
                    <h3>Trả hàng trong vòng 24h</h3>
                    <p>Hỗ trợ trả hàng cho khách khi sản phẩm có lỗi</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img
                      src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Iconkiemtra.svg"
                      alt="Kiểm tra hàng khi nhận" />
                  </div>
                  <div class="info">
                    <h3>Kiểm tra hàng khi nhận hàng</h3>
                    <p>Khách hàng kiểm tra hàng trước khi nhận</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/iconthanhtoan.svg" alt="Thanh toán cod " />
                  </div>
                  <div class="info">
                    <h3>Thanh toán codcod</h3>
                    <p>Hỗ trợ khách hàng thanh toán cod</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="block-image">
                <img
                  src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/giaohang.webp"
                  alt="giaohang"
                  width="419"
                  height="617"
                  left="2500" />
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>

    <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
  </main>

</body>

</html>