
<?php

class TransportModel extends Model
{
    private $_table = 'transport';

    public function getAllTransport()
    {
        $sql = "Select * from $this->_table";
        $result = $this->fetchAll($sql);
        if(!$result){
            return false;
        }
        return $result;
    }
}
?>