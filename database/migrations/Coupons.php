<?php


class Coupons
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS coupons (
            id INT AUTO_INCREMENT PRIMARY KEY,
            code VARCHAR(255) NOT NULL,                       -- mã giảm giá
            price_min DECIMAL(10,2) NOT NULL DEFAULT 0,       -- giá tối thiểu để sử dụng mã giảm giá
            discount INT NOT NULL check(discount >= 0),       -- phần trăm giảm giá
            star_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            end_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            status ENUM('0', '1') NOT NULL DEFAULT '1'   -- 1 : còn hạn ,  0: hết hạn
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `coupons` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO coupons (price_min, code, discount) VALUES (?, ?, ?)";
        $data = [
            [1, 'trong', 0],
            [20000, 'ABC123', 10],
            [30000, 'DEF456', 20]
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `coupons` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `coupons`: " . $e->getMessage() . "\n";
            }
        }
    }
}
