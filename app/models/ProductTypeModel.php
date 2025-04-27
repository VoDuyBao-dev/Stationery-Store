<?php
class ProductTypeModel extends Model
{
    private $_table = 'product_type';

    public function insertProductType($productId, $name, $image, $priceCurrent, $stock_quantity)
    {
        $sql = "INSERT INTO $this->_table (`product_id`, `name`, `image`, `priceCurrent`, `stock_quantity`) VALUES (?, ?, ?, ?, ?)";
        $params = [$productId, $name, $image, $priceCurrent, $stock_quantity];
        try {
            return $this->execute($sql, $params);
        } catch (Exception $e) {
            return false;
        }
    }
}
