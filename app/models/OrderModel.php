
<?php

class OrderModel extends Model
{
    
    private $_table_orders = 'orders';
    

    public function createOrder($user_id, $total_price,$payment_method, $payment_id, $coupon_id, $is_paid, $transport_id)
    {
       

        $sql = "INSERT INTO $this->_table_orders (user_id, total_price, payment_method, payment_id, coupon_id, is_paid, transport_id) VALUES (?, ?, ?, ?, ?, ?,?)";
        $params = [$user_id, $total_price, $payment_method, $payment_id, $coupon_id, $is_paid, $transport_id];
        
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

    public function getRevenueByType($type) {
        $query = "SELECT DATE(created_at) as date, SUM(total_price) as revenue FROM orders WHERE ";
        
        switch($type) {
            case 'today':
                $query .= "DATE(created_at) = CURDATE()
                          GROUP BY DATE(created_at)";
                break;
                
            case 'yesterday':
                $query .= "DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                          GROUP BY DATE(created_at)";
                break;
                
            case '7days':
                $query .= "created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                        AND created_at < DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                        GROUP BY DATE(created_at)
                        ORDER BY date ASC";
                break;
                
            case 'thisMonth':
                $query .= "YEAR(created_at) = YEAR(CURDATE()) 
                          AND MONTH(created_at) = MONTH(CURDATE())
                          GROUP BY DATE(created_at)
                          ORDER BY date ASC";
                break;
                
            case 'thisQuarter':
                $query .= "YEAR(created_at) = YEAR(CURDATE())
                          AND QUARTER(created_at) = QUARTER(CURDATE())
                          GROUP BY DATE(created_at)
                          ORDER BY date ASC";
                break;
                
            case 'thisYear':
                $query .= "YEAR(created_at) = YEAR(CURDATE())
                          GROUP BY MONTH(created_at)
                          ORDER BY MONTH(created_at) ASC";
                break;
        }
        
        // return $this->query($query);
        return $this->fetchAll($query);
    }

    public function getRevenueByDateRange($fromDate, $toDate) {
        $query = "SELECT DATE(created_at) as date, 
                         SUM(total_price) as revenue
                  FROM orders 
                  WHERE DATE(created_at) BETWEEN ? AND ?
                  GROUP BY DATE(created_at)
                  ORDER BY date ASC";
                 
        $params = [$fromDate, $toDate];
        return $this->fetchAll($query, $params);
    }
}
?>