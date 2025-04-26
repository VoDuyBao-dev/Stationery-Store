<?php

class AdminOrderModel extends Model
{
    public function getAllTransport()
    {
        $sql = "SELECT * FROM transport";
        return $this->fetchAll($sql);
    }

    public function getAllOrders()
    {
        $sql = "SELECT  orders.*, users.fullname, transport.name AS transport_name
                FROM orders
                INNER JOIN users ON orders.user_id = users.user_id 
                INNER JOIN transport ON orders.transport_id = transport.transport_id 
                WHERE orders.trangThaiGiao != '3'
                ORDER BY orders.order_id ASC";

        return $this->fetchAll($sql);
    }

    public function getOrderById($order_id)
    {
        $sql = "SELECT distinct orders.*, users.fullname, transport.price
                FROM orders
                INNER JOIN users ON orders.user_id = users.user_id 
                INNER JOIN transport ON orders.transport_id = transport.transport_id 
                WHERE orders.order_id = ?";
        return $this->fetch($sql, [$order_id]);
    }

    public function getAllOrderById($order_id)
    {
        $sql = "SELECT order_details.*, orders.order_id, orders.total_price, orders.trangThaiGiao,
                       transport.price, product_type.name, product_type.priceCurrent
                FROM order_details 
                INNER JOIN orders ON order_details.order_id = orders.order_id
                INNER JOIN transport ON orders.transport_id = transport.transport_id 
                INNER JOIN product_type ON order_details.product_type_id = product_type.product_type_id 
                WHERE orders.order_id = ?";
        return $this->fetchAll($sql, [$order_id]);
    }

    public function getListOrdersDone()
    {
        $sql = "SELECT orders.*, users.fullname 
                FROM orders 
                INNER JOIN users ON orders.user_id = users.user_id 
                WHERE orders.trangThaiGiao = '3'
                ORDER BY orders.order_id ASC";
        return $this->fetchAll($sql);
    }

    public function getOrderDetailByProductTypeId($order_detail_id)
    {
        $sql = "SELECT order_details.*, orders.order_id, orders.total_price, orders.trangThaiGiao,
                       product_type.name, product_type.priceCurrent
                FROM order_details 
                INNER JOIN orders ON order_details.order_id = orders.order_id
                INNER JOIN product_type ON order_details.product_type_id = product_type.product_type_id 
                WHERE order_details.order_detail_id = ?";

        return $this->fetch($sql, [$order_detail_id]);
    }

    public function getAllProductType($order_detail_id)
    {
        $sql = "SELECT product_type.product_type_id, product_type.name, product_type.priceCurrent
                FROM product_type
                INNER JOIN products on product_type.product_id = products.product_id
                WHERE products.product_id = 
                (SELECT product_id FROM product_type WHERE product_type_id = 
                (SELECT product_type_id FROM order_details WHERE order_detail_id = ?))";
        return $this->fetchAll($sql, [$order_detail_id]);
    }



    public function getProductTypePrice($product_type_id)
    {
        $sql = "SELECT priceCurrent FROM product_type WHERE product_type_id = ?";
        return $this->fetch($sql, [$product_type_id]);
    }


    public function updateOrderDetail($data, $price, $productTypePrice)
    {
        $sql = "UPDATE order_details 
                SET product_type_id = ?, tenDonHang = ?, phone = ?, address = ?, ghiChu = ?, 
                    quantity = ?, cost = ?,  price = ?
                WHERE order_detail_id = ?";

        return $this->execute($sql, [
            $data['product_type_id'],
            $data['tenDonHang'],
            $data['phone'],
            $data['address'],
            $data['ghiChu'],
            $data['quantity'],
            $productTypePrice['priceCurrent'],
            $price,
            $data['order_detail_id']
        ]);
    }

    public function sum($order_id)
    {
        $sql = "SELECT SUM(order_details.price) AS price
                FROM order_details WHERE order_details.order_id = ?";
        return $this->fetch($sql, [$order_id]);
    }

    public function getCouppon($sum)
    {
        $sql = "SELECT max(coupon_id) as coupon_id from coupons where price_min < ?";
        return $this->fetch($sql, [$sum]);
    }

    public function setCoupon($order_id, $coupon_id)
    {
        $sql = "UPDATE orders SET coupon_id = ? WHERE order_id = ?";
        return $this->execute($sql, [$coupon_id, $order_id]);
    }

    public function getTotalPrice($order_id)
    {
        $sum = $this->sum($order_id);
        $couppon = $this->getCouppon($sum['price']);
        $this->setCoupon($order_id, $couppon['coupon_id']);
        $sql = "SELECT transport.price + ? * (SELECT (100 - (SELECT discount FROM coupons WHERE coupon_id = ?)) / 100) AS total_price 
                FROM orders
                INNER JOIN transport ON orders.transport_id = transport.transport_id 
		WHERE orders.order_id = ?";
        return $this->fetch($sql, [$sum['price'], $couppon['coupon_id'], $order_id]);
    }

    public function updateTotalPrice($order_id)
    {
        $total_price = $this->getTotalPrice($order_id);
        echo "đây là giá cuối cùng" . $total_price['total_price'] . "<br>";
        $sql = "UPDATE orders SET total_price = ? WHERE order_id = ?";
        return $this->execute($sql, [$total_price['total_price'], $order_id]);
    }


    public function xacNhanDonModel($order_id)
    {
        $sql = "UPDATE orders SET trangThaiGiao = ? WHERE order_id = ?";
        return $this->execute($sql, ['1', $order_id]);
    }


    // Sửa giá của phương thức vẫn chuyển trong chi tiết đơn hàng
    public function suaTransportModel($order_id, $transport_id)
    {
        $sql = "UPDATE orders SET transport_id = ?
                WHERE orders.order_id = ?";
        return $this->execute($sql, [$transport_id, $order_id]);
    }
    // tính lại tổng giá tiền ở bảng đơn hàng
    public function suaDonModel($transportOld, $total_price, $transport_id, $order_id)
    {
        $total = $total_price - $transportOld;
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE orders SET total_price = ? + ( select transport.price 
                FROM transport WHERE transport.transport_id = ?), 
                updated_at = ? 
                WHERE orders.order_id = ?";
        return $this->execute($sql, [$total, $transport_id, $date, $order_id]);
    }

    public function huyDonModel($order_id)
    {
        $sql = "UPDATE orders SET trangThaiGiao = ? WHERE order_id = ?";
        return $this->execute($sql, ['2', $order_id]);
    }

    public function xoaDonModel($order_id)
    {
        $sql = "DELETE FROM orders WHERE order_id = ?";
        $this->execute($sql, [$order_id]);
    }


    public function getOrderId($order_detail_id)
    {
        $sql = "SELECT order_id FROM order_details WHERE order_detail_id = ?";
        return $this->fetch($sql, [$order_detail_id]);
    }

    public function getAllDetailById($order_id)
    {
        $sql = "SELECT order_detail_id FROM order_details WHERE order_id = ?";
        return $this->fetchAll($sql, [$order_id]);
    }

    public function xoaChiTietModel($order_detail_id)
    {
        $sql = "DELETE FROM order_details WHERE order_detail_id = ?";
        $this->execute($sql, [$order_detail_id]);
    }
}
