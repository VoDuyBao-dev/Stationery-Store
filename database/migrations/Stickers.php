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
            ['khong', ''],
            ['Sticker 1', __DIR__ . '/../../public/assets/clients/images/sticker/1.png'],
            ['Sticker 2', __DIR__ . '/../../public/assets/clients/images/sticker/2.png'],
            ['Sticker 3', __DIR__ . '/../../public/assets/clients/images/sticker/3.png'],
            ['Sticker 4', __DIR__ . '/../../public/assets/clients/images/sticker/4.png'],
            ['Sticker 5', __DIR__ . '/../../public/assets/clients/images/sticker/5.png'],
            ['Sticker 6', __DIR__ . '/../../public/assets/clients/images/sticker/6.png'],
            ['Sticker 7', __DIR__ . '/../../public/assets/clients/images/sticker/7.png'],
            ['Sticker 8', __DIR__ . '/../../public/assets/clients/images/sticker/8.png'],
            ['Sticker 9', __DIR__ . '/../../public/assets/clients/images/sticker/9.png'],
            ['Sticker 10', __DIR__ . '/../../public/assets/clients/images/sticker/10.png']
        ];
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
