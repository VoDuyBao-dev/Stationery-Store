<?php
require_once _DIR_ROOT . '/app/models/OrderDetailModel.php';
require_once _DIR_ROOT . '/app/models/OrderModel.php';


class OrderService
{
    public function processOrder($paymentMethod, $postData, $payment_id){
        $cart = $_SESSION['giohang'] ?? [];
        
        // tổng tiền
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['priceCurrent'] * $item['quantity'];
        }

        // Lưu thông tin đơn hàng
        $user_id = $_SESSION['user']['user_id'];
        $orderModel = new OrderModel();
        $order_id = $orderModel->createOrder($user_id, $totalPrice, $paymentMethod, $payment_id);

        if(!is_numeric($order_id)){
            return [
                'success' => false,
                'message' => $order_id
            ];
        }

        // Lưu chi tiết đơn hàng
        $fullname = $postData['fullname'];
        $phone = $postData['phone'];
        $address = $postData['province'] . ' - ' . $postData['district'] . ' - ' . $postData['ward']. ' - ' . $postData['address_detail'];
        $ghichu = $postData['note'];

        $orderDetailModel = new OrderDetailModel();
        foreach ($cart as $item) {
            $result = $orderDetailModel->createOrderDetail(
                $order_id,
                $item['product_type_id'],
                $item['name_product_type_id'],
                $fullname,
                $phone,
                $address,
                $ghichu,
                $item['priceCurrent'],
                $item['quantity'],
                $postData['shipping'],
                $item['priceCurrent'] * $item['quantity']
            );
            
            if ($result !== true) {
                return [
                    'success' => false,
                    'message' => "Lưu chi tiết đơn hàng thất bại!"
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