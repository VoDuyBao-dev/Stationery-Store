<?php
use core\Helpers;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/products/ProductCategory.css">
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
        #loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease-in-out;
}

.loader img {
  width: 80px;
  animation: pulse 1.2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 0.7; }
  50% { transform: scale(1.1); opacity: 1; }
  100% { transform: scale(1); opacity: 0.7; }
}

    </style>
    <script>
      function viewProduct(product_name ,id_product, id_product_type) {
        window.location.href = "thong-tin-sp/" + encodeURIComponent(product_name) +'/'+ id_product +'/' + id_product_type;
      }
    </script>
    <script>
  window.addEventListener("load", function () {
    const loader = document.getElementById("loader-wrapper");
    loader.style.opacity = "0";
    setTimeout(() => {
      loader.style.display = "none";
    }, 500);
  });
</script>


</head>

<body>
    <!-- Loader -->
<div id="loader-wrapper">
  <div class="loader">
    <img src="<?php echo _WEB_ROOT; ?> /public/assets/clients/images/logo.png" alt="Loading..." />
  </div>
</div>

<header><?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?></header>
<menu><?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?></menu>
<main>
    <div class="container">
        <div class="filter-container">
            <span>Sắp xếp:</span>
            <a href="<?php echo _WEB_ROOT; ?>/productByCategory?category=<?php echo urlencode($getCategory); ?>&sub=<?php echo urlencode($subProduct); ?>&sort=name-asc" 
               class="filter-button <?= ($_GET['sort'] ?? '') === 'name-asc' ? 'active' : '' ?>">
               Tên A → Z
            </a>
            <a href="<?php echo _WEB_ROOT; ?>/productByCategory?category=<?php echo urlencode($getCategory); ?>&sub=<?php echo urlencode($subProduct); ?>&sort=name-desc" 
               class="filter-button <?= ($_GET['sort'] ?? '') === 'name-desc' ? 'active' : '' ?>">
               Tên Z → A
            </a>
            <a href="<?php echo _WEB_ROOT; ?>/productByCategory?category=<?php echo urlencode($getCategory); ?>&sub=<?php echo urlencode($subProduct); ?>&sort=price-asc" 
               class="filter-button <?= ($_GET['sort'] ?? '') === 'price-asc' ? 'active' : '' ?>">
               Giá tăng dần
            </a>
            <a href="<?php echo _WEB_ROOT; ?>/productByCategory?category=<?php echo urlencode($getCategory); ?>&sub=<?php echo urlencode($subProduct); ?>&sort=price-desc" 
               class="filter-button <?= ($_GET['sort'] ?? '') === 'price-desc' ? 'active' : '' ?>">
               Giá giảm dần
            </a>
            <a href="<?php echo _WEB_ROOT; ?>/productByCategory?category=<?php echo urlencode($getCategory); ?>&sub=<?php echo urlencode($subProduct); ?>&sort=newest" 
               class="filter-button <?= ($_GET['sort'] ?? '') === 'newest' ? 'active' : '' ?>">
               Hàng mới
            </a>
        </div>
        
        <div class="product-list">
        <?php if ($message = Helpers::getFlash('error')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>

            <?php if(count($allProduct)> 0) :?>
                <?php foreach($allProduct as $product):?>
            <div class="product">
            
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $product['image'];?>" alt="<?= $product['image'];?>">
                <p class="name"><?= $product['product_name']?></p>
                
                <p class="price"><span class="new"><?= Helpers::format_currency($product['priceCurrent']); ?></span> <span class="old"><?= Helpers::format_currency($product['priceOld']); ?></span></p>
                <button class="btn" onclick="viewProduct('<?= $product['product_name'] ?>',<?= $product['product_id'] ?>,<?= $product['product_type_id'] ?> )">Tùy chọn</button>
            </div>
            <?php endforeach;?>
            <?php else:?>
              <h2>Rất tiếc, sản phẩm không tồn tại!</h2>
              <p>Hãy thử tìm kiếm sản phẩm khác hoặc quay về trang chủ </p>
              <?php endif;?>

            
        </div>
        </div>
        <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>

    
    </main>
</body>
</html>