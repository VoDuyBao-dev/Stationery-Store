<?php
class ChatModel extends Model
{
    private $table = 'chat';
    private $table_stickers = 'stickers';

    // Lấy danh sách tin nhắn giữa 2 người 
    public function getMessages($user_id, $receiver_id)
    {
        $sql = "SELECT *, DATE_FORMAT(created_at, '%d-%m-%Y %H:%i') as formatted_time 
                FROM $this->table 
                WHERE (sender_id = ? AND receiver_id = ?) 
                OR (sender_id = ? AND receiver_id = ?) 
                ORDER BY created_at ASC";
        return $this->fetchAll($sql, [$user_id, $receiver_id, $receiver_id, $user_id]);
    }

    // Gửi tin nhắn mới (kiểm tra dữ liệu trước khi insert)
    public function sendMessage($sender_id, $receiver_id, $message, $sticker_id = null)
    {
        $sql = "INSERT INTO $this->table (sender_id, receiver_id, message, sticker_id, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        return $this->execute($sql, [$sender_id, $receiver_id, $message, $sticker_id]);
    }

    // Lấy danh sách người đã nhắn tin với người dùng hiện tại
    public function getChatList($user_id, $role)
    {
        if ($role == "admin") {
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
        $sql = "SELECT user_id, fullname FROM users where user_id != $user_id ";
        return $this->fetchAll($sql);
    }

    public function getUsers($user_id)
    {
        return $this->fetch("SELECT * FROM users WHERE user_id = ?", [$user_id]);
    }

    public function getAllStickers()
    {
        $sql = "SELECT * from $this->table_stickers";
        return $this->fetchAll($sql);
    }

    public function getSticker($sticker_id)
    {
        $sql = "SELECT * from $this->table_stickers where sticker_id = $sticker_id ";
        return $this->fetch($sql);
    }
}
