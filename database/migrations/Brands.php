<?php
class Brands
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);


        $sql = "CREATE TABLE IF NOT EXISTS brands (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL UNIQUE,
            description TEXT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `brands` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO brands (id, name, description) VALUES (?, ?, ?)";
        $data = [
            [1, 'Apple', 'Thương hiệu Apple'],
            [2, 'Samsung', 'Thương hiệu Samsung'],
            [3, 'Sony', 'Thương hiệu Sony'],
            [4, 'LG', 'Thương hiệu LG']
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `brands` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `brands`: " . $e->getMessage() . "\n";
            }
        }
    }
}
