<?php


class Products
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            discount_price DECIMAL(10,2) DEFAULT 0.00,   -- giá sau khi giảm giá
            stock_quantity INT NOT NULL DEFAULT 0,       -- số lượng tồn kho
            category_id INT NOT NULL,
            brand_id INT NOT NULL,
            status ENUM('0', '1') NOT NULL DEFAULT '1',     -- 1 : còn hàng ,  0: hết hàng
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
            FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE CASCADE,
            CHECK (price >= 0 and discount_price >= 0 and stock_quantity >= 0)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `products` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }
    public function seed()
    {
        $sql = "INSERT INTO products (id, name, description, image,price, discount_price, stock_quantity, category_id, brand_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = [
            [1, 'iPhone 13', 'Điện thoại Apple iPhone 13',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 100000, 100000, 100, 1, 1, '1'],
            [2, 'Samsung Galaxy S21', 'Điện thoại Samsung Galaxy S21',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 200000, 200000, 150, 1, 2, '1'],
            [3, 'Sony WH-1000XM4', 'Tai nghe Sony WH-1000XM4',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 200000, 200000, 200, 4, 3, '1']
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `products` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `products`: " . $e->getMessage() . "\n";
            }
        }
    }
}



// ENGINE=InnoDB: Dùng bộ máy lưu trữ InnoDB. Giúp bảng hỗ trợ giao dịch, khóa dòng, và đảm bảo dữ liệu an toàn.
// DEFAULT CHARSET=utf8mb4: Mã hóa ký tự utf8mb4 (hỗ trợ Unicode đầy đủ). Giúp lưu được tiếng Việt có dấu, emoji, và các ký tự Unicode đầy đủ.