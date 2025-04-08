<?php
require_once _DIR_ROOT . '/app/models/OrderDetailModel.php';
require_once _DIR_ROOT . '/app/models/OrderModel.php';


class OrderService
{
    public function processOrder($paymentMethod, $postData){
       
        $cart = $_SESSION['giohang'] ?? [];
        if(empty($cart)) {
            ob_clean();
            return ['success' => false, 'message' => 'Giỏ hàng trống!'];
        }
        // tổng tiền
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['priceCurrent'] * $item['quantity'];
        }

        // Lưu thông tin đơn hàng vào cơ sở dữ liệu
        $user_id = $_SESSION['user']['user_id'];
        $payment_method = $paymentMethod;
       
        $orderModel = new OrderModel();
        var_dump($orderModel);
        // order_id
        $order_id = $orderModel->createOrder($user_id, $totalPrice, $payment_method);

        if(!is_numeric($order_id)){
            ob_clean();
            return ['success' => false, 'message' => $order_id]; // trả về thông báo lỗi
        }

      
        $fullname = $postData['fullname'];
        $phone = $postData['phone'];
        $address = $postData['province'] . ' - ' . $postData['district'] . ' - ' . $postData['ward']. ' - ' . $postData['address_detail'];
        $ghichu = $postData['note'];
       


        // Lưu chi tiết đơn hàng
        $orderDetailModel = new OrderDetailModel();
        foreach ($cart as $item) {
            $resul = $orderDetailModel->createOrderDetail(
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
            if ($resul !== true) {
                ob_clean();
                return ['success' => false, 'message' => 'Lưu chi tiết đơn hàng thất bại!'];
            }
        }


        unset($_SESSION['giohang']);
        ob_clean();
        return ['success' => true, 'message' => 'Đặt hàng thành công! và orderID: '. $order_id];
    }

}
?>