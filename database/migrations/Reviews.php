<?php


class Reviews
{
    private $db;
    public function up()
    {
        global $config;
        // $config = require __DIR__ . "/../configs/database.php";
        $this->db = Connection::getInstance($config['database'])->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            user_id INT NOT NULL,
            comment TEXT DEFAULT NULL,
            rating INT DEFAULT 0 CHECK (rating >= 0 AND rating <= 5),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($this->db->query($sql)) {
            echo "Bảng `reviews` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $this->db->error . "\n";
        }
    }
}
