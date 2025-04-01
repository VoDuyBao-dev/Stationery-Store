<?php

class ProductModel extends Model
{
    public function getList()
    {
        return [
            'Sản phẩm 1',
            'Sản phẩm 2',
            'Sản phẩm 3',
            'Sản phẩm 4',
        ];
    }
    // gợi ý các sản phẩm liên quan
    public function getRelatedProducts($product_id, $category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ? AND product_id != ? LIMIT 5";
        return $this->query($sql, [$category_id, $product_id]);
    }
}
