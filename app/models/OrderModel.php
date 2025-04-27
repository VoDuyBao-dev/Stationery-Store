
<?php

use App\Logger;

class OrderModel extends Model
{

    private $_table_orders = 'orders';


    public function createOrder($user_id, $total_price, $payment_method, $payment_id, $coupon_id, $is_paid, $transport_id)
    {


        $sql = "INSERT INTO $this->_table_orders (user_id, total_price, payment_method, payment_id, coupon_id, is_paid, transport_id) VALUES (?, ?, ?, ?, ?, ?,?)";
        $params = [$user_id, $total_price, $payment_method, $payment_id, $coupon_id, $is_paid, $transport_id];

        try {
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return $this->getInsertId(); //tra về id của order vừa tạo
            } else {
                return "Tạo order thất bại!";
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
    }

    public function getOrdersByUserId($user_id)
    {
        $query = "SELECT o.order_id, o.created_at, o.total_price, o.payment_method , o.trangThaiGiao, t.name as transport_name
            from orders o
            join transport t
            on o.transport_id = t.transport_id
            where o.user_id = ?
            order by o.created_at desc";
        $params = [$user_id];
        return $this->fetchAll($query, $params);
    }

    // lấy trạng thái của đơn hàng có id chỉ định
    public function getStatusOrderById($order_id)
    {
        $query = "SELECT trangThaiGiao from orders where order_id = ?";
        $params = [$order_id];
        return $this->fetch($query, $params);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $sql = "UPDATE orders SET trangThaiGiao = ?
                WHERE order_id = ?";
        $params = [(string)$status, $order_id];
        try {
            return $this->execute($sql, $params) > 0;
        } catch (Exception $e) {
            Logger::logError("Lỗi khi cập nhật trạng thái đơn hàng: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderById($order_id)
    {
        $query = "SELECT o.order_id, o.created_at, o.total_price, o.payment_method , o.trangThaiGiao, t.name as transport_name
            from orders o
            join transport t
            on o.transport_id = t.transport_id
            where o.order_id = ?";
        $params = [$order_id];
        return $this->fetch($query, $params);
    }

    // đơn hàng người dùng sử dụng lọc theo ngày
    public function getOrdersByDateRange($user_id, $fromDate, $toDate)
    {
        $query = "SELECT o.order_id, o.created_at, o.total_price, o.payment_method , o.trangThaiGiao, t.name as transport_name
            FROM orders o
            JOIN transport t
            ON o.transport_id = t.transport_id
            WHERE o.user_id = ?
            AND DATE(o.created_at) BETWEEN ? AND ?
            ORDER BY o.created_at DESC";
        $params = [$user_id, $fromDate, $toDate];
        return $this->fetchAll($query, $params);
    }



    public function getRevenueByType($type)
    {
        $query = "SELECT DATE(created_at) as date, SUM(total_price) as revenue FROM orders WHERE ";

        switch ($type) {
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

    public function getRevenueByDateRange($fromDate, $toDate)
    {
        $query = "SELECT DATE(created_at) as date, 
                         SUM(total_price) as revenue
                  FROM orders 
                  WHERE DATE(created_at) BETWEEN ? AND ?
                  GROUP BY DATE(created_at)
                  ORDER BY date ASC";

        $params = [$fromDate, $toDate];
        return $this->fetchAll($query, $params);
    }


    public function getProductID($order_id){
        $sql = "select product_type.product_id as product_id
                from order_details
                inner join product_type on order_details.product_type_id = product_type.product_type_id
                where order_details.order_id = ? limit 1";
        return $this->fetch($sql, [$order_id]);
    }

    public function insertReview($product_id, $user_id, $rating, $comment)
    {
        $sql = "INSERT INTO reviews (product_id, user_id, rating, comment, created_at) 
                VALUES (?, ? ,?, ?, NOW())";

        return $this->execute($sql, [$product_id, $user_id, $rating, $comment]);
    }
}
?>