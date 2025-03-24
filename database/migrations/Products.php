<?php


class Products
{
    public function up()
    {
        $config = require __DIR__ . "/../../configs/database.php";
        $config = $config['database'];
        $db = Connection::getInstance($config)->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            discount_price DECIMAL(10,2) DEFAULT 0.00,
            stock_quantity INT NOT NULL DEFAULT 0,
            category_id INT NOT NULL,
            brand_id INT NOT NULL,
            status ENUM('0', '1') NOT NULL DEFAULT '1',     -- 1 : còn hàng ,  0: hết hàng
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
            FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE CASCADE,
            CHECK (price >= 0 and discount_price >= 0 and stock_quantity >= 0)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($db->query($sql)) {
            echo "Bảng `products` đã được tạo thành công!\n";
        } else {
            echo "Lỗi khi tạo bảng: " . $db->error . "\n";
        }
    }
}

// ENGINE=InnoDB: Dùng bộ máy lưu trữ InnoDB. Giúp bảng hỗ trợ giao dịch, khóa dòng, và đảm bảo dữ liệu an toàn.
// DEFAULT CHARSET=utf8mb4: Mã hóa ký tự utf8mb4 (hỗ trợ Unicode đầy đủ). Giúp lưu được tiếng Việt có dấu, emoji, và các ký tự Unicode đầy đủ.