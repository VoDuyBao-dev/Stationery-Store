<?php


class Products
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);
        // Tạo 4 số 
        $sql = "CREATE TABLE IF NOT EXISTS products (
            product_id INT(4) ZEROFILL AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            category_id INT NOT NULL,
            brand_id INT NOT NULL,
            status ENUM('0', '1') NOT NULL DEFAULT '1',     -- 1 : còn hàng ,  0: hết hàng
            FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE,
            FOREIGN KEY (brand_id) REFERENCES brands(brand_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1001;";

        try {
            $this->db->query($sql);
            echo "Bảng `products` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    // private function random_id()
    // {
    //     return $randomNumber = random_int(100000, 999999);
    // }

    public function seed()
    {
        $sql = "INSERT INTO products (name, description, category_id, brand_id, status) VALUES (?, ?, ?, ?, ?)";
        $data = [
            ['iPhone', 'Điện thoại Apple iPhone 13', 1, 1, '1'],
            ['Samsung', 'Điện thoại Samsung Galaxy S21', 1, 2, '1'],
            ['Sony', 'Tai nghe Sony WH-1000XM4', 4, 3, '1']
        ];

        foreach ($data as $params) {
            try {
                // $id_random = $this->random_id();
                // array_unshift($params, $id_random);

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