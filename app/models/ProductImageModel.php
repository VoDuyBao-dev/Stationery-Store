<?php
class ProductImageModel extends Model
{
    private $_table = 'product_images';
    
    public function insertProductImage($product_id, $image_url)
    {
        $sql = "INSERT INTO $this->_table (`product_id`, `image_url`) VALUES (?, ?)";
        $params = [$product_id, $image_url];
        try{
            return $this->execute($sql, $params);
        }catch (Exception $e) {
            return false;
        }
         
    }
    
}
?>