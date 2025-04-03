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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <title>Trang chủ</title>
    <script>
    function viewProduct(product_name ,id_product, id_product_type) {
        window.location.href = "thong-tin-sp/" + encodeURIComponent(product_name) +'/'+ id_product +'/' + id_product_type;
    }

   
</script>
  </head>
  <body>
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
            <a href="" title="Flash sale"
              ><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/fs.png" alt="fash-sale"
            /></a>
          </h2>
        </div>
        <div class="block-product">
        
          <!-- list Sản phẩm flash sale -->
        <?php if (!empty($flashSale_products)): ?>
          <?php foreach($flashSale_products as $product):?>
          
          <div class="product-card">
            <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $product['image'] ?>" alt="Hộp bút" />
            <div class="product-name"><?= $product['product_name'] ?></div>
            <div class="price">
            <?= $product['priceCurrent'] ?>0₫ <span class="old-price"><?= $product['priceOld'] ?>0₫</span>
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
          <h2><a href="spnb">Sản phẩm nổi bật</a></h2>
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
                    <span class="price"><?= $product['price'] ?>0₫</span>
                    <span class="old-price"><?= $product['price_old'] ?>0₫</span>
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
        console.log("Fetching sản phẩm với category ID:", categoryId);

        fetch(`/<?= _NAME_PROJECT?>/product/getProducts_ofCategory?category_id=${categoryId}`)
            .then(response => response.text()) // Chuyển về text trước để kiểm tra lỗi
            .then(text => {
                console.log("Raw JSON:", text);
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
                    price.innerText = product.priceCurrent ? product.priceCurrent + "₫" : "Liên hệ";

                    priceContainer.appendChild(price);

                    if (product.priceOld) {
                        let oldPrice = document.createElement("span");
                        oldPrice.classList.add("old-price");
                        oldPrice.innerText = product.priceOld + "₫";
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

  </body>
</html>
