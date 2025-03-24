<?php


class Chat
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS chat (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT DEFAULT NULL,       -- Nếu nhắn trực tiếp thì kh cần còn nếu vào một sản phẩm nào đó rồi nhắn thì cần
            sender_id  INT NOT NULL,
            receiver_id   INT NOT NULL,
            context TEXT NOT NULL,
            icon VARCHAR(255) NULL,              -- Lưu icon như 😊, 🎉
            sticker VARCHAR(255) NULL,           -- Đường dẫn đến file sticker
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (sender_id ) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (receiver_id ) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `chat` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}
