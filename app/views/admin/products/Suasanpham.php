<?php $breadcrumb = "Sửa sản phẩm";

use core\Helpers;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/products/TaoSp.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        menu {
            float: left;
        }

        main {
            margin-top: 130px;
            margin-left: 280px;
        }
    </style>
</head>

<body>
    <header>
        <?php require_once _DIR_ROOT . "/app/views/blocks/header-admin.php"; ?>
    </header>

    <menu>
        <?php require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php"; ?>
    </menu>

    <main>
        <div class="taosp-container">
            <div class="header_1">
                <h1>Danh sách sản phẩm / Thêm sản phẩm</h1>
            </div>

            <div class="content">
                <h2>Cập nhật sản phẩm</h2>
                <?php if ($message = Helpers::getFlash('message')): ?>
                    <div class="success-message"><?php echo $message; ?></div>
                <?php endif; ?>

                <!-- các lỗi do bên thêm sửa xóa sản phẩm -->
                <?php if ($message = Helpers::getFlash('error')): ?>
                    <div class="success-message"><?php echo $message; ?></div>
                <?php endif; ?>

                <form action="<?= _WEB_ROOT; ?>/editingProduct" class="form" method="POST" enctype="multipart/form-data">
                    <!-- Add hidden input for product_id -->
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>" />

                    <!-- Thông tin cơ bản -->
                    <div class="section-title">Thông tin sản phẩm</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ten-san-pham">Tên sản phẩm</label>
                            <input type="text"
                                id="ten-san-pham"
                                name="product_name"
                                value="<?= htmlspecialchars($product['name'] ?? '') ?>"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="danh-muc">Danh mục</label>
                            <select id="danh-muc" name="category_id" required>
                                <option value="">- Chọn danh mục -</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['category_id'] ?>"
                                        <?= ($category['category_id'] == ($product['category_id'] ?? '')) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="manufacturer">Nhà sản xuất</label>
                            <select id="manufacturer" name="brand_id" required>
                                <option value="">- Chọn nhà sản xuất -</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand['brand_id'] ?>"
                                        <?= ($brand['brand_id'] == $product['brand_id']) ? 'selected' : '' ?>><?= $brand['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group-full">
                            <label for="mo-ta">Mô tả sản phẩm</label>
                            <textarea id="mo-ta" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Upload ảnh phụ -->
                    <div class="section-title">Ảnh chi tiết sản phẩm</div>
                    <div class="form-row">
                        <div class="form-group-full">
                            <div class="upload-container">
                                <input type="file" id="product-images" name="product_images[]" multiple accept="image/*" class="file-input" />
                                <div class="upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Kéo thả ảnh vào đây hoặc click để chọn ảnh</span>
                                </div>
                                <div id="preview-container" class="preview-container">
                                    <?php if (!empty($imagesProduct)): ?>
                                        <?php foreach ($imagesProduct as $image): ?>

                                            <div class="preview-image">
                                                <img src="<?= _WEB_ROOT; ?>/public/assets/clients/images/image_product/<?= $image['image_url'] ?>" alt="<?= $product['name'] ?>" style="width: 100px; height: 100px; object-fit: cover; margin: 5px;">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Phân loại sản phẩm -->
                    <div class="section-title">Thông tin phân loại sản phẩm</div>
                    <div id="product-types">
                        <?php if (!empty($productType_ofProductID)): ?>
                            <?php foreach ($productType_ofProductID as $index => $type): ?>
                                <div class="product-type-section">
                                    <!-- Add hidden input for product_type_id -->
                                    <input type="hidden"
                                        name="product_types[<?= $index ?>][product_type_id]"
                                        value="<?= $type['product_type_id'] ?>" />

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Tên phân loại</label>
                                            <input type="text"
                                                name="product_types[<?= $index ?>][productType_name]"
                                                value="<?= htmlspecialchars($type['productType_name']) ?>"
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label>Giá cũ</label>
                                            <input type="text"
                                                name="product_types[<?= $index ?>][priceOld]"
                                                value="<?= !empty($type['priceOld']) ? Helpers::format_currency($type['priceOld']) : '--' ?>"
                                                readonly
                                                style="background-color: #f5f5f5; cursor: not-allowed;" />
                                        </div>
                                        <div class="form-group">
                                            <label>Giá hiện tại</label>
                                            <input type="text"
                                                name="product_types[<?= $index ?>][priceCurrent]"

                                                value="<?= Helpers::format_currency($type['priceCurrent']); ?>"
                                                readonly
                                                style="background-color: #f5f5f5; cursor: not-allowed;" />
                                        </div>
                                        <div class="form-group">
                                            <label>Giá mới</label>
                                            <input type="number"
                                                name="product_types[<?= $index ?>][priceNew]"

                                                min="0"
                                                oninput="validateNumber(this, 'Giá mới')"
                                                required />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number"
                                                name="product_types[<?= $index ?>][stock_quantity]"
                                                value="<?= $type['stock_quantity'] ?>"
                                                min="0"
                                                step="1"
                                                oninput="validateNumber(this, 'Số lượng')"
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label>Ảnh chính phân loại</label>
                                            <input type="file"
                                                name="product_types[<?= $index ?>][main_image]"
                                                accept="image/*"
                                                class="main-image-input"
                                                onchange="previewMainImage(this)" />
                                            <div class="preview-main-image">
                                                <?php if (!empty($type['image'])): ?>
                                                    <img src="<?= _WEB_ROOT ?>/public/assets/clients/images/image_products_type/<?= $type['image'] ?>"
                                                        alt="<?= htmlspecialchars($type['productType_name']) ?>"
                                                        style="max-width: 50px; max-height: 50px;" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>



                    <div class="form-row buttons">
                        <button type="submit" class="btn-luu">Lưu lại</button>

                        <a href="<?= _WEB_ROOT ?>/quan-ly-san-pham" class="btn-huy">Hủy bỏ</a>

                    </div>
                </form>
            </div>
        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </main>

    <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/products/TaoSp.js"></script>

</body>

</html>