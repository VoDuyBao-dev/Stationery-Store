<?php
class Transport extends Controller
{
    private $transportModel;
    public function __construct()
    {
        try {
            $this->transportModel = $this->model('TransportModel');  // tạo một object mới

            if (!$this->transportModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }
    public function index()
    {
        $getAllTransport = $this->transportModel->getAllTransports();
        $this->render('admin/transport', [
            'getAllTransport' => $getAllTransport,

        ]);
    }
    public function transportHandler()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if ($data['action'] === 'add') {
            $name = $data['name'];
            $price = $data['price'];

            if (empty($name) || empty($price)) {
                echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin!']);
                return;
            }

            $transportModel = new TransportModel();
            $result = $transportModel->addTransport(['name' => $name, 'price' => $price]);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Thêm phương thức vận chuyển thành công!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm phương thức vận chuyển thất bại!']);
            }
        }
    }
}
