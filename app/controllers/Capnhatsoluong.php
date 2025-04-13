<?php

class Capnhatsoluong extends Controller
{
    public function capnhat_soluong()
    {
        if (!isset($_POST['product_type_id']) || !isset($_POST['quantity'])) {
            echo json_encode(['error' => 'Dữ liệu không hợp lệ']);
            exit;
        }

        $product_type_id = $_POST['product_type_id'];
        $quantity = (int)$_POST['quantity'];

        if (!isset($_SESSION['giohang'][$product_type_id])) {
            echo json_encode(['error' => 'Sản phẩm không tồn tại trong giỏ hàng']);
            exit;
        }

        // Cập nhật số lượng
        $_SESSION['giohang'][$product_type_id]['quantity'] = $quantity;

        // Tính lại tổng tiền
        $tongtien = 0;
        $html_cart = '';

        foreach ($_SESSION['giohang'] as $item) {
            $thanhtien = $item['quantity'] * $item['priceCurrent'];
            $tongtien += $thanhtien;

            // HTML cho mỗi item
            $html_cart .= '
            <div class="cart-item">
                <img src="' . _WEB_ROOT . '/public/assets/clients/images/products/' . htmlspecialchars($item['image']) . '" 
                     alt="' . htmlspecialchars($item['product_type_id']) . '">
                <div class="cart-item-info">
                    <p>' . htmlspecialchars($item['product_name']) . '</p>
                    <p><strong>' . htmlspecialchars($item['name_product_type_id']) . '</strong></p>
                    <p><strong>' . number_format((float)$item['priceCurrent']) . '₫</strong></p>
                    <p><strong>' . number_format((float)$item['priceOld']) . '₫</strong></p>
                </div>
                <div class="cart-item-controls">
                    <button type="button" onclick="giamsoluong(this)">-</button>
                    <input type="text" value="' . (int)$item['quantity'] . '" onkeyup="validateQuantity(this)">
                    <button type="button" onclick="tangsoluong(this)">+</button>
                </div>
                <input type="hidden" value="' . htmlspecialchars($item['product_type_id']) . '" class="product-type-id">
                <a href="' . _WEB_ROOT . '/deleteIdProduct_inCart/' . 
                    urlencode($item['product_name']) . '/' . 
                    (int)$item['product_id'] . '/' . 
                    urlencode($item['product_type_id']) . '">❌</a>
            </div>
            <div class="cart-total">
                <span>Thành tiền:</span>
                <span>' . number_format((float)$thanhtien) . '₫</span>
            </div>';
        }

        ob_clean();
        echo json_encode([
            'success' => true,
            'html_cart' => $html_cart,
            'tongtien' => $tongtien
        ]);
        exit;
    }
}