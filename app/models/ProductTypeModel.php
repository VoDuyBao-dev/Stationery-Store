<?php
class ProductTypeModel extends Model
{
    private $_table = 'product_type';
    
    public function insertProductType($productId, $name, $image, $priceCurrent, $stock_quantity)
    {
        $sql = "INSERT INTO $this->_table (`product_id`, `name`, `image`, `priceCurrent`, `stock_quantity`) VALUES (?, ?, ?, ?, ?)";
        $params = [$productId, $name, $image, $priceCurrent, $stock_quantity];
        try{
            return $this->execute($sql, $params);
        }catch (Exception $e) {
            return false;
        }
         
    }

    public function getAllProductType($vt,$sd)
    {
        $sql = "SELECT p.product_id, p.name AS product_name, c.name as name_category, pt.product_type_id, pt.image, pt.priceOld, pt.priceCurrent, pt.stock_quantity, pt.status
            FROM products p
            JOIN product_type pt 
                ON pt.product_id = p.product_id 
			join categories c
            on p.category_id = c.category_id
            order by p.product_id asc
             LIMIT ?,?";
          $params = [$vt,$sd];
       return $this->fetchAll($sql,$params);
         
    }

    public function deleteProductType($productType_id) {
        $sql = "DELETE FROM $this->_table WHERE product_type_id = ?";
        $params = [$productType_id];
        try{
           $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            } else {
                return false;
            }
        }catch (Exception $e) {
            return false;
        }

    }

    public function getAllProductType_ofProductID($product_id)
    {
        $sql = "SELECT product_type_id, pt.name as productType_name, priceCurrent, priceCurrent, stock_quantity, image
            FROM product_type pt 
            JOIN products p
                ON pt.product_id = p.product_id
            WHERE p.product_id = ?
            order by product_type_id asc";
        $params = [$product_id];
       return $this->fetchAll($sql, $params);
         
    }

    // Cập nhật loại sản phẩm
    public function updateProductTypeID($name, $image, $priceCurrent, $priceOld,$stock_quantity,$discount,$product_type_id)
    {
        $sql = "UPDATE product_type
        SET 
            name = ?,
            image = ?,
            priceCurrent = ? ,
            priceOld = ?,
            stock_quantity = ?,
            discount_price = ?
        WHERE product_type_id = ?";
        $params = [$name, $image, $priceCurrent, $priceOld,$stock_quantity,$discount,$product_type_id];
        try {
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            } else {
                return "Cập nhật loại sản phẩm thất bại!";
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
         
    }

    public function countProductType()
    { 
        $sql = "SELECT count(product_type_id) as count FROM $this->_table";
     
        $result = $this->fetch($sql);

        return $result;
    }



    
}
?>