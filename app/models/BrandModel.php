<?php
class BrandModel extends Model
{
    private $_table = 'brands';
    
    public function getAllBrand()
    {
        $sql = "SELECT brand_id, name FROM $this->_table ORDER BY brand_id ASC";
        

        $result = $this->fetchAll($sql);
        return $result;
    }
}
?>