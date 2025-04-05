<?php

use app\Logger;
class UserModel extends Model
{
    private $_table = 'users';


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

    public function createUser($fullname, $sdt, $email, $password)
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
        $sql = "Select * from $this->_table where status = 1";
        $result = $this->fetchAll($sql);
        if(!$result){
            return false;
        }
        return $result;
    }

    public function getAllUsersLock()
    {
        $sql = "Select * from $this->_table where status = 0";
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

    // public function updateUser($id, $fullname, $sdt, $address)
    // {
    //     $sql = "UPDATE $this->_table SET fullname = ?, phone = ?, address = ? WHERE user_id = ?";
    //     $params = [$fullname, $sdt, $address, $id];

    //     try{
    //         $affectedRows = $this->execute($sql, $params);
    //         if ($affectedRows > 0) {
    //             return true;
    //         } 
    //     }catch (Exception $e) {
    //         Logger::logError("Lỗi khi update user: " . $e->getMessage());
    //         return false;
    //     }

       
        
    // }

    public function lockUser($id)
    {
        $sql = "UPDATE users SET status = 0 WHERE user_id = ?";
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
        $sql = "UPDATE users SET status = 1 WHERE user_id = ?";
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

    


}