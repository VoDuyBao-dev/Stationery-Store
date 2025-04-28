<?php

class Order extends Controller
{
    private $OrderModel;
    public $data = [];

    public function __construct()
    {
        try {
            $this->OrderModel = $this->model('OrderModel');

            if (!$this->OrderModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }

    // danh sách đơn hàng
    public function orderList()
    {
        $this->validateUser();
        $user_id = $_SESSION['user']['user_id'];
        // lay danh sách đơn hàng của người dùng
        // Nếu người dùng sài lọc thì hiển thị các đơn hàng trong khoảng tg đó
        $fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : null;
        $toDate = isset($_GET['to_date']) ? $_GET['to_date'] : null;

        if ($fromDate && $toDate) {
            $order_list = $this->OrderModel->getOrdersByDateRange($user_id, $fromDate, $toDate);
        } else {
            $order_list = $this->OrderModel->getOrdersByUserId($user_id);
        }

        $data = [
            'order_list' => $order_list,
        ];

        $this->render("users/order/order_list", $data);
    }

    // đơn hàng người dùng tìm kiêms
    public function searchOrder()
    {
        $this->validateUser();
        $orderId = isset($_GET['order_id']) ? trim($_GET['order_id']) : '';

        if (empty($orderId)) {
            header("Location: " . _WEB_ROOT . "/danh-sach-don-hang");
            exit;
        }

        $order = $this->OrderModel->getOrderById($orderId);

        $data = [
            'order_list' => $order ? [$order] : [],

        ];

        $this->render("users/order/order_list", $data);
    }

    
    // Hủy đơn hàng khi còn ở trạng thái đang xử lý
    public function cancelOrder()
    {
        $this->validateUser();
        $data = json_decode(file_get_contents('php://input'), true);
        $orderId = $data['order_id'] ?? null;

        if (!$orderId) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu thông tin đơn hàng'
            ]);
            return;
        }

        // Kiểm tra trạng thái đơn hàng
        $order = $this->OrderModel->getStatusOrderById($orderId);
        if (!$order || $order['trangThaiGiao'] != 0) {
            echo json_encode(['success' => false, 'message' => 'Không thể hủy đơn hàng này']);
            return;
        }

        // Cập nhật trạng thái đơn hàng thành đã hủy
        $result = $this->OrderModel->updateOrderStatus($orderId, 2);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Hủy đơn hàng thành công' : 'Có lỗi xảy ra'
        ]);
    }



    // Thêm đanhs giá

    public function addReview()
    {
        $this->validateUser();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
            $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
            $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
            $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

            // Kiểm tra dữ liệu hợp lệ
            if ($order_id > 0 && $user_id > 0 && $rating > 0 && $rating <= 5 && !empty($comment)) {
                $product_id = $this->OrderModel->getProductID($order_id);
                $checkReview = $this->OrderModel->checkReview($product_id['product_id'], $user_id);

                if (count($checkReview) > 0) {
                    header('Location: ' . _BASE_URL . '/danh-sach-don-hang');
                    exit();
                } else
                    $result = $this->OrderModel->insertReview($product_id['product_id'], $user_id, $rating, $comment);

                if ($result) {
                    header('Location: ' . _BASE_URL . '/danh-sach-don-hang');
                    exit();
                } else {
                    echo "<script>alert('Không lưu đánh giá được')</script>";
                }
            } else {
                echo "<script>alert('Nội dung không hợp lệ')</script>";
            }
        }
    }
}
