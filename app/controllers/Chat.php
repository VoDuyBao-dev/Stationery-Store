<?php
class Chat extends Controller
{
    private $chatModel;

    public function __construct()
    {
        try {
            $this->chatModel = $this->model('chatModel');  // tạo một object mới

            if (!$this->chatModel) {
                throw new Exception("Lỗi trong quá trình tạo đối tượng");
            }
        } catch (Exception $e) {
            header("Location:" . _BASE_URL . "/app/errors/loichung.php?message=" . urlencode($e->getMessage()));
            exit;
        }
    }

    // Hiển thị trang chat
    public function detail($receiver_id)
    {
        $sender_id = $_SESSION['user_id'] ?? 0;
        $receiver_id = intval($receiver_id); // Chuyển đổi giá trị $receiver_id thành số nguyên
        if ($receiver_id > 0) {
            $messages = $this->chatModel->getMessages($sender_id, $receiver_id);
            $this->render('chat/detail', ['messages' => $messages, 'receiver_id' => $receiver_id]);
        } else {
            echo "Người nhận không hợp lệ.";
        }
    }

    // Gửi tin nhắn
    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sender_id = $_SESSION['user_id'] ?? 0;
            $receiver_id = $_POST['receiver_id'] ?? 0;
            $message = $_POST['message'] ?? '';
            $icon = $_POST['icon'] ?? null;
            $sticker = $_POST['sticker'] ?? null;

            if (!empty($message) || !empty($icon) || !empty($sticker)) {
                $this->chatModel->sendMessage($sender_id, $receiver_id, $message, $icon, $sticker);
            }
        }
        header("Location: /chat/detail/$receiver_id");
    }

    // Lấy danh sách người đã nhắn tin
    public function chatList()
    {
        $user_id = $_SESSION['user_id'] ?? 0;
        $role = $_SESSION['role'] ?? 'user'; // Lấy vai trò của người dùng từ session
        $chatList = $this->chatModel->getChatList($user_id, $role);
        $this->render('chat/list', ['chatList' => $chatList]);
    }
}
