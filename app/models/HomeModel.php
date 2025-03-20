<?php

//Kế thừa từ class Model
class HomeModel extends Model
{
    protected $_table = 'users';

//    Nếu lớp con có hàm khởi tạo thì phải gọi hàm khơỉ tạo của lớp cha
// còn không có thì thôi
//    public function __construct()
//    {
//        parent::__construct();
//    }

    public function getList()
    {
        $data = $this->db->query("SELECT * FROM $this->_table");
        while ($row = $data->fetch_assoc()) {
            $list_data[] = $row;
        }
        return $list_data;
    }

    public function getDetail($id)
    {
        $data = [
            'Item1', 'Item2', 'Item3', 'Item4'
        ];

        return $data[$id];
    }
}