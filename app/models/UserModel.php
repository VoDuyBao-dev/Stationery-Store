<?php

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

    public function createUser($ho, $ten, $sdt, $email, $password)
    {

        $sql = "INSERT INTO $this->_table(password, ten, ho, email, phone) VALUES(?,?,?,?,?)";
        $params = [$password, $ten, $ho, $email, $sdt];

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

}