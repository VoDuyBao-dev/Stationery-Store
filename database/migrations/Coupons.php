<?php


class Coupons
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS coupons (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            code VARCHAR(255) NOT NULL,                       -- mã giảm giá
            discount INT NOT NULL check(discount >= 0),       -- phần trăm giảm giá
            star_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            end_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            status ENUM('0', '1') NOT NULL DEFAULT '1',     -- 1 : còn hạn ,  0: hết hạn
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `coupons` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}
