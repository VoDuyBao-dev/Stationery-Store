<?php


class Product_type
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);
        // Không tạo id 4 số chỉ tạo cho bảng products
        $sql = "CREATE TABLE IF NOT EXISTS product_type (
            product_type_id INT AUTO_INCREMENT PRIMARY KEY, 
            product_id INT(4) ZEROFILL NOT NULL,
            name VARCHAR(255) NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            priceOld DECIMAL(10,2) DEFAULT NULL,
            priceCurrent DECIMAL(10,2) NOT NULL,   
            discount_price DECIMAL(10,2) DEFAULT 0.00,   -- Phần trăm cần giảm
            stock_quantity INT NOT NULL DEFAULT 0,       -- số lượng tồn kho
            status ENUM('0', '1') NOT NULL DEFAULT '1',     -- 1 : còn hàng ,  0: hết hàng
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
            CHECK (priceCurrent >= 0 and priceOld and discount_price >= 0 and stock_quantity >= 0)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ; ";

        try {
            $this->db->query($sql);
            echo "Bảng `product_type` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }
    // hàm này có tác dụng khi người dùng thêm giá mới cho sản phầm thì sẽ tính % của lần giảm/tăng đó.
    public function calculateDiscountPrice()
    {
        $sql = "UPDATE product_type 
                SET discount_price = (priceOld - priceCurrent) / priceOld * 100
                WHERE priceOld > 0"; // Đảm bảo không chia cho 0

        try {
            $this->db->query($sql);
            echo "Giá trị `discount_price` đã được tính toán và cập nhật thành công!\n";
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi tính toán `discount_price`: " . $e->getMessage() . "\n";
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO product_type (product_id, name, image, priceOld, priceCurrent, stock_quantity, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $data = [
            [1001, 'iPhone 13',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 100000, 100000, 100, '1'],
            [1002, 'Samsung Galaxy S21',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 200000, 200000, 150, '1'],
            [1003, 'Sony WH-1000XM4',  __DIR__ . '/../../public/assets/clients/images/sticker/1.png', 200000, 200000, 200, '1']
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `product_type` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `product_type`: " . $e->getMessage() . "\n";
            }
        }
        $this->calculateDiscountPrice();
    }
}



// ENGINE=InnoDB: Dùng bộ máy lưu trữ InnoDB. Giúp bảng hỗ trợ giao dịch, khóa dòng, và đảm bảo dữ liệu an toàn.
// DEFAULT CHARSET=utf8mb4: Mã hóa ký tự utf8mb4 (hỗ trợ Unicode đầy đủ). Giúp lưu được tiếng Việt có dấu, emoji, và các ký tự Unicode đầy đủ.