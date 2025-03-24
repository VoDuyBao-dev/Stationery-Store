<?php
require_once __DIR__ . "/../models/ChatModel.php";

class ChatController
{
    private $chatModel;

    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }

    public function fetchMessages()
    {
        $user1 = $_SESSION['user_id']; // Người đang đăng nhập
        $user2 = $_POST['user_id']; // Người muốn xem tin nhắn
        echo json_encode($this->chatModel->getMessages($user1, $user2));
    }

    public function sendMessage()
    {
        $message = $_POST['message'] ?? null;
        $icon_id = $_POST['icon_id'] ?? null;
        $sticker_id = $_POST['sticker_id'] ?? null;
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_POST['receiver_id'];

        $chatModel = new ChatModel();
        $chatModel->saveMessage($sender_id, $receiver_id, $message, $icon_id, $sticker_id);

        echo json_encode(['status' => 'success']);
    }
}
