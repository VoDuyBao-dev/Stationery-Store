<?php


class Icons_stickers
{
    private $db;
    public function up()
    {
        global $config;
        // $config = require __DIR__ . "/../configs/database.php";
        $this->db = Connection::getInstance($config['database'])->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS icons_stickers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            type ENUM('icon', 'sticker') NOT NULL,        -- Phân loại icon hay sticker
            name VARCHAR(255) NOT NULL,                   -- Tên của icon/sticker
            path VARCHAR(255) NOT NULL                    -- Đường dẫn file icon/sticker
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($this->db->query($sql)) {
            echo "Bảng `icons_stickers` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $this->db->error . "\n";
        }
    }
}
