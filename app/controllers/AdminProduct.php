<?php
class AdminProduct extends Controller
{
    private $orderModel;

    public function __construct()
    {
        try {
            $this->orderModel = $this->model('AdminProductModel');

            if (!$this->orderModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _WEB_ROOT . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }
    // Hiển thị toàn bộ các đơn hàng đã giao thành công
    public function done()
    {
        $ordersDone = $this->orderModel->getListOrdersDone();
        $this->render("admin/orders/daxuly",  ["ordersDone" => $ordersDone]);
    }
    // Hiển thị toàn bộ các đơn hàng chờ xác nhận, đang giao hàng, đã hủy
    public function canxuly()
    {
        $orderDetails = [];
        $id = $_POST['order_id'] ?? null;
        if ($id) {
            $orderDetails = $this->orderModel->getOrderById($id);
            if (!$orderDetails) {
                header("Location:" . _WEB_ROOT . "/canxuly");
                exit;
            }
        }

        $orders = $this->orderModel->getAllOrders();
        $this->render("admin/orders/qldh_canxuly", ["orders" => $orders, 'orderDetails' => $orderDetails]);
    }

    // Hiển thị đơn hàng
    public function viewOrder()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location:" . _WEB_ROOT . "/admin/orders");
            exit;
        }
        $orderDetails = $this->orderModel->getOrderById($id);
        $this->render("admin/orders/view_order", ["orderDetails" => $orderDetails]);
    }

    // Hiển thị toàn bộ các đơn hàng chi tiết có trong đơn hàng order_id
    public function detailOrder($order_id)
    {
        $order_id = $order_id[0];
        $details = $this->orderModel->getOrderById($order_id);
        header('Content-Type: application/json');
        echo json_encode($details);
    }

    // Hiển thị thông tin chi tiết của đơn hàng để chỉnh sửa (trả JSON)
    public function getOrderDetail($order_detail_id)
    {
        $order_detail_id = (int)$order_detail_id[0];
        if (!is_numeric($order_detail_id)) {
            echo json_encode(['error' => 'ID không hợp lệ']);
            return;
        }
        // Lấy chi tiết đơn hàng theo ID
        $orderDetail = $this->orderModel->getOrderDetailByProductTypeId($order_detail_id);
        // Lấy danh sách transport (để đổ vào dropdown)
        $transports = $this->orderModel->getAllTransport();
        header('Content-Type: application/json');
        echo json_encode([
            'orderDetail' => $orderDetail,
            'transports' => $transports
        ]);
    }


    // Nhận dữ liệu đã chỉnh sửa của bản ghi chi tiết đơn hàng để cập nhật lại cơ sở dữ liệu
    public function updateOrderDetail()
    {
        $order_detail_id = $_POST['order_detail_id'] ?? null;
        if (!$order_detail_id) {
            echo "<script>alert('Sai đường dẫn (thiếu id)');</script>";
            header('Location: ' . _BASE_URL . '/canxuly');
            exit;
        }

        $required_fields = ['tenDonHang', 'phone', 'address', 'priceCurrent', 'quantity', 'price', 'order_id'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                echo "<script>alert('m chưa điền đầy đủ thông tin!');</script>";
                header('Location: ' . _BASE_URL . '/getOrderDetail/' . $order_detail_id);
                exit;
            }
        }

        if (
            !is_numeric($_POST['priceCurrent']) ||
            !is_numeric($_POST['quantity']) ||
            !is_numeric($_POST['price']) ||
            $_POST['priceCurrent'] < 0 ||
            $_POST['quantity'] < 0 ||
            $_POST['price'] < 0
        ) {
            echo "<script>alert('Cập nhật không thành công! Thông tin điền vào sai định dạng');</script>";
            header('Location: ' . _BASE_URL . '/getOrderDetail/' . $order_detail_id);
            exit;
        }

        $data = [
            'tenDonHang' => $_POST['tenDonHang'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'ghiChu' => $_POST['ghiChu'] ?? '',
            'transport_id' => $_POST['transport_id'],
            'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
        ];



        $this->orderModel->updateOrderDetail($order_detail_id, $data);
        // Sau khi cập nhật xong chi tiết, có thể tính lại tổng giá của đơn hàng
        $this->orderModel->updateTotalPrice($_POST['order_id']);

        header('Location: ' . _BASE_URL . '/detailOrder/' . $_POST['order_id']);
    }


    // Xóa đơn hàng 
    public function destroy()
    {
        $this->orderModel->deleteOrder();
        header("Location:" . _WEB_ROOT . "/canxuly");
        exit;
    }

    // Hiển thị giao diện xóa đơn hàng chi tiết (có thể sửa loại sản phẩm)
    public function editOrderDetail($order_detail_id)
    {
        $order_detail_id = $order_detail_id[0];
        $orderDetail = $this->orderModel->getOrderDetailByProductTypeId($order_detail_id);
        if (!$orderDetail) {
            header("Location:" . _WEB_ROOT . "/canxuly");
            exit;
        }
        $transoprts = $this->orderModel->getAllTransportById();
        $this->render("admin/orders/qldh_canxuly", ["orderDetail" => $orderDetail, "transoprts" => $transoprts]);
    }
    // Hiển thị form xác nhận xóa đơn hàng chi tiết (có thể xóa loại sản phẩm có trong đơn hàng chi tiết)


}
