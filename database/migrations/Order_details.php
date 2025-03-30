<?php


class Order_details
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS order_details (
            order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            product_type_id INT NOT NULL,
            tenDonHang VARCHAR(100) NOT NULL,
            phone VARCHAR(11) NOT NULL, 
            address VARCHAR(500) NOT NULL,
            ghiChu TEXT DEFAULT NULL,
            cost DECIMAL(10,2) NOT NULL,       -- giá sản phẩm
            quantity INT NOT NULL,             -- số lượng sản phẩm
            coupon_id INT NULL,           -- mã giảm giá
            transport_id INT NOT NULL,
            price DECIMAL(10,2) NOT NULL,      -- giá sau khi giảm giá
            FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
            FOREIGN KEY (product_type_id) REFERENCES product_type(product_type_id) ON DELETE CASCADE,
            FOREIGN KEY (transport_id) REFERENCES transport(transport_id) ON DELETE CASCADE,
            FOREIGN KEY (coupon_id) REFERENCES coupons(coupon_id) ON DELETE SET NULL,
            check(quantity >= 0 and price >= 0)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `order_details` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO order_details (order_id, product_type_id,tenDonHang, phone, address,  ghiChu, cost, quantity, coupon_id, transport_id, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?, ?)";
        $data = [
            [1, 1, "don hang 1", "0762358945", "dia chi", "hien tai khogn co ghi chu", 100000, 1, 2, 1, 115000],
            [2, 2, "don hang 2", "0258946712", "khognbietnx", "kh co", 200000, 2, 3, 2, 185000]
        ];



        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `order_details` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `order_details`: " . $e->getMessage() . "\n";
            }
        }
    }
}
