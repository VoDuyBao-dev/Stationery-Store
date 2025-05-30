<?php

class CouponModel extends Model
{
    protected $table = 'coupons';

    // Lấy danh sách mã giảm giá
    public function getAllCoupons()
    {
        return $this->fetchAll("SELECT * FROM $this->table ORDER BY end_date DESC");
    }

    // Lấy thông tin mã giảm giá theo ID
    public function getCouponById($id)
    {
        return $this->fetch("SELECT * FROM $this->table WHERE coupon_id = ?", [$id]);
    }

    // Thêm mã giảm giá mới
    public function addCoupon($data)
    {
        $sql = "INSERT INTO $this->table (price_min, discount, start_date, end_date, status, code) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->execute($sql, array_values($data));
    }

    // Cập nhật mã giảm giá
    public function updateCoupon($id, $data)
    {
        // print_r(array_merge(array_values($data), [$id]));
        $sql = "UPDATE $this->table SET code = ?,  price_min=?, discount=?, start_date=?, end_date=?, status=? WHERE coupon_id=?";
        return $this->execute($sql, array_merge(array_values($data), [$id]));
    }

    // Xóa mã giảm giá
    public function deleteCoupon($id)
    {
        return $this->execute("DELETE FROM $this->table WHERE coupon_id = ?", [$id]);
    }

    // code cho mã giảm giá
    public function randomString($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $s = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $s .= $characters[random_int(0, $maxIndex)];
        }

        return $s;
    }

    // lấy mã giảm giá phù hợp với tổng tiền bên payment
    public function getAvailableCoupon($totalAmount)
    {
        $sql = "SELECT discount
FROM coupons
WHERE 
    price_min <= ?  -- tổng giá đơn hàng
    AND CURRENT_DATE BETWEEN DATE(start_date) AND DATE(end_date)
    AND status = '1'
ORDER BY discount DESC
LIMIT 1";
        return $this->fetch($sql, [$totalAmount]);
    }
}
