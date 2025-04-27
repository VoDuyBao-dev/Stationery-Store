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
        $role = $_SESSION['user']['role']; // Người dùng hiện tại phải là admin
        if ($role != 'admin') {
            header("HTTP/1.0 404 Not Found");
            echo "Không tìm thấy trang.";
            exit();
        }


        $chatList = $this->chatModel->getChatList($currentUserId, $role);
        $allSticker = $this->chatModel->getAllStickers();

        $information = [
            'user_id' => 0,
            'fullname' => '',
            'email' => '',
            'phone' => ''
        ];

        $this->render('mess/chat', [
            'chatList' => $chatList,
            'role' => $role,
            'admin_id' => 1,
            'allSticker' => $allSticker,
            'messages' => [],
            'information' => $information
        ]);
    }

    // Hiển thị trang chat
    public function detail($user_id)
    {
        if (!isset($_SESSION['user'])) {
            header("Location:" . _BASE_URL . "/dang-nhap");
            exit;
        }
        $receiverId = $user_id[0];
        $sender_id = $_SESSION['user']['user_id']; // ID của user đang đăng nhập
        $role = $_SESSION['user']['role']; // Lấy role của người nhận
        $messages = $this->chatModel->getMessages($sender_id, $receiverId);
        if ($_SESSION['user']['role'] == "admin") {
            $chatList = $this->chatModel->getChatList($sender_id, $role);
        } else $chatList = "";

        $information = $this->chatModel->getUsers($receiverId);
        // if (!$information) {
        //     header("Location:" . _BASE_URL . "/beginChat");
        //     exit;
        // }

        $allSticker = $this->chatModel->getAllStickers();

        $this->render('mess/chat', [
            'messages' => $messages,         // Tất cả tin nhắn giữa 2 người
            'sender_id' => $sender_id,          // người gửi
            'receiver_id' => $receiverId,    // người nhận
            'chatList' => $chatList,
            'role' => $role,                // quyền của người nhận hiện tại (admin hoặc user)
            'allSticker' => $allSticker,
            'information' => $information, // thông tin người nhận
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
            // Kiểm tra tính hợp lệ của ID người nhận
            if ($_SESSION['user']['role'] == 'admin' and (!is_numeric($receiver_id) || $receiver_id <= 0)) {
                header("Location:" . _BASE_URL . "/beginChat");
                exit;
            }
            if (!is_numeric($receiver_id) || $receiver_id <= 0) {
                header("Location:" . _BASE_URL . "/chat/" . $receiver_id);
                exit;
            }

            if ($sender_id <= 0) {
                header("Location:" . _BASE_URL . "/dang-nhap");
                exit;
            }

            // Kiểm tra nội dung tin nhắn hoặc sticker
            if (empty($message) && empty($sticker_id)) {
                header("Location:" . _BASE_URL . "/chat/" . $receiver_id);
                exit;
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
