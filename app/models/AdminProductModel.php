<?php

class AdminProductModel extends Model
{
    public function getAllOrders()
    {
        $sql = "SELECT MIN(order_details.transport_id) AS transport_id, users.fullname,
                       MIN(transport.name) AS transport_name, orders.*
                FROM orders
                INNER JOIN order_details ON order_details.order_id = orders.order_id
                INNER JOIN users ON orders.user_id = users.user_id 
                INNER JOIN transport ON order_details.transport_id = transport.transport_id 
                WHERE orders.trangThaiGiao != '3' 
                GROUP BY orders.order_id
                ORDER BY orders.order_id ASC";

        return $this->fetchAll($sql);
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

    public function getOrderById($order_id)
    {
        $sql = "SELECT order_details.*, orders.order_id, orders.total_price, orders.trangThaiGiao,
                       transport.price, product_type.name, product_type.priceCurrent
                FROM order_details 
                INNER JOIN orders ON order_details.order_id = orders.order_id
                INNER JOIN transport ON order_details.transport_id = transport.transport_id 
                INNER JOIN product_type ON order_details.product_type_id = product_type.product_type_id 
                WHERE orders.trangThaiGiao != '3' AND orders.order_id = ?";
        return $this->fetchAll($sql, [$order_id]);
    }

    public function deleteOrder()
    {
        $order_id = $_POST['order_id'] ?? null;
        if (!$order_id) {
            header('Location: ' . _BASE_URL . '/canxuly');
            exit;
        }
        $sql = "DELETE FROM orders WHERE order_id = ?";
        $this->execute($sql, [$order_id]);
        header('Location: ' . _BASE_URL . '/canxuly');
    }
}
