<?php
class ChatModel extends Model
{
    private $table = 'chat';

    // Lấy danh sách tin nhắn giữa 2 người (giới hạn 50 tin mới nhất)
    public function getMessages($user_id, $receiver_id, $limit = 50)
    {
        $sql = "SELECT *, DATE_FORMAT(created_at, '%d-%m-%Y %H:%i') as formatted_time 
                FROM $this->table 
                WHERE (sender_id = ? AND receiver_id = ?) 
                OR (sender_id = ? AND receiver_id = ?) 
                ORDER BY created_at DESC 
                LIMIT ?";
        return $this->fetchAll($sql, [$user_id, $receiver_id, $receiver_id, $user_id, $limit]);
    }

    // Gửi tin nhắn mới (kiểm tra dữ liệu trước khi insert)
    public function sendMessage($sender_id, $receiver_id, $message, $icon = null, $sticker = null)
    {
        if ($sender_id <= 0 || $receiver_id <= 0 || empty($message) && empty($icon) && empty($sticker)) {
            return false; // Không lưu tin nhắn nếu dữ liệu không hợp lệ
        }

        $sql = "INSERT INTO $this->table (sender_id, receiver_id, message, icon, sticker, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        return $this->query($sql, [$sender_id, $receiver_id, $message, $icon, $sticker]);
    }

    // Lấy danh sách người đã nhắn tin với người dùng hiện tại
    public function getChatList($user_id, $role)
    {
        if ($role == 'admin') {
            return $this->getAllUsers($user_id);
        } else {
            $sql = "SELECT DISTINCT 
                        CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS chat_user 
                    FROM $this->table 
                    WHERE (sender_id = ? OR receiver_id = ?) 
                    AND sender_id != receiver_id";
            return $this->fetchAll($sql, [$user_id, $user_id, $user_id]);
        }
    }

    // Lấy danh sách tất cả người dùng (chỉ dành cho admin)
    public function getAllUsers($user_id)
    {
        $sql = "SELECT id, fullname FROM users where id != $user_id ";
        return $this->fetchAll($sql);
    }
}
