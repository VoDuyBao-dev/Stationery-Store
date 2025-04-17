<?php

class OrderDetailModel extends Model
{
    
    private $_table_orderDetails = 'order_details';

    public function createOrderDetail($order_id, $product_type_id,$tenDonHang,$phone,$address,$ghiChu,$cost, $quantity, $price)
    {
        $sql = "INSERT INTO $this->_table_orderDetails (order_id, product_type_id,tenDonHang,phone,address,ghiChu,cost, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [$order_id, $product_type_id,$tenDonHang,$phone,$address,$ghiChu,$cost, $quantity, $price];
        
        try{
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            } else {
                return false;
            }
        }catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
       
       
    }
}
?>