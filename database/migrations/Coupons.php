<?php


class Coupons
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS coupons (
            coupon_id INT AUTO_INCREMENT PRIMARY KEY,
            price_min DECIMAL(10,2) NOT NULL DEFAULT 0,       -- giá tối thiểu để sử dụng mã giảm giá
            discount INT DEFAULT 0,                           -- phần trăm giảm giá
            start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            end_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            status ENUM('0', '1') NOT NULL DEFAULT '1',   -- 1 : còn hạn ,  0: hết hạn
            code VARCHAR(255) NOT NULL,                      -- mã giảm giá
            CHECK(discount BETWEEN 0 AND 100 AND price_min > 0)

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

    private function randomString($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $s = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $s .= $characters[random_int(0, $maxIndex)];
        }

        return $s;
    }

    public function seed()
    {
        $sql = "INSERT INTO coupons (price_min, discount, code) VALUES (?, ?, ?)";
        $data = [
            [1, 0],             // Giá từ o-200 nghìn thì kh giảm
            [200000, 10],
            [300000, 20]
        ];

        foreach ($data as $params) {
            try {
                $random_code = $this->randomString();
                array_push($params, $random_code);

                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `coupons` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `coupons`: " . $e->getMessage() . "\n";
            }
        }
    }
}
