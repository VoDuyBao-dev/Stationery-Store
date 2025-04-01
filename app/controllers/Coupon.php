<?php

class CouponController extends Controller
{
    private $couponModel;

    public function __construct()
    {
        $this->couponModel = new CouponModel();
    }

    // Hiển thị danh sách mã giảm giá
    public function index()
    {
        $coupons = $this->couponModel->getAllCoupons();
        $this->render('admin/coupons/index', ['coupons' => $coupons]);
    }

    // Hiển thị form thêm mã giảm giá
    public function create()
    {
        $this->render('admin/coupons/create');
    }

    // Lưu mã giảm giá mới
    public function store()
    {
        $data = [
            'price_min' => $_POST['price_min'],
            'discount' => $_POST['discount'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status'],
            'code' => $_POST['code']
        ];
        $this->couponModel->addCoupon($data);
        header('Location: /admin/coupons');
    }

    // Hiển thị form chỉnh sửa mã giảm giá
    public function edit($id)
    {
        $coupon = $this->couponModel->getCouponById($id);
        $this->render('admin/coupons/edit', ['coupon' => $coupon]);
    }

    // Cập nhật mã giảm giá
    public function update($id)
    {
        $data = [
            'price_min' => $_POST['price_min'],
            'discount' => $_POST['discount'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status']
        ];
        $this->couponModel->updateCoupon($id, $data);
        header('Location: /admin/coupons');
    }

    // Xóa mã giảm giá
    public function destroy($id)
    {
        $this->couponModel->deleteCoupon($id);
        header('Location: /admin/coupons');
    }
}

?>
s