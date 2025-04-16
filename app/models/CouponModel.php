<?php
class CouponModel extends Model
{
    private $_table = 'coupons';

    public function getAvailableCoupon($totalAmount) {
        $sql = "SELECT * FROM coupons 
                WHERE price_min <= ? 
                AND status = '1'
                AND start_date <= NOW() 
                AND end_date >= NOW()
                ORDER BY discount DESC 
                LIMIT 1";
        $params = [$totalAmount];
        $result = $this->fetch($sql, $params);
        return $result;
        
    }
    
}

?>