<?php
class ChatModel extends Model
{
    private $_table = 'Chat';

    public function sendMessage($sender_id, $receiver_id, $message)
    {
        $sql = "INSERT INTO $this->_table (sender_id, receiver_id, message) VALUES (?, ?, ?)";
        $params = [$sender_id, $receiver_id, $message];
        return $this->execute($sql, $params);
    }

    public function getMessages($user1, $user2)
    {
        $sql = "SELECT * FROM $this->_table WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at ASC";
        $params = [$user1, $user2, $user2, $user1];
        return $this->fetchAll($sql, $params);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE role != 'admin'";
        return $this->fetchAll($sql);
    }

    public function saveMessage($sender_id, $receiver_id, $message, $icon_id, $sticker_id)
    {
        $sql = "INSERT INTO $this->_table (sender_id, receiver_id, message, icon_id, sticker_id) VALUES (?, ?, ?, ?, ?)";
        $params = [$sender_id, $receiver_id, $message, $icon_id, $sticker_id];

        return $this->execute($sql, $params);
    }
}
