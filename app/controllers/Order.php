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
        $this->checkLogin();
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
        $this->checkLogin();
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

    // đơn hàng người dùng sử dụng lọc theo ngày
    // public function searchOrderBy_timeFilter() {
    //     $fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : null;
    //     $toDate = isset($_GET['to_date']) ? $_GET['to_date'] : null;

    //     if ($fromDate && $toDate) {
    //         $order_list = $this->orderModel->getOrdersByDateRange($fromDate, $toDate);
    //     } else {
    //         $order_list = $this->orderModel->getAllOrders();
    //     }

    //     $data = [
    //         'order_list' => $order_list
    //     ];

    //     $this->render("users/order/order_list", $data);
    // }

    // Hủy đơn hàng khi còn ở trạng thái đang xử lý
    public function cancelOrder()
    {
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
}
