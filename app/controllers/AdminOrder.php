<?php
class AdminOrder extends Controller
{
    private $orderModel;

    public function __construct()
    {
        try {
            $this->orderModel = $this->model('AdminOrderModel');

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
        $this->validateAdmin();
        $date = $_GET['date'] ?? null;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        $offset = $currentPage * $limit;
        $totalOrders = count($this->orderModel->getAllDone($date)); // Lấy tổng số đơn hàng đã giao thành công
        $totalPages = ceil($totalOrders / $limit);                  // Tính tổng số trang
        $totalPages = $totalPages == 0 ? 1 : $totalPages;

        $ordersDone = $this->orderModel->getListOrdersDone($date, $offset);

        $i = ($currentPage - 1) * $limit;   // Tính chỉ số bắt đầu của trang hiện tại
        $ordersDone = array_slice($ordersDone, $i); // Lấy danh sách đơn hàng theo trang}


        $this->render("admin/orders/daxuly",  [
            "ordersDone" => $ordersDone,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages,
            "limit" => $limit,
            "date" => $date
        ]);
    }

    // Hiển thị toàn bộ các đơn hàng chờ xác nhận, đang giao hàng, đã hủy
    public function canxuly()
    {
        $this->validateAdmin();
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        $offset = $currentPage * $limit;
        $totalOrders = count($this->orderModel->getAll($date)); // Lấy tổng số đơn hàng đã giao thành công

        $totalPages = ceil($totalOrders / $limit);              // Tính tổng số trang
        $totalPages = $totalPages == 0 ? 1 : $totalPages;

        $orders = $this->orderModel->getAllOrders($date, $offset);

        $i = ($currentPage - 1) * $limit;   // Tính chỉ số bắt đầu của trang hiện tại
        $orders = array_slice($orders, $i); // Lấy danh sách đơn hàng theo trang}
        $this->render("admin/orders/qldh_canxuly",  [
            "orders" => $orders,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages,
            "limit" => $limit,
            "date" => $date
        ]);
    }

    // xác nhận giao hàng
    public function xacnhan($order_id)
    {
        $this->validateAdmin();
        $order_id = $order_id[0];
        $this->orderModel->xacNhanDonModel($order_id);
        header("Location:" . _WEB_ROOT . "/canxuly");
    }
    // xác nhận giao hàng thành công
    public function xacNhanThanhCong($order_id)
    {
        $this->validateAdmin();
        $order_id = $order_id[0];
        $this->orderModel->xacNhanDonThanhCongModel($order_id);
        header("Location:" . _WEB_ROOT . "/canxuly");
    }

    // Hiển thị đơn hàng khi nhấn nút sửa
    public function viewOrder($order_id)
    {
        $this->validateAdmin();
        $id = $order_id[0];
        if (!$id) {
            echo "<script>alert('Không tìm thấy đơn hàng hợp lệ')</script>";
            header("Location:" . _WEB_ROOT . "/canxuly");
            exit;
        }

        $order = $this->orderModel->getOrderById($id);
        $transports = $this->orderModel->getAllTransport();
        header('Content-Type: application/json');
        echo json_encode([
            'order' => $order,
            'transports' => $transports
        ]);
    }
    // Sửa thông tin đơn hàng (chỉ được sửa phương thức vận chuyển)
    public function suaDon()
    {
        $this->validateAdmin();
        $order_id = (int)$_POST['edit_ma'];
        $transport_id = $_POST['edit_vanchuyen'];
        $transportOldPrice = $_POST['transportOldPrice'];
        $total_price = $_POST['edit_tong'];
        $this->orderModel->suaTransportModel($order_id, $transport_id);
        $this->orderModel->suaDonModel($transportOldPrice, $total_price, $transport_id, $order_id);
        header("Location:" . _WEB_ROOT . "/canxuly");
    }

    // Hủy đơn hàng
    public function huyDon()
    {
        $this->validateAdmin();
        $order_id = $_POST['order_id'] ?? null;
        $this->orderModel->huyDonModel($order_id);
        header("Location:" . _WEB_ROOT . "/canxuly");
    }


    // Xóa đơn hàng 
    public function xoaDon()
    {
        $this->validateAdmin();
        $order_id = $_POST['order_id'] ?? null;
        if (!$order_id) {
            echo "<script>alert('Không tìm thấy đơn hàng hợp lệ để xóa')</script>";
            header('Location: ' . _BASE_URL . '/canxuly');
            exit;
        }
        $this->orderModel->xoaDonModel($order_id);
        header("Location:" . _WEB_ROOT . "/canxuly");
        exit;
    }
    public function deleteDetail()
    {
        $this->validateAdmin();
        $order_detail_id = $_POST['order_detail_id'] ?? null;
        $order_id = $this->orderModel->getOrderId($order_detail_id);
        $order_id = $order_id['order_id'];
        if (!$order_detail_id) {
            echo "<script>alert('Không tìm thấy chi tiết đơn hàng hợp lệ để xóa')</script>";
            header('Location: ' . _BASE_URL . '/canxuly' . '?xem-id=' . $order_id);
            exit;
        }
        $this->orderModel->xoaChiTietModel($order_detail_id);

        $this->orderModel->updateTotalPrice($order_id);
        $count = $this->orderModel->getAllDetailById($order_id);
        if (empty($count)) {
            $this->orderModel->xoaDonModel($order_id);
            header("Location:" . _WEB_ROOT . "/canxuly");
            exit;
        }
        // die();
        header("Location:" . _WEB_ROOT . '/canxuly' . '?xem-id=' . $order_id);
        exit;
    }


    // Hiển thị toàn bộ các đơn hàng chi tiết có trong đơn hàng có order_id = ?
    public function detailOrder($order_id)
    {
        $this->validateAdmin();
        $order_id = $order_id[0];
        $details = $this->orderModel->getAllOrderById($order_id);
        header('Content-Type: application/json');
        echo json_encode($details);
    }

    // Hiển thị thông tin chi tiết của đơn hàng để chỉnh sửa (trả JSON)
    public function getOrderDetail($order_detail_id)
    {
        $this->validateAdmin();
        $order_detail_id = (int)$order_detail_id[0];
        if (!is_numeric($order_detail_id)) {
            echo json_encode(['error' => 'ID không hợp lệ']);
            return;
        }
        // Lấy chi tiết đơn hàng theo ID
        $orderDetail = $this->orderModel->getOrderDetailByProductTypeId($order_detail_id);
        // Lấy danh sách các loại sản phẩm có trong đơn hàng
        $productTypes = $this->orderModel->getAllProductType($order_detail_id);
        header('Content-Type: application/json');
        echo json_encode([
            'orderDetail' => $orderDetail,
            'productTypes' => $productTypes
        ]);
    }

    // Nhận dữ liệu đã chỉnh sửa của bản ghi chi tiết đơn hàng để cập nhật lại cơ sở dữ liệu
    public function updateOrderDetail()
    {
        $this->validateAdmin();
        $order_detail_id = $_POST['order_detail_id'] ?? null;
        if (!$order_detail_id) {
            echo "<script>alert('Sai đường dẫn (thiếu id)');</script>";
            header('Location: ' . _BASE_URL . '/canxuly');
            exit;
        }

        $required_fields = ['tenDonHang', 'phone', 'address', 'quantity', 'order_id'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                echo "<script>alert('Bạn chưa điền đầy đủ thông tin!');</script>";
                header('Location: ' . _BASE_URL . '/canxuly' . '?xem-id=' . $_POST['order_id']);
                exit;
            }
        }

        if ($_POST['quantity'] <= 0) {
            echo "<script>alert('Cập nhật không thành công! Số lượng không thể <= 0');</script>";
            header('Location: ' . _BASE_URL . '/canxuly' . '?xem-id=' . $_POST['order_id']);
            exit;
        }

        $data = [
            'product_type_id' => $_POST['product_type_id'],
            // 'tenDonHang' => $_POST['tenDonHang'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'ghiChu' => $_POST['ghiChu'] ?? '',
            'quantity' => $_POST['quantity'],
            'order_detail_id' => $_POST['order_detail_id'],
            'order_id' => $_POST['order_id']
        ];
        // print_r($data);
        // echo "<br>";
        // lấy giá của loại sản phẩm
        $productTypePrice = $this->orderModel->getProductTypePrice($data['product_type_id']);
        // print_r($productTypePrice);
        // echo "<br>";
        // tính và cập nhật lại giá tiền của sản phẩm
        $price = $_POST['quantity'] * $productTypePrice['priceCurrent'];
        $this->orderModel->updateOrderDetail($data, $price, $productTypePrice);
        $this->orderModel->update($data);
        // Sau khi cập nhật xong chi tiết đơn hàng, có thể tính lại tổng giá của đơn hàng
        $tmp = $this->orderModel->updateTotalPrice($_POST['order_id']);
        // echo $tmp;
        // die();
        header('Location: ' . _BASE_URL . '/canxuly' . '?xem-id=' . $_POST['order_id']);
    }
}