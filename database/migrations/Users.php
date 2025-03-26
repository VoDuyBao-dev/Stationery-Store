<?php
class Users
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(15) NOT NULL UNIQUE,
            address TEXT DEFAULT NULL,
            role ENUM('admin', 'user') DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `users` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO users (fullname, email, password, phone, address, role) VALUES(?, ?, ?, ?, ?, ?)";
        $data = [
            ["nameUser", "emailUser@gmail.com", "passwordUser", "phoneUser", "addressUser", "user"],
            ["nameAdmin", "emailAdmin@gmail.com", "passwordAdmin", "phoneAdmin", "addressAdmin", "admin"]
        ];
        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `users` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `users`: " . $e->getMessage() . "\n";
            }
        }
    }
}

// ENGINE=InnoDB: Dùng bộ máy lưu trữ InnoDB. Giúp bảng hỗ trợ giao dịch, khóa dòng, và đảm bảo dữ liệu an toàn.
// DEFAULT CHARSET=utf8mb4: Mã hóa ký tự utf8mb4 (hỗ trợ Unicode đầy đủ). Giúp lưu được tiếng Việt có dấu, emoji, và các ký tự Unicode đầy đủ.