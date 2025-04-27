<?php
class CategoryModel extends Model
{
    private $_table = 'categories';

    public function getAllCategory()
    {
        $sql = "SELECT category_id, name  FROM $this->_table ORDER BY category_id ASC";

        $result = $this->fetchAll($sql);
        return $result;
    }
}
