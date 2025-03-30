<?php


class Stickers
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS stickers (
                sticker_id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,      -- Tên sticker
                image_url VARCHAR(500) NOT NULL  -- Đường dẫn ảnh sticker
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
        $sql = "INSERT INTO stickers (name, image_url) VALUES (?, ?)";
        $data = [
            ['khong', '']
        ];
        for ($i = 1; $i < 33; $i++) {
            $s = ["Sticker " . $i];
            $tmp = __DIR__ . '/../../public/assets/clients/images/sticker/' . $i . '.png';
            array_push($s, $tmp);
            array_push($data, $s);
        }
        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `stickers` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `stickers`: " . $e->getMessage() . "\n";
            }
        }
    }
}
