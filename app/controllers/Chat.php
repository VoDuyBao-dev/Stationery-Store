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
    public function detail($userId)
    {
        $currentUserId = $_SESSION['user_id']; // ID của user đang đăng nhập
        $role = $_SESSION['role']; // Lấy role của user hiện tại (admin hoặc user)

        // Nếu user đang chat với admin, thì adminId là userId và ngược lại
        if ($role === 'admin') {
            $adminId = $currentUserId;
            $receiverId = $userId;
        } else {
            $adminId = $userId;
            $receiverId = $currentUserId;
        }

        $messages = $this->chatModel->getMessages($adminId, $receiverId);
        $userInfo = $this->chatModel->getUserInfo($receiverId);

        $this->render('mess/chat', [
            'messages' => $messages,
            'userInfo' => $userInfo,
            'admin_id' => $adminId,
            'receiver_id' => $receiverId,
            'role' => $role
        ]);
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
            if (!is_numeric($receiver_id) || $receiver_id <= 0) {
                die("Lỗi: ID người nhận không hợp lệ.");
            }
            if ($sender_id <= 0) {
                die("Bạn cần đăng nhập để gửi tin nhắn.");
            }
            if (!empty($message) || !empty($icon) || !empty($sticker)) {
                $this->chatModel->sendMessage($sender_id, $receiver_id, $message, $icon, $sticker);
            }
        }
        header("Location: /chat/detail/$receiver_id");
    }

    // Lấy danh sách người đã nhắn tin
    public function chatList()
    {
        $user_id = $_SESSION['user_id'] ?? 2;
        $role = $_SESSION['role'] ?? 'admin'; // Lấy vai trò của người dùng từ session
        $chatList = $this->chatModel->getChatList($user_id, $role);
        $this->render('mess/chat', ['chatList' => $chatList, 'role' => $role]);
    }
}
