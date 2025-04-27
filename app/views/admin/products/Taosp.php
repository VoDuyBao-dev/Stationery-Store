<?php $breadcrumb = "Thêm sản phẩm mới"; 
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
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        menu { float: left; }
        main { margin-top: 130px; margin-left: 280px; }
    </style>
</head>
<body>
    <header>
        <?php require_once _DIR_ROOT . "/app/views/blocks/header-admin.php";?>
    </header>  

    <menu>
        <?php require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php";?>
    </menu> 

    <main>
        <div class="taosp-container">
            <div class="header_1">
                <h1>Danh sách sản phẩm / Thêm sản phẩm</h1>
            </div>

            <div class="content">
                <h2>Thêm sản phẩm mới</h2>
               
<?php if ($message = Helpers::getFlash('error')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>

                <form action="<?= _WEB_ROOT; ?>/them-san-pham" class="form" method="POST" enctype="multipart/form-data">
                    <!-- Thông tin sản phẩm cơ bản -->
                    <div class="section-title">Thông tin sản phẩm</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ten-san-pham">Tên sản phẩm</label>
                            <input type="text" id="ten-san-pham" name="product_name" required />
                        </div>
                        <div class="form-group">
                            <label for="danh-muc">Danh mục</label>
                            <select id="danh-muc" name="category_id" required>
                                <option value="">- Chọn danh mục -</option>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="manufacturer">Nhà sản xuất</label>
                            <select id="manufacturer" name="brand_id" required>
                                <option value="">- Chọn nhà sản xuất -</option>
                                <?php foreach($brands as $brand): ?>
                                    <option value="<?= $brand['brand_id'] ?>"><?= $brand['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group-full">
                            <label for="mo-ta">Mô tả sản phẩm</label>
                            <textarea id="mo-ta" name="description"></textarea>
                        </div>
                    </div>

                    <!-- Phân loại sản phẩm -->
                    <div class="section-title">Thông tin phân loại sản phẩm</div>
                    <div id="product-types">
                        <div class="product-type-section">
                                  
<!-- Upload nhiều ảnh phụ -->
<div class="form-row">
        <div class="form-group-full">
            <label>Ảnh chi tiết sản phẩm</label>
            <div class="upload-container">
                <input type="file" id="product-images" name="product_images[]" multiple accept="image/*" class="file-input" />
                <div class="upload-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Kéo thả ảnh vào đây hoặc click để chọn ảnh</span>
                </div>
                <div id="preview-container" class="preview-container"></div>
            </div>
        </div>
    </div>





<!-- test js -->
<div class="form-row">
                <div class="form-group">
                    <label>Tên phân loại</label>
                    <input type="text" name="product_types[0][name]" required />
                </div>
                <div class="form-group">
                    <label>Giá bán</label>
                    <input type="number" 
                           name="product_types[0][priceCurrent]" 
                           min="0" 
                           
                           oninput="validateNumber(this, 'Giá bán')"
                           required />
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" 
                           name="product_types[0][stock_quantity]" 
                           min="0" 
                           step="1"
                           oninput="validateNumber(this, 'Số lượng')"
                           required />
                </div>
                <div class="form-group">
                    <label>Ảnh chính phân loại</label>
                    <input type="file" name="product_types[0][main_image]" accept="image/*" required class="main-image-input" onchange="previewMainImage(this)" />
                    <div class="preview-main-image"></div>
                </div>
                
            </div>
<!-- test js -->



                        
                        </div>
                    </div>

                    <button type="button" id="add-type" class="btn-them-phan-loai">+ Thêm phân loại</button>

                    <div class="form-row buttons">
                        <button type="submit" class="btn-luu">Lưu lại</button>
                        <a href="<?=_WEB_ROOT?>/quan-ly-san-pham" class="btn-huy">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </main>

    <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/products/TaoSp.js"></script>
</body>
</html>