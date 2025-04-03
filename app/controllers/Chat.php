<?php
class Chat extends Controller
{
    private $chatModel;

    public function __construct()
    {
        try {
            $this->chatModel = $this->model('ChatModel');  // tạo một object mới

            if (!$this->chatModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }

    public function beginChat()
    {
        $currentUserId = $_SESSION['user_id'] ?? 2; // Người dùng hiện tại phải là admin
        $role = $_SESSION['role'] ?? 'admin'; // Lấy role của user hiện tại (admin hoặc user)
        if ($role != 'admin') {
            header("HTTP/1.0 404 Not Found");
            echo "Không tìm thấy trang.";
            exit();
        }
        $userInfo = $this->chatModel->getUserInfo(2);
        $chatList = $this->chatModel->getChatList($currentUserId, $role);
        $allSticker = $this->chatModel->getAllStickers();
        $this->render('mess/chat', [
            'chatList' => $chatList,
            'role' => $role,
            'admin_id' => 2,
            'allSticker' => $allSticker,
            'userInfo' => $userInfo,
            'messages' => []
        ]);
    }

    // Hiển thị trang chat
    public function detail($user_id)
    {
        $user_id = (int)$user_id;
        $currentUserId = $_SESSION['user_id'] ?? 2; // ID của user đang đăng nhập
        $role = $_SESSION['role'] ?? 'admin'; // Lấy role của user hiện tại (admin hoặc user)

        // Nếu user đang chat với admin, thì adminId là userId và ngược lại
        if ($role === 'admin') {
            $adminId = $currentUserId;
            $receiverId = $user_id;
        } else {
            $adminId = $user_id;
            $receiverId = $currentUserId;
        }
        $messages = $this->chatModel->getMessages($adminId, $receiverId);
        // print_r($messages);

        $userInfo = $this->chatModel->getUserInfo($receiverId);
        if (!$userInfo) {
            $userInfo = ['name' => 'Unknown', 'avatar' => 'default.jpg'];
        }
        // print_r($userInfo);
        // $key = array_keys($userInfo);
        // print_r($key);
        if ($role == "admin") {
            $chatList = $this->chatModel->getChatList($adminId, $role);
        } else $chatList = "";

        $allSticker = $this->chatModel->getAllStickers();
        $this->render('mess/chat', [
            'messages' => $messages,         // all cột của bảng trùng với id gửi và nhận.
            'userInfo' => $userInfo,         // Thông tin người nhận(bảng users)
            'admin_id' => $adminId,          // người gửi
            'receiver_id' => $receiverId,    // người nhận
            'chatList' => $chatList,
            'role' => $role,
            'allSticker' => $allSticker
        ]);
    }


    public function sendMessage()
    {
        // Lấy thông tin từ session và POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sender_id = $_SESSION['user_id'] ?? 2;
            $receiver_id = $_POST['receiver_id'] ?? 1;
            $message = trim($_POST['message'] ?? '');
            $sticker_id = $_POST['sticker_id'] ?? 1;
            echo $_POST['sticker_id'] . "dday af noi debug <br>";
            // Kiểm tra tính hợp lệ của ID người nhận
            if (!is_numeric($receiver_id) || $receiver_id <= 0) {
                die("Lỗi: ID người nhận không hợp lệ.");
            }

            if ($sender_id <= 0) {
                die("Bạn cần đăng nhập để gửi tin nhắn.");
            }

            // Kiểm tra nội dung tin nhắn hoặc sticker
            if (empty($message) && empty($sticker_id)) {
                die("Tin nhắn hoặc sticker không được để trống.");
            }
            $data = [
                'sender_id' => 2,
                'receiver_id' => (int)$receiver_id,
                'message' => $message,
                'sticker_id' => (int)$sticker_id,  // Lưu sticker nếu có
                'created_at' => date("Y-m-d H:i:s"),
            ];
            print_r($data);
            $chatModel = new ChatModel();
            $chatModel->sendMessage(...array_values($data));

            header("Location:" . _BASE_URL . "/chat/" . $receiver_id);
        }
    }
}
