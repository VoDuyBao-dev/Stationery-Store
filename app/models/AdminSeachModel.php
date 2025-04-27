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
        $result['products'] = $this->fetchAll($sqlProduct, [$keyword]);

        // Tìm kiếm tài khoản người dùng
        $sqlUser = "SELECT user_id, fullname, email FROM users WHERE fullname LIKE ? OR email LIKE ?";
        $result['users'] = $this->fetchAll($sqlUser, [$keyword, $keyword]);

        // Tìm kiếm đơn hàng
        $sqlOrder = "SELECT order_id, order, user_id, status FROM orders WHERE order_id LIKE ?";
        $result['orders'] = $this->fetchAll($sqlOrder, [$keyword]);

        // Tìm kiếm mã giảm giá
        $sqlCoupon = "SELECT coupon_id, code, discount_value FROM coupons WHERE code LIKE ?";
        $result['coupons'] = $this->fetchAll($sqlCoupon, [$keyword]);

        return $result;
    }
}
