<?php
require_once _DIR_ROOT . '/app/models/OrderDetailModel.php';
require_once _DIR_ROOT . '/app/models/OrderModel.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';

class OrderService
{
    public function processOrder($paymentMethod, $postData, $payment_id){
        $cart = $_SESSION['giohang'] ?? [];
        
        // tổng tiền
        $totalPrice = $_SESSION['finalTotal'] ?? 0;
        unset($_SESSION['finalTotal']);
        // Lưu thông tin đơn hàng
        $user_id = $_SESSION['user']['user_id'];
        $coupon_id = $_SESSION['coupon_id'] ?? null;
        unset($_SESSION['coupon_id']);
        $orderModel = new OrderModel();
        $order_id = $orderModel->createOrder($user_id, $totalPrice, $paymentMethod, $payment_id, $coupon_id, $postData['shipping']);

        if(!is_numeric($order_id)){
            return [
                'success' => false,
                'message' => $order_id
            ];
        }

        // Lưu chi tiết đơn hàng và cập nhật số lượng món hàng trong kho
        $phone = $postData['phone'];
        $address = $postData['province'] . ' - ' . $postData['district'] . ' - ' . $postData['ward']. ' - ' . $postData['address_detail'];
        $ghichu = $postData['note'];

        $orderDetailModel = new OrderDetailModel();
        $productModel = new ProductModel();
        $stockQuantityOf_allProducts = $productModel->stockQuantityOf_allProducts();
        // Chuyển thành các key => value để đối chiếu
        $allStock = [];
        foreach ($stockQuantityOf_allProducts as $item) {
            $allStock[$item['product_type_id']] = $item['stock_quantity'];
        }

        foreach ($cart as $item) {
            $result = $orderDetailModel->createOrderDetail(
                $order_id,
                $item['product_type_id'],
                $item['name_product_type_id'],
                $phone,
                $address,
                $ghichu,
                $item['priceCurrent'],
                $item['quantity'],
                $item['priceCurrent'] * $item['quantity']
            );
            
            if ($result !== true) {
                return [
                    'success' => false,
                    'message' => "Lưu chi tiết đơn hàng thất bại!"
                ];
            }

            // xử lí hàng tồn kho
            $typeId = $item['product_type_id'];
            $currentStock = $allStock[$typeId]; // Lấy tồn kho hiện tại
            $newStock = $currentStock - $item['quantity'];

            // Cập nhật vào DB
            $updateQuantity= $productModel->updateQuantity($newStock,$typeId);
            if ($updateQuantity !== true) {
                return [
                    'success' => false,
                    'message' => $updateQuantity
                ];
            }
        }

        unset($_SESSION['giohang']);

        return [
            'success' => true,
            'message' => "Đặt hàng thành công. Cảm ơn bạn đã mua hàng"
        ];
    }

}
?>