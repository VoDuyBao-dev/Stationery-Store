<?php
class PaymentInformationModel extends Model
{
    private $_table = 'payment_information';
    
    public function saveTransaction($information){
        $sql = "INSERT INTO $this->_table(information) VALUES(?)";
        $params = [$information];

        $affectedRows = $this->execute($sql, $params);
        if ($affectedRows > 0) {
            return $this->getInsertId();//tra về id của order vừa tạo
        } else {
            return "Tạo thông tin thanh toán thất bại!";
        }

    }

   
}

?>