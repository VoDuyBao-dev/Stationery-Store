<?php

class AdminSearchModel extends Model
{
    public function search($query)
    {
        $query = '%' . $query . '%';

        $sql = "(
            SELECT 'product' AS type, product_id AS id, name AS title FROM products WHERE name LIKE ?
        ) UNION (
            SELECT 'coupon' AS type, coupon_id AS id, code AS title FROM coupons WHERE code LIKE ?
        ) UNION (
            SELECT 'user' AS type, user_id AS id, username AS title FROM users WHERE username LIKE ?
        ) UNION (
            SELECT 'order' AS type, order_id AS id, CONCAT('Order #', order_id) AS title FROM orders WHERE order_id LIKE ?
        )";

        return $this->query($sql, [$query, $query, $query, $query]);
    }
}
