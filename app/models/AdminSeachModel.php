<?php

class AdminSearchModel extends Model
{
    public function search($keyword)
    {
        $result = [
            'products' => [],
            'users' => [],
            'orders' => [],
            'coupons' => []
        ];

        $searchKey = '%' . $keyword . '%';

        // Tìm kiếm sản phẩm
        $sqlProduct = "SELECT product_id, name, price FROM products WHERE name LIKE ?";
        $result['products'] = $stmtProduct->fetchAll($sqlProduct, [$keyword]);

        // Tìm kiếm tài khoản người dùng
        $sqlUser = "SELECT user_id, fullname, email FROM users WHERE username LIKE ? OR email LIKE ?";
        $result['users'] = $stmtUser->fetchAll($sqlUser, [$keyword, $keyword]);

        // Tìm kiếm đơn hàng
        $sqlOrder = "SELECT order_id, order, user_id, status FROM orders WHERE order_id LIKE ?";
        $result['orders'] = $stmtOrder->fetchAll($sqlOrder, [$keyword]);

        // Tìm kiếm mã giảm giá
        $sqlCoupon = "SELECT id, code, discount_value FROM coupons WHERE code LIKE ?";
        $result['coupons'] = $stmtCoupon->fetchAll($sqlCoupon, [$keyword]);

        return $result;
    }
}
