<?php

class Coupon extends Controller
{
    private $couponModel;

    public function __construct()
    {
        try {
            $this->couponModel = $this->model('CouponModel');  // tạo một object mới

            if (!$this->couponModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }

    // Hiển thị danh sách mã giảm giá
    public function khuyenmai()
    {
        $coupons = $this->couponModel->getAllCoupons();
        $this->render("admin/sales/sale",  ['coupons' => $coupons]);
    }


    // Lưu mã giảm giá mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if (!isset($_POST['price_min']) || !isset($_POST['discount']) || !isset($_POST['start_date']) || !isset($_POST['end_date']) || !isset($_POST['status'])) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if (!is_numeric($_POST['price_min']) || !is_numeric($_POST['discount'])) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['price_min'] < 0 || $_POST['discount'] < 0) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['start_date'] > $_POST['end_date']) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['status'] != 0 && $_POST['status'] != 1) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['discount'] > 100) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['price_min'] > 1000000000) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['start_date'] < date('Y-m-d H:i:s') || $_POST['end_date'] < date('Y-m-d H:i:s')) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        $data = [
            'price_min' => $_POST['price_min'],
            'discount' => $_POST['discount'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status'],
            'code' => $this->couponModel->randomString(6)
        ];
        $this->couponModel->addCoupon($data);
        header('Location: ' . _BASE_URL . '/sale');
    }

    public function show($id)
    {
        $id = $id[0];
        // Lấy dữ liệu coupon từ model
        $coupon = $this->couponModel->getCouponById($id);

        // Đảm bảo $coupon không phải là null hoặc không hợp lệ
        if ($coupon === null) {
            // Nếu không tìm thấy coupon, trả về lỗi 404 hoặc thông báo lỗi
            http_response_code(404);
            echo json_encode(['error' => 'Coupon not found']);
        } else {
            // Đặt header JSON trước khi trả về dữ liệu
            header('Content-Type: application/json');

            // Trả về dữ liệu JSON
            echo json_encode($coupon);
        }

        // Dừng thực thi tiếp theo
        exit();
    }


    // Cập nhật mã giảm giá
    public function update()
    {
        $coupon_id = $_POST['coupon_id'] ?? null;
        if (!$coupon_id) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if (!isset($_POST['price_min']) || !isset($_POST['discount']) || !isset($_POST['start_date']) || !isset($_POST['end_date']) || !isset($_POST['status'])) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if (!is_numeric($_POST['price_min']) || !is_numeric($_POST['discount'])) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['price_min'] < 0 || $_POST['discount'] < 0) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['start_date'] > $_POST['end_date']) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['status'] != 0 && $_POST['status'] != 1) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['discount'] > 100) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['price_min'] > 1000000000) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        if ($_POST['start_date'] < date('Y-m-d H:i:s') || $_POST['end_date'] < date('Y-m-d H:i:s')) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }

        $data = [
            'price_min' => $_POST['price_min'],
            'discount' => $_POST['discount'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status']
        ];
        $this->couponModel->updateCoupon($coupon_id, $data);
        header('Location: ' . _BASE_URL . '/sale');
    }

    // Xóa mã giảm giá
    public function destroy()
    {
        $coupon_id = $_POST['coupon_id'] ?? null;
        if (!$coupon_id) {
            header('Location: ' . _BASE_URL . '/sale');
            exit;
        }
        $this->couponModel->deleteCoupon($coupon_id);
        header('Location: ' . _BASE_URL . '/sale');
    }
}
