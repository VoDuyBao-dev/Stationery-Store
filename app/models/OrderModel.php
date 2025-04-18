
<?php

class OrderModel extends Model
{
    
    private $_table_orders = 'orders';
    

    public function createOrder($user_id, $total_price,$payment_method, $payment_id, $coupon_id, $transport_id)
    {
       

        $sql = "INSERT INTO $this->_table_orders (user_id, total_price, payment_method, payment_id, coupon_id, transport_id) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [$user_id, $total_price, $payment_method, $payment_id, $coupon_id, $transport_id];
        
        try{
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return $this->getInsertId();//tra về id của order vừa tạo
            } else {
                return "Tạo order thất bại!";
            }
        }catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
        
        
    }
}
?>