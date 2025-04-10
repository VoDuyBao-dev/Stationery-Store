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
        $currentUserId = $_SESSION['user']['user_id']; // Người dùng hiện tại phải là admin
        // $role = $_SESSION['user']['role'] ?? 'admin'; // Lấy role của user hiện tại (admin hoặc user)
        $role = 'admin';
        if ($role != 'admin') {
            header("HTTP/1.0 404 Not Found");
            echo "Không tìm thấy trang.";
            exit();
        }

        $chatList = $this->chatModel->getChatList($currentUserId, $role);
        $allSticker = $this->chatModel->getAllStickers();
        $this->render('mess/chat', [
            'chatList' => $chatList,
            'role' => $role,
            'admin_id' => 2,
            'allSticker' => $allSticker,
            'messages' => []
        ]);
    }

    // Hiển thị trang chat
    public function detail($user_id)
    {
        $receiverId = (int)$user_id;
        $sender_id = $_SESSION['user']['user_id']; // ID của user đang đăng nhập
        // $sender_id = 2; // ID của user đang đăng nhập (admin)
        $role = $_SESSION['user']['role']; // Lấy role của user hiện tại (admin hoặc user)

        $messages = $this->chatModel->getMessages($sender_id, $receiverId);

        if ($role == "admin") {
            $chatList = $this->chatModel->getChatList($sender_id, $role);
        } else $chatList = "";

        $allSticker = $this->chatModel->getAllStickers();
        $this->render('mess/chat', [
            'messages' => $messages,         // all cột của bảng trùng với id gửi và nhận.
            'sender_id' => $sender_id,          // người gửi
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
            $sender_id = $_SESSION['user']['user_id'];
            $receiver_id = $_POST['receiver_id'];
            $message = trim($_POST['message'] ?? '');
            $sticker_id = $_POST['sticker_id'];
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
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'message' => $message,
                'sticker_id' => $sticker_id,  // Lưu sticker nếu có
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $this->chatModel->sendMessage(...array_values($data));
            header("Location:" . _BASE_URL . "/chat/" . $receiver_id);
        }
    }
}
