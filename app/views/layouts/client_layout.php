<?php
use core\Helpers;
$outstanding_products = $outstanding_products ?? [];
$flashSale_products = $flashSale_products ?? [];
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/TrangChu.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    

    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <script>
      function viewProduct(product_name ,id_product, id_product_type) {
          window.location.href = "thong-tin-sp/" + encodeURIComponent(product_name) +'/'+ id_product +'/' + id_product_type;
      }
      var test = _WEB_ROOT;

      function formatCurrencyVND(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + '₫';
      }

    </script>
    <style>
        menu {
            float: left;
        }
        main{
            margin-top: 100px;
            margin-left: 280px;
        }
    </style>
    <title>Trang chủ</title>
   

  </head>
  <body>
  <header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
</header>  

<menu>

    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php";?>
</menu> 
<main>



  <?php if ($message = Helpers::getFlash('error_params')): ?>
    <div><?php echo $message; ?></div>
<?php endif; ?>
    <!-- ========== Slider ========== -->
    <section class="section-1">
      <div class="home-slider">
        <div class="main clearfix">
          <div class="clearfix">
            <a href=""><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/slider_1.webp" alt="Văn phòng phẩm" /></a>
          </div>
        </div>
        <button class="fa-solid fa-arrow-left"></button
        ><button class="fa-solid fa-arrow-right"></button>
      </div>
    </section>
    <!-- ========== Danh mục sản phẩm ========== -->
    <section class="section-2">
      <div class="cate-list">
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/vvphocsinh.webp" alt="Văn phòng phẩm học sinh"
            /></a>
            <h3 class="title_cate"><a href="http://">Vpp học sinh</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/vpp_vanphong.jpg" alt="Văn phòng phẩm văn phòng"
            /></a>
            <h3 class="title_cate"><a href="http://">Vpp văn phòng</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/Phu_kien.jpg" alt="Phụ kiện"
            /></a>
            <h3 class="title_cate"><a href="http://">Phu kiện</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/Cap.jpg" alt="Cặp-Túi xách"
            /></a>
            <h3 class="title_cate"><a href="http://">Cặp-Túi xách</a></h3>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="cate-item">
            <a class="img" href=""
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/Dungcuvp.jpg" alt="Dụng cụ văn phòng"
            /></a>
            <h3 class="title_cate"><a href="http://">Dụng cụ văn phòng</a></h3>
          </div>
        </div>
      </div>
    </section>
    <!-- Hiển thị lỗi xem chi tiết sản phẩm -->
<?php if ($message = Helpers::getFlash('error')): ?>
    <div class="error-message"><?php echo $message; ?></div>
<?php endif; ?>
    <!-- ========== Flash Sale ==========  -->
    <section class="section-3">
      <div class="container">
        <div class="block-title">
          <h2>
           
              <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/fs.png" alt="fash-sale"
            />
          </h2>
        </div>
        <div class="block-product">
        
          <!-- list Sản phẩm flash sale -->
        <?php if (!empty($flashSale_products)): ?>
          <?php foreach($flashSale_products as $product):?>
          
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" />
            <div class="product-name"><?= $product['product_name'] ?></div>
            <div class="price">
            
            <?= Helpers::format_currency($product['priceCurrent']); ?> <span class="old-price"><?= Helpers::format_currency($product['priceOld']); ?></span>
            </div>
            <button class="buy-button" onclick="viewProduct('<?= $product['product_name'] ?>',<?= $product['product_id'] ?>,<?= $product['product_type_id'] ?> )" >Xem ngay </button>
           
          </div>
          <?php endforeach;?>
            <?php else: ?>
              <?php if ($message = Helpers::getFlash('empty_flashSale_products')): ?>
    <div><?php echo $message; ?></div>
<?php endif; ?>
    <?php endif; ?>

    

        </div>
        <div class="fa-solid fa-arrow-left"></div>
        <div class="fa-solid fa-arrow-right"></div>
      </div>
    </section>
    <!-- ========== Sản phẩm nổi bật ========== -->
    <section class="section-4">
      <div class="container">
        <div class="block-title">
          <h2> Sản phẩm nổi bật</h2>
        </div>
        <div class="block-product">
          <div class="product-featured-swiper">
            <!-- List Sản phẩm  -->
            <?php if (!empty($outstanding_products)): ?>
             <?php foreach($outstanding_products as $product):?>
              <div class="product-block" onclick="viewProduct('<?= $product['product_name'] ?>',<?= $product['product_id'] ?>,<?= $product['product_type_id'] ?> )" style="cursor: pointer;">
                <div class="product-block-item">
                  <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $product['image'] ?>" alt="Vở viết" />
                </div>
                <div class="product-info">
                  <span><?= $product['product_name'] ?></span>
                  <div class="product-price">
                  
                    <span class="price"><?= Helpers::format_currency($product['price']); ?></span>
                    <span class="old-price"><?= Helpers::format_currency($product['price_old']); ?></span>
                  </div>
                </div>
              </div>
            <?php endforeach;?>
            <?php else: ?>
              <?php if ($message = Helpers::getFlash('empty_outstanding_products')): ?>
                  <div><?php echo $message; ?></div>
              <?php endif; ?>
                  <?php endif; ?>
            
          </div>
        </div>
        <div class="swiper-pagination">
          <span
            class="swiper-pagination-bullet swiper-pagination-bullet-active"
          ></span>
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
    <?php foreach ($categories as $index => $category): ?>
        <li class="tabs-title <?= $index === 0 ? 'active' : '' ?>" 
            data-tab="tab<?= $index + 1 ?>" 
            data-id="<?= $category['category_id'] ?>">
            <span><?= htmlspecialchars($category['name']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>
            </div>

            <div class="tab-1 tab-content current" id="tab1">
    <div class="product-list">
        <!-- Các sản phẩm sẽ được hiển thị ở đây sau khi JS xử lý -->
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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tabs-title");
    const productContainer = document.querySelector(".tab-1 .product-list");

    function loadProducts(categoryId) {
      

        fetch(`/<?=_NAME_PROJECT?>/getProductsBy_category?category_id=${categoryId}`)
            .then(response => response.text()) // Chuyển về text trước để kiểm tra lỗi
            .then(text => {
                return JSON.parse(text);
            })
            .then(data => {
                console.log("Dữ liệu nhận được:", data);

                productContainer.innerHTML = ""; // Xóa nội dung cũ

                if (!Array.isArray(data)) {
                    productContainer.innerHTML = `<p>Lỗi: Dữ liệu không hợp lệ!</p>`;
                    return;
                }

                if (data.length === 0) {
                    productContainer.innerHTML = `<p>Không có sản phẩm nào.</p>`;
                    return;
                }

                data.forEach(product => {
                    let productDiv = document.createElement("div");
                    productDiv.classList.add("product");

                    let productLink = document.createElement("a");
                    productLink.href = `<?php echo _WEB_ROOT;?>/thong-tin-sp/${product.product_name}/${product.product_id}/${product.product_type_id}`;

                    let productImage = document.createElement("img");
                    productImage.src = `<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/${product.image || 'default.jpg'}`;
                    productImage.alt = product.product_name;
                    productImage.width = 150;
                    productImage.height = 150;

                    productLink.appendChild(productImage);

                    let productInfo = document.createElement("div");
                    productInfo.classList.add("product-info");

                    let productName = document.createElement("a");
                    productName.href = `<?php echo _WEB_ROOT;?>/thong-tin-sp/${product.product_name}/${product.product_id}/${product.product_type_id}`;
                    productName.innerText = product.product_name;

                    let priceContainer = document.createElement("div");
                    priceContainer.classList.add("product-price");

                    let price = document.createElement("span");
                    price.classList.add("price");
                    price.innerText = product.priceCurrent ? formatCurrencyVND(product.priceCurrent) : "Liên hệ";

                    priceContainer.appendChild(price);

                    if (product.priceOld) {
                        let oldPrice = document.createElement("span");
                        oldPrice.classList.add("old-price");
                        oldPrice.innerText = formatCurrencyVND(product.priceOld);
                        priceContainer.appendChild(oldPrice);
                    }

                    productInfo.appendChild(productName);
                    productInfo.appendChild(priceContainer);

                    productDiv.appendChild(productLink);
                    productDiv.appendChild(productInfo);

                    productContainer.appendChild(productDiv);
                });

                document.querySelector(".tab-1").classList.add("current");
            })
            .catch(error => {
                console.error("Lỗi:", error);
                productContainer.innerHTML = `<p>Lỗi tải dữ liệu!</p>`;
            });
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            tabs.forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("current"));

            this.classList.add("active");

            let categoryId = this.getAttribute("data-id");
            loadProducts(categoryId);
        });
    });

    // Kích hoạt tab đầu tiên khi tải trang
    if (tabs.length > 0) {
        tabs[0].click();
    }
});

    </script>
    <!-- ========= Dịch vụ =========== -->
    <section class="section-6">
      <section class="section-service">
        <div class="container">
          <div class="row">
            <div class="col-md-6 s-left">
              <div class="block-title"><h2>Dịch vụ của chúng tôi</h2></div>
              <div class="block-content">
                <div class="item">
                  <div class="icon">
                    <img
                      src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/icongiaohang.svg"
                      alt="Giao hàng nội thành"
                    />
                  </div>
                  <div class="info">
                    <h3>Giao hàng free nội thành</h3>
                    <p>Giao free trong nội thành HN và HCMHCM</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/icontrahang.svg" alt="Trả hàng trong 24h" />
                  </div>
                  <div class="info">
                    <h3>Trả hàng trong vòng 24h</h3>
                    <p>Hỗ trợ trả hàng cho khách khi sản phẩm có lỗi</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img
                      src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/Iconkiemtra.svg"
                      alt="Kiểm tra hàng khi nhận"
                    />
                  </div>
                  <div class="info">
                    <h3>Kiểm tra hàng khi nhận hàng</h3>
                    <p>Khách hàng kiểm tra hàng trước khi nhận</p>
                  </div>
                </div>
                <div class="item">
                  <div class="icon">
                    <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/iconthanhtoan.svg" alt="Thanh toán cod " />
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
                  src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/giaohang.webp"
                  alt="giaohang"
                  width="419"
                  height="617"
                  left= "2500"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
   <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
   </main>
  </body>
</html>
