<?php
class Chat extends Controller
{
    private $chatModel;

    // public function __construct()
    // {
    //     $this->chatModel = $this->model('ChatModel');
    // }

    // Hiển thị trang chat
    public function detail()
    {
        $this->render('mess/chat');
        // $user_id = $_SESSION['user_id'] ?? 0;
        // $messages = $this->chatModel->getMessages($user_id, $receiver_id);
        // $this->render('chat/detail', ['messages' => $messages, 'receiver_id' => $receiver_id]);
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
        $chatList = $this->chatModel->getChatList($user_id);
        $this->render('chat/list', ['chatList' => $chatList]);
    }
}
