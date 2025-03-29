<?php


class Orders
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS orders (
            order_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            total_price INT NOT NULL check(total_price >= 0),     -- tổng tiền
            payment_method ENUM('card', 'momo', 'money') NOT NULL,         -- phương thức thanh toán
            status ENUM('0', '1') NOT NULL DEFAULT '1',           -- 1 : đã thanh toán ,  0: chưa thanh toán
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES Users(user_id)  ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `orders` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO orders (user_id, total_price, payment_method) VALUES ( ?, ?, ?)";
        $data = [
            [1, 115000, 'card'],
            [2, 185000, 'momo'],
        ];

        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `orders` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `orders`: " . $e->getMessage() . "\n";
            }
        }
    }
}
