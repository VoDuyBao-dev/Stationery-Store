<?php

class Product_images
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS product_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            image_url VARCHAR(255) DEFAULT NULL,
            FOREIGN KEY (product_id) REFERENCES products(id)  ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `product_images` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}
