<?php


class Product_images
{
    private $db;
    public function up()
    {
        global $config;
        $this->db = new Database($config['database']);

        $sql = "CREATE TABLE IF NOT EXISTS product_images (
            product_image_id INT AUTO_INCREMENT PRIMARY KEY,
            product_type_id INT NOT NULL,
            image_url VARCHAR(255) DEFAULT NULL,
            FOREIGN KEY (product_type_id) REFERENCES product_type(product_type_id)  ON DELETE CASCADE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->db->query($sql);
            echo "Bảng `product_images` đã được tạo thành công!\n";
            $this->seed();
        } catch (mysqli_sql_exception $e) {
            echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage();
            throw $e;
        }
    }

    public function seed()
    {
        $sql = "INSERT INTO product_images (product_type_id, image_url) VALUES(?, ?)";
        $data = [
            [1,  __DIR__ . '/../../public/assets/clients/images/sticker/1.png'],
            [1,  __DIR__ . '/../../public/assets/clients/images/sticker/2.png'],
            [2,  __DIR__ . '/../../public/assets/clients/images/sticker/3.png'],
            [2,  __DIR__ . '/../../public/assets/clients/images/sticker/4.png'],
            [3,  __DIR__ . '/../../public/assets/clients/images/sticker/5.png'],
            [3,  __DIR__ . '/../../public/assets/clients/images/sticker/6.png']
        ];
        foreach ($data as $params) {
            try {
                $this->db->execute($sql, $params);
                echo "Dữ liệu mẫu cho bảng `product_images` đã được tạo thành công!\n";
            } catch (mysqli_sql_exception $e) {
                echo "Lỗi khi tạo dữ liệu mẫu cho bảng `product_images`: " . $e->getMessage() . "\n";
            }
        }
    }
}
