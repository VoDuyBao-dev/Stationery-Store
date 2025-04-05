<?php
use core\Helpers;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vở viết kẻ ngang nhiều hình siêu ngộ nghĩnh</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/products/Thongtinchitiet.css"/>
    <style>
        menu {
            float: left
        }

        main {
            margin: 150px 0 0 280px;
        }
    </style>
     
    <script>
        const BASE_URL = "<?php echo _WEB_ROOT; ?>"; // Đường dẫn gốc của trang web
        function viewProduct(product_name, id_product, id_product_type) {
            const url = BASE_URL+"/thong-tin-sp/" + encodeURIComponent(product_name) + '/' + id_product + '/' + id_product_type;
            window.location.assign(url);
           
        }

        function changeProductType(productTypeId) {
            fetch("/ss2/getProductType?product_type_id=" + productTypeId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }

                    document.querySelector("h2").innerText = data.name;
                    document.querySelector(".product_code").innerText = data.product_type_id;
                    document.querySelector(".old-price").innerText = data.priceOld.toLocaleString() + "0đ";
                    document.querySelector(".price").innerHTML =
                        data.priceCurrent.toLocaleString() + "0đ" +
                        `<span class="old-price">${data.priceOld.toLocaleString()}0đ</span>`;
                    document.querySelector(".status").innerText = data.stock_quantity > 0 ? "Còn hàng" : "Hết hàng";
                    document.querySelector(".main-image").src = "<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/" + data.image;

                    // Cập nhật product_type_id vào form
                    document.getElementById('selected_product_type_id').value = data.product_type_id;
                    document.getElementById('selected_image').value = data.image;
                    document.getElementById('selected_priceCurrent').value = data.priceCurrent;
                    document.getElementById('selected_priceOld').value = data.priceOld;
                })
                .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
        }
    </script>
</head>

<body data-web-root="<?= _WEB_ROOT ?>">
<header>
    <?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>
</header>
<menu>
    <?php require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?>
</menu>
<main>

    <!-- Khu vực hiển thị sản phẩm -->
    <div class="nd-img-and-info">
        <!-- Hình ảnh sản phẩm -->
        <div class="product-images">
            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/products/<?= $default_product_type['image']; ?>"
                 alt="Sổ tay mini" class="main-image"/>
            <div class="thumbnail-container">
                <?php foreach ($images_product as $img): ?>
                    <img src="<?= $img['image_url'] ?>" class="thumbnail"/>
                <?php endforeach; ?>
                <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/products/<?= $default_product_type['image']; ?>"
                     class="thumbnail"/>

            </div>
        </div>
        <!-- Thông tin sản phẩm -->
        <div class="product-info">
            <h2><?= $product['product_name']; ?></h2>
            <p class="price"><?= $default_product_type['priceCurrent']; ?>0đ <span
                        class="old-price"><?= $default_product_type['priceOld']; ?>0đ</span></p>
            <p></p>
            <p><strong>Mã sản phẩm:</strong> <span
                        class="product_code"><?= $default_product_type['product_type_id']; ?></span></p>
            <p><strong>Tác giả:</strong> <?= $product['brand_name']; ?></p>
            <p><strong>Tình trạng:</strong> <span
                        class="status"><?php echo ($default_product_type['stock_quantity'] > 0) ? "Còn hàng" : "Hết hàng"; ?></span>
            </p>

            <?php
            // Đảm bảo biến tồn tại trước khi sử dụng
            $product_type_id = $default_product_type['product_type_id'] ?? null;
            ?>
            <!-- Lựa chọn loại -->
            <label>Loại:</label>
            <div class="color-options">
                <?php
                foreach ($product_types as $type) {
                    $activeClass = ($type['product_type_id'] == $product_type_id) ? "class='active'" : "";
                    echo "<button $activeClass onclick='changeProductType(" . $type['product_type_id'] . ")'>" . $type['name'] . "</button>";
                }
                ?>

            </div>


            <!-- Điều chỉnh số lượng -->
            <label>Số lượng:</label>
            <div class="quantity-control">
                <button>-</button>
                <input type="number" value="1" min="1"/>
                <button>+</button>
            </div>

            <?php if ($message = Helpers::getFlash('add_cart')): ?>
                  <div><?php echo $message; ?></div>
              <?php endif; ?>
            <!-- Nút mua hàng -->
            <div class="buttons">
                <!-- Thêm vào giỏ hàng -->
                <form action="<?= _WEB_ROOT ?>/add_cart" method="POST">
                   
                    <input type="hidden" name="product_type_id" id="selected_product_type_id"
                           value="<?= $default_product_type['product_type_id']; ?>"/>
                    <input type="hidden" name="product_name" value="<?= $product['product_name']; ?>"/>
                    <input type="hidden" name="image" id="selected_image"
                           value="<?= $default_product_type['image']; ?>"/>
                    <input type="hidden" name="priceCurrent" id="selected_priceCurrent"
                           value="<?= $default_product_type['priceCurrent']; ?>"/>
                    <input type="hidden" name="priceOld" id="selected_priceOld"
                           value="<?= $default_product_type['priceOld']; ?>"/>
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>"/>

                    <button class="add-to-cart" type="submit" name="addcart">Thêm vào giỏ hàng</button>
                </form>
               
                

                <button class="buy-now">Mua ngay</button>

               
                
            </div>
        </div>

        <!-- Dịch vụ hỗ trợ -->
        <div class="service_product">
            <div class="item">
                <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/icongiaohang.svg"
                         alt="Giao hàng nội thành"/>
                </div>
                <div class="info">
                    <h3>Giao hàng free nội thành</h3>
                    <p>Giao free trong nội thành HN và HCMHCM</p>
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/icontrahang.svg"
                         alt="Trả hàng trong 24h"/>
                </div>
                <div class="info">
                    <h3>Trả hàng trong vòng 24h</h3>
                    <p>Hỗ trợ trả hàng cho khách khi sản phẩm có lỗi</p>
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/Iconkiemtra.svg"
                         alt="Kiểm tra hàng khi nhận"/>
                </div>
                <div class="info">
                    <h3>Kiểm tra hàng khi nhận hàng</h3>
                    <p>Khách hàng kiểm tra hàng trước khi nhận</p>
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/iconthanhtoan.svg"
                         alt="Thanh toán cod "/>
                </div>
                <div class="info">
                    <h3>Thanh toán cod</h3>
                    <p>Hỗ trợ khách hàng thanh toán cod</p>
                </div>
            </div>
            <div class="promo-section">
                <h3>Ưu đãi liên quan:</h3>
                <ul>
                    <li>Nhập mã <strong>QRDAY</strong>, giảm 30%, đơn hàng từ 59k</li>
                    <li>Hoàn 30%, tối đa 50k, thanh toán qua Moca</li>
                    <li>Nhập mã <strong>AIRPAY024</strong>, giảm ngay 10%</li>
                </ul>
                <a href="#">Xem thêm ưu đãi khác</a>
            </div>
        </div>
    </div>

    <!-- Thông tin chi tiết sản phẩm -->
    <div class="product-details">
        <h2>Thông tin chi tiết</h2>
        <ul>
            <?php foreach ($product['description'] as $descrip): ?>
                <li><?= $descrip; ?></li>
            <?php endforeach; ?>

        </ul>
    </div>
    <!-- Đánh giá sản phẩm -->
    <div class="container">
        <div class="row">
            <!-- Cột trái: Tổng quan đánh giá -->
            <div class="col-left">
                <h3>Đánh giá sản phẩm</h3>
                <div class="rating-container">
                    <span class="rating">★</span>
                    <span class="rating-score">4.8</span>
                    <span class="rating-count">4 đánh giá</span>
                </div>
                <div class="stars-container">
                    <div class="star-row">
                        <span class="star-text">★★★★★</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%;"></div>
                        </div>
                        <span>3</span>
                    </div>
                    <div class="star-row">
                        <span class="star-text">★★★★☆</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 25%;"></div>
                        </div>
                        <span>1</span>
                    </div>
                    <div class="star-row">
                        <span class="star-text">★★★☆☆</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%;"></div>
                        </div>
                        <span>0</span>
                    </div>
                    <div class="star-row">
                        <span class="star-text">★★☆☆☆</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%;"></div>
                        </div>
                        <span>0</span>
                    </div>
                    <div class="star-row">
                        <span class="star-text">★☆☆☆☆</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%;"></div>
                        </div>
                        <span>0</span>
                    </div>
                </div>

                <!-- Dropdown Lọc đánh giá -->
                <div class="dropdown" style="margin-top: 15px;">
                    <button class="filter-btn">☰ Lọc đánh giá</button>
                    <div class="dropdown-content">
                        <a href="#">Từ mới đến cũ</a>
                        <a href="#">Có hình ảnh</a>
                        <a href="#">5 sao</a>
                        <a href="#">4 sao</a>
                        <a href="#">3 sao</a>
                        <a href="#">2 sao</a>
                        <a href="#">1 sao</a>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Hiển thị đánh giá hoặc thông báo chưa có đánh giá -->
            <div class="col_right">
                <div class="empty-review">
                    <h4>Đánh giá sản phẩm</h4>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <span class="star-outline" onclick="rateProduct(1)">★</span>
                        <span class="star-outline" onclick="rateProduct(2)">★</span>
                        <span class="star-outline" onclick="rateProduct(3)">★</span>
                        <span class="star-outline" onclick="rateProduct(4)">★</span>
                        <span class="star-outline" onclick="rateProduct(5)">★</span>
                    </div>
                    <p><a href="#" style="color: blue;" class="open-modal"> Đánh giá sản phẩm!</a></p>
                </div>
            </div>
            <div class="review-modal" id="review-modal">
                <div class="review-header">
                    <h2>ĐÁNH GIÁ SẢN PHẨM</h2>
                    <span class="close-btn">&times;</span>
                </div>
                <div class="star-rating">
                    <span class="star" onclick="rateStar(1)">★</span>
                    <span class="star" onclick="rateStar(2)">★</span>
                    <span class="star" onclick="rateStar(3)">★</span>
                    <span class="star" onclick="rateStar(4)">★</span>
                    <span class="star" onclick="rateStar(5)">★</span>
                </div>
                <label for="review-text">Viết đánh giá <span class="required">*</span></label>
                <textarea id="review-text" placeholder="Hãy chia sẻ đánh giá của bạn về sản phẩm"
                          maxlength="500"></textarea>
                <p class="char-count"><span id="char-count">0</span>/500 ký tự</p>
                <label>Hình ảnh đánh giá (định dạng .jpg, .jpeg, .png)</label>
                <div class="upload-box">+</div>
                <label for="display-name">Tên hiển thị <span class="required">*</span></label>
                <input type="text" id="display-name" placeholder="Nhập tại đây">
                <div class="input-row">
                    <div>
                        <label for="email">Email <span class="required">*</span> (không hiển thị trên website)</label>
                        <input type="email" id="email" placeholder="Nhập tại đây">
                    </div>
                    <div>
                        <label for="phone">Số điện thoại (không hiển thị trên website)</label>
                        <input type="tel" id="phone" placeholder="Nhập tại đây">
                    </div>
                </div>
                <div class="button-row">
                    <button class="cancel-btn">Hủy</button>
                    <button class="submit-btn">Gửi đánh giá</button>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const modal = document.getElementById("review-modal");
                    const openBtn = document.querySelector(".open-modal");
                    const closeBtn = document.querySelector(".close-btn");
                    const cancelBtn = document.querySelector(".cancel-btn");

                    // Mở modal
                    openBtn.addEventListener("click", function (event) {
                        event.preventDefault();
                        modal.classList.add("active");
                    });

                    // Đóng modal
                    function closeModal() {
                        modal.classList.remove("active");
                    }

                    closeBtn.addEventListener("click", closeModal);
                    cancelBtn.addEventListener("click", closeModal);

                    // Chọn số sao
                    function rateStar(starCount) {
                        let stars = document.querySelectorAll(".star");
                        stars.forEach((star, index) => {
                            if (index < starCount) {
                                star.classList.add("active");
                            } else {
                                star.classList.remove("active");
                            }
                        });
                    }

                    window.rateStar = rateStar;

                    // Đếm số ký tự
                    document.getElementById("review-text").addEventListener("input", function () {
                        document.getElementById("char-count").textContent = this.value.length;
                    });
                });
            </script>


            <!-- Danh sách đánh giá -->
            <div class="review-container">
                <div class="review-box">
                    <h5>Phương Linh</h5>
                    <div class="rating">★★★★★</div>
                    <p class="review-text">
                        Viết rất êm nhưng mọi người không thích "màu xanh ngọc", nếu có thể tôi muốn nhà sản xuất đổi
                        sang "màu hồng pastel".
                    </p>
                    <div>
                        <span class="vote-buttons">👍 (0)</span>
                        <span class="vote-buttons">👎 (0)</span>
                    </div>
                    <p class="text-muted">25/10/2024</p>
                </div>

                <div class="review-box">
                    <h5>Ngọc Hân</h5>
                    <div class="rating">★★★★☆</div>
                    <p class="review-text">
                        Giao hàng nhanh, đóng gói cẩn thận. Màu sắc đẹp nhưng hơi nhỏ hơn mong đợi.
                    </p>
                    <div>
                        <span class="vote-buttons">👍 (2)</span>
                        <span class="vote-buttons">👎 (0)</span>
                    </div>
                    <p class="text-muted">18/09/2024</p>
                </div>
                <!-- Nút xem thêm -->
                <button id="see-more-btn" class="see-more-btn">Xem thêm</button>
            </div>
        </div>

        <div
                style="
        width: 95%;
        height: 5px;
        margin-top: 100px;
        background-color:rgb(105, 22, 59);
        box-shadow: 0 0 10px #dfdbdd;
      "
        ></div>

        <section class="section-4">
            <div class="container">
                <div class="block-title">
                    <h2><a href="s">Sản phẩm liên quan</a></h2>
                </div>
                <div class="block-product">
                    <div class="product-featured-swiper">

                        <?php if (!empty($products_related)): ?>
                            <?php foreach ($products_related as $product): ?>
                                <div class="product-block"
                                     onclick="event.preventDefault(); viewProduct('<?= $product['product_name'] ?>', <?= $product['product_id'] ?>, <?= $product['product_type_id'] ?>)">
                                    <div class="product-block-item">

                                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/products/<?= $product['image'] ?>"
                                             alt="Vở viết"/>
                                    </div>
                                    <div class="product-info">
                                        <p><?= $product['product_name'] ?></p>
                                        <div class="product-price">
                                            <span class="price"><?= $product['priceCurrent'] ?>0₫</span>
                                            <span class="old-price"><?= $product['priceOld'] ?>0₫</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </div>
                </div>
                <div class="view-more">
          <span
          >Xem thêm </span>
                </div>
            </div>
        </section>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
</main>


</body>
</html>
