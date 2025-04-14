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

    public function done()
    {
        $ordersDone = $this->orderModel->getListOrdersDone();
        $this->render("admin/orders/daxuly",  ["ordersDone" => $ordersDone]);
    }

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

    public function detailOrder($order_id)
    {
        $details = $this->orderModel->getOrderById($order_id);
        header('Content-Type: application/json');
        echo json_encode($details);
    }


    public function destroy()
    {
        $this->orderModel->deleteOrder();
        header("Location:" . _WEB_ROOT . "/canxuly");
        exit;
    }
}
