<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
        }
        .cart-container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: left;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .cart-item-info {
            flex-grow: 1;
        }
        .cart-item-controls {
            display: flex;
            align-items: center;
        }
        .cart-item-controls button {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            background-color: #ddd;
            margin: 0 5px;
        }
        .cart-item-controls button:hover {
            background-color: #bbb;
        }
        .cart-total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            padding: 20px 0;
        }
        #checkout-btn, #clear-cart-btn {
            width: 100%;
            padding: 10px;
            background-color: #1a73e8;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
        }
        #checkout-btn:hover, #clear-cart-btn:hover {
            background-color: #135abc;
        }
        #clear-cart-btn {
            background-color: #d9534f;
        }
    </style>
    <script>
        const _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
       
    </script>
   <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/products/cart.js"></script>
</head>
<body>
    
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
            <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/products/<?= $item['image'];?>" alt="Túi 02 Ruột bút gel Buddies Thiên Long GR-028">
            <div class="cart-item-info">
                <p><?= $item['product_name']?></p>
                <p><strong><?= $item['name_product_type_id']?></strong></p>
                <p><strong><?= $item['priceCurrent']?>0₫</strong></p>
                <p><strong><?= $item['priceOld']?>0₫</strong></p>
            </div>
            <div class="cart-item-controls">
                <button type="button" onclick="giamsoluong(this)">-</button>
                <input type="text" value="<?= $item['quantity'] ?>" onkeyup="kiemtrasoluong(this)" >
                <button type="button" onclick="tangsoluong(this)">+</button>
            </div>
            <input type="hidden" value="<?= $item['product_type_id']?>" class="product-type-id">
            <a href="<?= _WEB_ROOT."/deleteIdProduct_inCart/".$item['product_name']."/".$item['product_id']."/".$item['product_type_id']?>">❌</a>
        </div>
            
            <div class="cart-total">
            <span>thành tiền:</span>
            <span><?= $tt;?>₫</span>

        </div>

       
        <?php endforeach;?>
        <?php endif;?>
        </div>

        <div >
            <span>Tổng tiền:</span>
            <span id="tong-tien"><?= $tongtien;?>₫</span>
        </div>
       
       
       
        <form action="<?= _WEB_ROOT."/thanh-toan"?>" method="GET">
         <button id="checkout-btn" >Tiến hành đặt hàng</button>
        </form>
        
        <form action="<?= _WEB_ROOT ?>/deleteAll_cart" method="POST">
                 <button id="clear-cart-btn" name="deleteAll_cart">Xóa toàn bộ giỏ hàng</button>
                </form>
        
    </div>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
  
    
</body>
</html>

<!-- Tới đoạn gửi jq đến backend rồirồi phút thứ 29 -->