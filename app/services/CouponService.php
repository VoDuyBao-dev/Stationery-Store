<?php
require_once _DIR_ROOT . '/app/models/CouponModel.php';

class CouponService
{
    private $couponModel;

    public function __construct()
    {
        $this->couponModel = new CouponModel();
    }

    public function getCoupon($totalAmount) {
        return $this->couponModel->getAvailableCoupon($totalAmount);
    }

}