<?php
use core\Helpers;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
   
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/products/giohang.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <script>
        const _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
       
    </script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/products/cart.js"></script>
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
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
  </header>  

  <menu>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php";?>
  </menu> 
  <main>
    <div class="cart-container">
        <h2>Giỏ hàng</h2>
        
            <!-- san pham -->
            <div id="cart">
         <?php $tongtien = 0;?>
         <?php if(count($_SESSION['giohang']) > 0):?>
        <?php foreach($_SESSION['giohang'] as $item):
            $tt = $item['quantity']* $item['priceCurrent'];
            $tongtien += $tt;?>
          
            <div class="cart-item">
            <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $item['image'];?>" alt="<?= $item['product_name']?>">
            <div class="cart-item-info">
                <p><?= $item['product_name']?></p>
                <p><strong><?= $item['name_product_type_id']?></strong></p>
                
                <p><strong><?= Helpers::format_currency($item['priceCurrent']); ?></strong></p>
                <p><strong><?= Helpers::format_currency($item['priceOld']); ?></strong></p>
            </div>
            <div class="cart-item-controls">
                <button type="button" onclick="giamsoluong(this)">-</button>
                <input type="text" value="<?= $item['quantity'] ?>" onkeyup="validateQuantity(this)" >
                <button type="button" onclick="tangsoluong(this)">+</button>
            </div>
            <input type="hidden" value="<?= $item['product_type_id']?>" class="product-type-id">
            <a href="<?= _WEB_ROOT."/deleteIdProduct_inCart/".$item['product_name']."/".$item['product_id']."/".$item['product_type_id']?>">❌</a>
        </div>
            
            <div class="cart-total">
            <span>thành tiền:</span>
            <span><?= Helpers::format_currency($tt); ?></span>

        </div>

       
        <?php endforeach;?>
        <?php endif;?>
        </div>

        <div  class="total">
            <span>Tổng tiền:</span>
            <span id="tong-tien"><?= Helpers::format_currency($tongtien); ?></span>
        </div>
       
       
       <div class="setbutton">
        <form action="<?= _WEB_ROOT."/thanh-toan"?>" method="GET">
         <button id="checkout-btn" >Đặt hàng</button>
        </form>
        
        <form action="<?= _WEB_ROOT ?>/deleteAll_cart" method="POST">
                 <button id="clear-cart-btn" name="deleteAll_cart">Xóa toàn bộ giỏ hàng</button>
                </form>
        </div>

    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</main>  
    
</body>
</html>

