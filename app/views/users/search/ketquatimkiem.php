<!DOCTYPE html>
<html lang="vi">

<?php $breadcrumb = "Kết quả tìm kiếm cho - ".$_GET['keyword'] ?? ""; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/search/ketquatimkiem.css"/>
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
    </script>
</head>
<body>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>   

    <?php require_once _DIR_ROOT . "/app/views/blocks/menu.php";?>
    <div class="search-container">
    
        <?php if(empty($getProduct_Search)):?>
            <div class="not-found-container">
        <h2>Rất tiếc, sản phẩm bạn tìm kiếm không tồn tại!</h2>
        <p>Hãy thử tìm kiếm sản phẩm khác hoặc quay về trang chủ </p>
    </div>
            <?php else:?>
        <h3>Tìm thấy <?php count($getProduct_Search)?> kết quả với từ khóa "<?= $_GET['keyword'] ?? ""?>"</h3>
        
        <div class="product-list">
        <?php foreach($getProduct_Search as $product):?>
            <div class="product">
            <div class="sale-tag"><p>Sale <br> <?=$product['discount_price']?>%</p></div>
                <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/image_products_type/<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>">
                <p class="name"><?= $product['product_name'] ?></p>
                <p class="price"><span class="new"><?= $product['priceCurrent'] ?>đ</span> <span class="old"><?= $product['priceOld'] ?>đ</span></p>
                <button class="btn" onclick="viewProduct('<?= $product['product_name'] ?>',<?= $product['product_id'] ?>,<?= $product['product_type_id'] ?> )">Xem ngay</button>
            </div>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
    </div>
</body>
</html>
