<?php

class Capnhatsoluong extends Controller
{
   // Nhận post bên cart.js và đổi số lượng sản phẩm theo yêu cầu của khách hàng
// trả về đoạn html để js render thẳng luôn
public function capnhat_soluong()
{
    $product_type_id = $_POST['product_type_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['giohang'][$product_type_id])) {
        $_SESSION['giohang'][$product_type_id]['quantity'] = $quantity;
        $item = $_SESSION['giohang'][$product_type_id];

        $tt = $item['quantity'] * $item['priceCurrent'];

        // Tính lại tổng tiền toàn giỏ
        $tongtien = 0;
        $html_cart = '';
        foreach ($_SESSION['giohang'] as $item) {
         $tt = $item['quantity'] * $item['priceCurrent'];
         $tongtien += $tt;
     
         $html_cart .= '
             <div class="cart-item">
                 <img src="' . _WEB_ROOT . '/public/assets/clients/images/products/' . $item['image'] . '">
                 <div class="cart-item-info">
                     <p>' . $item['product_name'] . '</p>
                     <p><strong>' . $item['priceCurrent'] . '₫</strong></p>
                     <p><strong>' . $item['priceOld'] . '₫</strong></p>
                 </div>
                 <div class="cart-item-controls">
                     <button type="button" onclick="giamsoluong(this)">-</button>
                     <input type="text" value="' . $item['quantity'] . '" onkeyup="capNhatSoLuong(this)">
                     <button type="button" onclick="tangsoluong(this)">+</button>
                 </div>
                 <input type="hidden" value="' . $item['product_type_id'] . '" class="product-type-id">
                 <a href="' . _WEB_ROOT . '/deleteIdProduct_inCart/' . $item['product_name'] . '/' . $item['product_id'] . '/' . $item['product_type_id'] . '">❌</a>
             </div>
             <div class="cart-total">
                 <span>Thành tiền:</span>
                 <span>' . $tt . '₫</span>
             </div>';
     }

        ob_clean();
        echo json_encode([
            'html_cart' => $html_cart,
            'tongtien' => $tongtien
        ]);
    }
}


}




?>