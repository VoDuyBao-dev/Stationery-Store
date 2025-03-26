<?php
class ChatModel extends Model
{
    private $table = 'chat';

    // Lấy danh sách tin nhắn giữa 2 người
    public function getMessages($user_id, $receiver_id)
    {
        $sql = "SELECT * FROM $this->table WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at ASC";
        return $this->fetchAll($sql, [$user_id, $receiver_id, $receiver_id, $user_id]);
    }

    // Gửi tin nhắn mới
    public function sendMessage($sender_id, $receiver_id, $message, $icon = null, $sticker = null)
    {
        $sql = "INSERT INTO $this->table (sender_id, receiver_id, message, icon, sticker, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        return $this->query($sql, [$sender_id, $receiver_id, $message, $icon, $sticker]);
    }

    // Lấy danh sách người đã nhắn tin với người dùng hiện tại
    public function getChatList($user_id, $role)
    {
        if ($role == 'admin') {
            return $this->getAllUsers();
        } else {
            $sql = "SELECT DISTINCT CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS chat_user FROM $this->table WHERE sender_id = ? OR receiver_id = ?";
            return $this->fetchAll($sql, [$user_id, $user_id, $user_id]);
        }
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers()
    {
        $sql = "SELECT id, name FROM users";
        return $this->fetchAll($sql);
    }
}
