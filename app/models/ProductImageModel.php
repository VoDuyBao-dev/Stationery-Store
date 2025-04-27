<?php
class ProductImageModel extends Model
{
    private $_table = 'product_images';

    public function insertProductImage($product_id, $image_url)
    {
        $sql = "INSERT INTO $this->_table (`product_id`, `image_url`) VALUES (?, ?)";
        $params = [$product_id, $image_url];
        try {
            return $this->execute($sql, $params);
        } catch (Exception $e) {
            return false;
        }
    }

    // Cập nhật ảnh sản phẩm

    public function deleteProductImageID($product_id)
    {
        $sql = "DELETE FROM $this->_table WHERE product_id = ?";
        $params = [$product_id];
        try {
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            } else {
                return "Xóa ảnh product thất bại!";
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
    }
}
