<?php
class Transport extends Controller
{
    private $transportModel;

    public function __construct()
    {
        try {
            $this->transportModel = $this->model('TransportModel');

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
        $this->render('admin/transport', ['getAllTransport' => $getAllTransport]);
    }

    public function transportHandler()
    {
        header('Content-Type: application/json');
        ob_clean();
        try {
            $input = file_get_contents("php://input");
            if (!$input) {
                echo json_encode(['success' => false, 'message' => 'Không nhận được dữ liệu!']);
                exit;
            }
            $data = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu JSON không hợp lệ!']);
                exit;
            }
            if (!isset($data['action'])) {
                echo json_encode(['success' => false, 'message' => 'Thiếu hành động!']);
                exit;
            }

            switch ($data['action']) {
                case 'add':
                    $name = trim($data['name']);
                    $price = filter_var($data['price'], FILTER_VALIDATE_FLOAT);

                    if (empty($name) || $price === false) {
                        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập tên và giá hợp lệ!']);
                        exit;
                    }

                    $result = $this->transportModel->addTransport(['name' => $name, 'price' => $price]);
                    echo json_encode(['success' => $result, 'message' => $result ? 'Thêm thành công!' : 'Thêm thất bại!']);
                    exit;

                case 'edit':
                    $id = filter_var($data['id'], FILTER_VALIDATE_INT);
                    $name = trim($data['name']);
                    $price = filter_var($data['price'], FILTER_VALIDATE_FLOAT);

                    if (!$id || empty($name) || $price === false) {
                        echo json_encode(['success' => false, 'message' => 'Dữ liệu chỉnh sửa không hợp lệ!']);
                        exit;
                    }
                    $result = $this->transportModel->updateTransport($id, ['name' => $name, 'price' => $price]);
                    echo json_encode(['success' => $result, 'message' => $result ? 'Cập nhật thành công!' : 'Cập nhật thất bại!']);
                    exit;

                case 'delete':
                    $id = filter_var($data['id'], FILTER_VALIDATE_INT);

                    if (!$id) {
                        echo json_encode(['success' => false, 'message' => 'ID không hợp lệ!']);
                        exit;
                    }

                    $result = $this->transportModel->deleteTransport($id);
                    echo json_encode(['success' => $result, 'message' => $result ? 'Xóa thành công!' : 'Xóa thất bại!']);
                    exit;

                default:
                    echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ!']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            error_log($e->getMessage()); // Log the error message
            exit;
        } finally {
            // Xóa bất kỳ output HTML nào trước JSON
            ob_end_clean();
        }
    }
}
