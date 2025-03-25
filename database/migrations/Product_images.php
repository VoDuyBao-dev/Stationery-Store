<?php

class Product_images
{
    private $db;
    public function up()
    {
        global $config;
        // $config = require __DIR__ . "/../configs/database.php";
        $this->db = Connection::getInstance($config['database'])->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS product_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            image_url VARCHAR(255) DEFAULT NULL,
            FOREIGN KEY (product_id) REFERENCES products(id)  ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($this->db->query($sql)) {
            echo "Bảng `product_images` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $this->db->error . "\n";
        }
    }
}
