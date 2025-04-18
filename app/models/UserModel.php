<?php

use app\Logger;
class UserModel extends Model
{
    private $_table = 'users';


    // vừa kiểm tra vừa lấy đối tượng
    public function checkEmailExists($email)
    {
        $sql = "SELECT * FROM $this->_table WHERE LOWER(email)  = LOWER(?) ";
        $params = [$email];
        $result = $this->fetch($sql, $params);

        return $result;
    }

    public function checkSDTExists($sdt)
    {
        $sql = "SELECT * FROM $this->_table WHERE phone = ? ";
        $params = [$sdt];
        $result = $this->fetch($sql, $params);

        return $result ? true : false;

    }
    
   

    public function checkSDTExists2($sdt, $id)
    {
        $sql = "SELECT * FROM $this->_table WHERE phone = ? AND user_id != ? ";
        $params = [$sdt, $id];
        $result = $this->fetch($sql, $params);

        return $result ? true : false;
    }

    public function checkIDExists($id)
    {
        $sql = "SELECT * FROM $this->_table WHERE user_id = ? ";
        $params = [$id];
        $result = $this->fetch($sql, $params);

        return $result ? true : false;
    }

    public function insertUser($fullname, $sdt, $email, $password)
    {

        $sql = "INSERT INTO $this->_table(password, fullname, email, phone) VALUES(?,?,?,?)";
        $params = [$password, $fullname, $email, $sdt];

        $affectedRows = $this->execute($sql, $params);
        if ($affectedRows > 0) {
            return true;
        } else {
            return "Đăng ký thất bại!";
        }

    }

    function insertUser_Google($fullname,$email,$google_id){
       
    
        $sql="INSERT INTO $this->_table(fullname,email,google_id)VALUES(?, ?, ?)";
        $params = [$fullname,$email,$google_id];

        $affectedRows = $this->execute($sql, $params);
        if ($affectedRows > 0) {
            return true;
        } else {
            return "Đăng ký người dùng google thất bại!";
        }
        
    
    }

    public function verifyUser($email, $input_password)
    {
        $account = $this->checkEmailExists($email);
        if ($account) {
            $password_account = $account['password'];
            if (password_verify($input_password, $password_account)) {
                return $account;
            } else {
                return "Email hoặc mật khẩu không đúng!";
            }

        } else {
            return "Tài khoản không tồn tại!";
        }
    }

    public function changePassword($email, $new_password)
    {
        $sql = "UPDATE $this->_table SET password = ? WHERE email = ?";
        $params = [$new_password, $email];
        $affectedRows = $this->execute($sql, $params);
        if ($affectedRows > 0) {
            return true;
        } else {
            return "Đổi mật khẩu thất bại!";
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->_table WHERE status = '1' AND role != 'admin'";
        
        $result = $this->fetchAll($sql);
        if(!$result){
            return false;
        }
        return $result;
    }

    public function getAllUsersLock()
    {
        $sql = "Select * from $this->_table where status = '0' AND role != 'admin'";
        $result = $this->fetchAll($sql);
        if(!$result){
            return false;
        }
        return $result;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM $this->_table WHERE user_id = ?";
        $params = [$id];
        $result = $this->fetch($sql, $params);
        if(empty($result)){
            return false;
        }
        return $result;
    }



    public function lockUser($id)
    {
        $sql = "UPDATE users SET status = '0' WHERE user_id = ?";
        $params = [$id];
        try{
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            }
        }catch (Exception $e) {
            Logger::logError("Lỗi khi khóa user: " . $e->getMessage());
            return false;
        }
       
    }

    public function unlockUser($id)
    {
        $sql = "UPDATE users SET status = '1' WHERE user_id = ?";
        $params = [$id];
        try{
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            }
        }catch (Exception $e) {
            Logger::logError("Lỗi khi mở khóa user: " . $e->getMessage());
            return false;
        }
       
    }

    public function updateInformation($fullname, $sdt, $address, $id){
        $sql = "UPDATE users SET fullname = ?, phone = ?, address = ? WHERE user_id = ?";
        $params = [$fullname,$sdt,$address,$id];

        $affectedRows = $this->execute($sql, $params);
        return $affectedRows>0;
    }


}