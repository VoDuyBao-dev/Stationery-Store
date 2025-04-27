<?php

class AdminSeachModel extends Model
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
        $sqlProduct = "SELECT products.product_id, products.name from products WHERE products.name LIKE ? or  products.product_id LIKE ? limit 10";
        $result['products'] = $this->fetchAll($sqlProduct, [$searchKey, $searchKey]);


        // Tìm kiếm tài khoản người dùng
        $sqlUser = "SELECT user_id, fullname, email FROM users WHERE fullname LIKE ? OR email LIKE ?";
        $result['users'] = $this->fetchAll($sqlUser, [$searchKey, $searchKey]);

        // Tìm kiếm đơn hàng
        $sqlOrder = "SELECT order_id, total_price, trangThaiGiao FROM orders WHERE order_id LIKE ?";
        $result['orders'] = $this->fetchAll($sqlOrder, [$searchKey]);

        // Tìm kiếm mã giảm giá
        $sqlCoupon = "SELECT coupon_id, code, discount FROM coupons WHERE code LIKE ?";
        $result['coupons'] = $this->fetchAll($sqlCoupon, [$searchKey]);

        return $result;
    }
}
