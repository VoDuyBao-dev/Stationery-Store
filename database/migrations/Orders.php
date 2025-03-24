<?php


class Orders
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            total_price INT NOT NULL check(total_price >= 0),     -- tổng tiền
            payment_method ENUM('card', 'momo') NOT NULL,         -- phương thức thanh toán
            status ENUM('0', '1') NOT NULL DEFAULT '1',           -- 1 : đã thanh toán ,  0: chưa thanh toán
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES Users(id)  ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `orders` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}
