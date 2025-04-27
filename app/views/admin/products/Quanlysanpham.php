<?php $breadcrumb = "Danh sách sản phẩm"; 
use core\Helpers;?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
            float: left;
        }
        main{
            margin-top: 130px;
            margin-left: 280px;
        }
        .pnow{
          font-size: 20px;
          font-weight: bold;
          color: #ca9b54;
          text-decoration: underline;
          text-align: center;
          margin: 10px 0;
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
      <?php if ($message = Helpers::getFlash('message')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>

<!-- các lỗi do bên thêm sửa xóa sản phẩm -->
<?php if ($message = Helpers::getFlash('error')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>
      <!-- Các nút chức năng -->
      <div class="btn-group">
        
        <button id="createProductBtn" class="btn btn-green">+ Tạo mới sản phẩm</button>
        <button class="btn btn-red">Xuất Excel</button>
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
            <th>Giá cũ</th>
            <th>Danh mục</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($productTypes)): ?>
            <?php foreach ($productTypes as $type): ?>
                <tr>
                    <td><?php echo $type['product_id']?></td>
                    <td><?php echo htmlspecialchars($type['product_name']); ?></td>
                    <td>
                        <?php if ($type['image']): ?>
                            <img src="<?php echo _WEB_ROOT . '/public/assets/clients/images/image_products_type/' . $type['image']; ?>" 
                                 alt="<?php echo htmlspecialchars($type['product_name']); ?>" />
                                 <?php endif; ?>
                    </td>
                    <td><?php echo $type['stock_quantity']; ?></td>
                    <td>
                        <?php if ($type['status'] == '1'): ?>
                            <span class="product-badge in-stock">Còn hàng</span>
                        <?php else: ?>
                            <span class="product-badge out-stock">Hết hàng</span>
                        <?php endif; ?>
                    </td>
                   
                    <td> <?= Helpers::format_currency($type['priceCurrent']); ?></td>
                   
                    <td><?php echo $type['priceOld'] ? Helpers::format_currency($type['priceOld']) : '--'; ?></td>
                    <td><?php echo htmlspecialchars($type['name_category'] ?? ''); ?></td>
                    <td>
                    <a href="<?php echo _WEB_ROOT . '/sua-san-pham?product_id=' . $type['product_id']; ?>" 
                           class="action-btn delete">
                           Sửa
                        </a>
                        
                        <a href="<?php echo _WEB_ROOT . '/xoa-san-pham?productType_id=' . $type['product_type_id']; ?>" 
                           class="action-btn delete" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="no-data">Không có sản phẩm nào</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php if($tst > 0): ?>
    <div class="pagination">
        <p>Trang
        <?php for($i = 1; $i <= $tst; $i++): ?>
            <?php if($page == $i): ?>
                <span class="pnow active"><?php echo $i; ?></span>
            <?php else: ?>
                <a href="<?php echo _WEB_ROOT . '/quan-ly-san-pham?page=' . $i; ?>" 
                   class="pnow">
                    <?php echo $i; ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?> </p>
    </div>
<?php endif; ?>

    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </main>
    <script>
document.getElementById('createProductBtn').addEventListener('click', function() {
    window.location.href = '<?php echo _WEB_ROOT . '/them-san-pham'; ?>';
});
</script>
<!-- Thông báo thêm vào giỏ hàng thành công -->
<?php if ($noti = Helpers::getFlash('notification')): ?>
<script>
Swal.fire({
    title: <?= $noti['type'] === 'success' ? "'Thành công!'" : "'Thất bại!'" ?>,
    text: decodeURIComponent("<?= rawurlencode($noti['message']) ?>"),
    icon: "<?= $noti['type'] ?>",
    confirmButtonText: "OK"
});
</script>
<?php endif; ?>
  </body>
</html>
