<?php


class Users
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ho VARCHAR(100) NOT NULL,
            ten VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(15) NOT NULL UNIQUE,
            address TEXT DEFAULT NULL,
            role ENUM('admin', 'user') DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `users` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}

// ENGINE=InnoDB: Dùng bộ máy lưu trữ InnoDB. Giúp bảng hỗ trợ giao dịch, khóa dòng, và đảm bảo dữ liệu an toàn.
// DEFAULT CHARSET=utf8mb4: Mã hóa ký tự utf8mb4 (hỗ trợ Unicode đầy đủ). Giúp lưu được tiếng Việt có dấu, emoji, và các ký tự Unicode đầy đủ.