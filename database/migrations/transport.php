<?php

class transport
{
    private $db;

    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS transport (
            transport_id VARCHAR(50) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,      -- Tên phương thức vẫn chuyển
            price DECIMAL(10,2) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        try {
            $this->db->query($sql);
            echo "Bảng `transport` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }
    public function seed()
    {
        $sql = "INSERT INTO transport (transport_id, name, price) VALUES (?, ?, ?)";
        $data = [
            ['express', 'Chuyển hỏa tốc', 15000],
            ['standard', 'Chuyển trong ngày', 10000],
            ['eco', 'Chuyển tiết kiệm', 5000]
        ];
        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `transport` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `transport`: " . $e->getMessage() . "\n";
            }
        }
    }
}
