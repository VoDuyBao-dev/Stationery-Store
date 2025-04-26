<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tạo mới sản phẩm</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/products/TaoSp.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
            float: left;
        }
        main{
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>
  </head>
  <body>
  <header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header-admin.php";?>
  </header>  

  <menu>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php";?>
  </menu> 
  <main>
    <div class="taosp-container">
      <div class="header_1">
        <a href="/duong-dan-den-trang-danh-sach-san-pham">
          <h1>Danh sách sản phẩm / Thêm sản phẩm</h1>
        </a>
      </div>
      <div class="content">
        <h2 style="margin-bottom: 20px; font-size: 30px;">Tạo mới sản phẩm</h2>
        <form class="form" action="<?php echo _WEB_ROOT; ?>/qlsp" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="ten-san-pham">Tên sản phẩm</label>
              <input type="text" id="ten-san-pham" name="product_name" required />
            </div>
          </div>

          <div class="form-group">
            <label for="so-luong">Số lượng</label>
            <input type="number" id="so-luong" name="stock_quantity" min="0" required />
          </div>

          <script>
            document.getElementById('so-luong').addEventListener('input', function (e) {
              if (e.target.value <= 0) {
                alert('Số lượng không được âm và bằng 0!');
                e.target.value = 1; // Reset giá trị về 1
              }
            });
          </script>
            <div class="form-group">
              <label for="tinh-trang">Tình trạng</label>
              <select id="tinh-trang" name="product_status" required>
                <option value="">- Chọn tình trạng -</option>
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="danh-muc">Danh mục</label>
              <select id="danh-muc" name="category_id" required>
                <option value="">- Chọn danh mục -</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?php echo $category['category_id']; ?>">
                    <?php echo $category['name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="gia-ban">Giá bán</label>
              <input type="number" id="gia-ban" name="priceCurrent" min="1" required />
            </div>

            <script>
              document.getElementById('gia-ban').addEventListener('input', function (e) {
                if (e.target.value < 1) {
                  alert('Giá bán phải lớn hơn 0!');
                  e.target.value = 1; // Reset giá trị về 1
                }
              });
            </script>          

          <div class="form-row">
            <div class="form-group-full">
              <label for="anh-san-pham">Ảnh sản phẩm</label>
              <input type="file" id="anh-san-pham" name="image" accept="image/*" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group-full1">
              <label for="mo-ta-san-pham">Mô tả sản phẩm</label>
              <textarea id="mo-ta-san-pham" name="description" required></textarea>
            </div>
          </div>

          <div class="form-row buttons">
            <button type="submit" class="btn-luu">Lưu lại</button>
            <button type="button" class="btn-huy" onclick="window.location.href='<?php echo _WEB_ROOT; ?>/admin/products';">Hủy bỏ</button>
          </div>
        </form>
      </div>
    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </main>
  </body>
</html>
