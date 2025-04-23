<?php
$products = $products ?? [];
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh Sách Sản Phẩm</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/products/Quanlysanpham.css">


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
    <div class="product-container">
      <h1>Danh Sách Sản Phẩm</h1>

      <!-- Các nút chức năng -->
      <div class="btn-group">
        <button class="btn btn-green">+ Tạo mới sản phẩm</button>
        <button class="btn btn-gray">Xóa tất cả</button>
      </div>

      <!-- Ô tìm kiếm -->
      <div class="search-box">
        <input type="text" placeholder="Tìm kiếm..." />
      </div>

      <!-- Bảng danh sách sản phẩm -->
      <table class="product-table">
          <thead>
              <tr>
                  <th>Mã sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Số lượng</th>
                  <th>Tình trạng</th>
                  <th>Giá bán</th>
                  <th>Danh mục</th>
                  <th>Chức năng</th>
              </tr>
          </thead>
          <tbody>
          <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
              <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><?php echo $product['product_name']; ?></td>
                <td>
                  <!-- <img src="<?php //echo _WEB_ROOT; ?>/public/uploads/products/<?php //echo $product['image']; ?>" alt="Ảnh sản phẩm" /> -->
                </td>
                <td><?php echo $product['stock_quantity']; ?></td>
                <td>
                  <?php if ($product['product_status'] == 1) : ?>
                    <span class="product-badge in-stock">Còn hàng</span>
                  <?php else : ?>
                    <span class="product-badge out-stock">Hết hàng</span>
                  <?php endif; ?>
                </td>
                <td><?php echo number_format($product['priceCurrent'], 0, ',', '.'); ?> đ</td>
                <td><?php echo $product['category_name']; ?></td>
                <td>
                  <button class="action-btn edit">Sửa</button>
                  <button class="action-btn delete">Xóa</button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="9">Không có sản phẩm nào</td>
            </tr>
          <?php endif; ?>
        </tbody>
          </tbody>
        </table>
    </div>
    <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
</main>
</body>
</html>