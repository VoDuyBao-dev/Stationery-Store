<?php

class Categories
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);


        $sql = "CREATE TABLE IF NOT EXISTS categories (
            category_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL UNIQUE,
            description TEXT  DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `categories` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $data = [
            ['Điện thoại', 'Danh mục điện thoại di động'],
            ['Máy tính bảng', 'Danh mục máy tính bảng'],
            ['Laptop', 'Danh mục laptop'],
            ['Phụ kiện', 'Danh mục phụ kiện điện thoại, máy tính']
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `categories` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `categories`: " . $e->getMessage() . "\n";
            }
        }
    }
}
