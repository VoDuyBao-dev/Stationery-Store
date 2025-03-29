<?php

class Chat
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS chat (
            chat_id INT AUTO_INCREMENT PRIMARY KEY,
            sender_id  INT NOT NULL,
            receiver_id   INT NOT NULL,
            message TEXT,                    -- Nội dung tin nhắn (có thể để NULL khi gửi sticker)
            sticker_id INT,                  -- ID sticker (nếu gửi sticker, giá trị này khác NULL)
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (sender_id ) REFERENCES users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (receiver_id ) REFERENCES users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (sticker_id) REFERENCES stickers(sticker_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `chat` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO chat (sender_id, receiver_id, message, sticker_id) VALUES (?, ?, ?, ?)";
        $data = [
            [1, 2, 'Chào bạn!', 1],
            [2, 1, 'Chào bạn!', 1],
            [1, 2, '', 1],
            [2, 1, '', 2],
            [1, 2, 'Bạn cần giúp gì không?', 1],
            [2, 1, 'Tôi cần mua một sản phẩm', 1],
            [1, 2, 'Bạn cần mua sản phẩm gì?', 1],
            [2, 1, 'Tôi cần mua iPhone 12', 1],
            [1, 2, 'Bạn muốn mua bản 64GB hay 128GB?', 1],
            [2, 1, 'Tôi muốn mua bản 128GB', 1],
            [1, 2, 'Sản phẩm có màu gì?', 1],
            [2, 1, 'Màu đen và màu trắng', 1],
            [1, 2, 'Tôi muốn mua màu đen', 1],
            [2, 1, 'Ok, tôi sẽ kiểm tra hàng và báo giá cho bạn', 1],
            [1, 2, 'Cảm ơn bạn!', 1],
            [2, 1, 'Không có gì!', 1]
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `chat` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `chat`: " . $e->getMessage() . "\n";
            }
        }
    }
}
