
<?php

class TransportModel extends Model
{
    private $_table = 'transport';

    public function getAllTransport()
    {
        $sql = "Select * from $this->_table";
        $result = $this->fetchAll($sql);
        return $result;
    }

    public function getTransportById($transport_id)
    {
        $sql = "Select price from $this->_table where transport_id = ?";
        $params = [$transport_id];
        $result = $this->fetch($sql, $params);
        return $result;
    }
}
?>