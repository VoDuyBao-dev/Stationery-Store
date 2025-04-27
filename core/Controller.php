<?php


//Base controller: không cần require_once và khởi tạo object nhiều lần. tạo sự tiện nghi
class Controller
{
    public function model($model)
    {
        if (file_exists(_DIR_ROOT . "/app/models/" . $model . ".php")) {
            require_once _DIR_ROOT . "/app/models/" . $model . ".php";
            if (class_exists($model)) {
                return new $model();
            }
        }
        return false;
    }

//    Render
//Vì mỗi view sẽ có data hoặc không => khai báo data dạng mảng
    public function render($view, $data = [])
    {
//        để không phải lúc nào cũng dùng mỗi biến $data
//        mà muốn dùng nhiều tên biến để gọi data theo key bên trong mảng data => dùng extract
        extract($data); // Chuyển các key trong mảng thành biến
        if (file_exists(_DIR_ROOT . "/app/views/" . $view . ".php")) {
            require_once _DIR_ROOT . "/app/views/" . $view . ".php";

        } else {
            echo "sai url";
        }


    }

    public function getValue_ofArrayParams($params)
    {
        $count_valueParams = count($params);
        if ($count_valueParams >= 3) {
            // Lọc ra các giá trị số
            $numericValues = array_filter($params, 'is_numeric');
            // đưa mảng về đúng định dạng
            $numericValues = array_values($numericValues);

            $secondLastValue = $params[count($params) - 2];
            // Lấy giá trị cuối
            $lastValue = end($params);
            $value = [
                'secondLastValue' => $secondLastValue,
                'lastValue' => $lastValue
            ];

            return $value;
        }
        return false;

    }

    public function validateAdmin(){
        if((!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin') )){
            header("Location:" . _WEB_ROOT. "/dang-nhap");
            exit();
        }
    }
    public function validateUser(){
        if((!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'user') )){
            header("Location:" . _WEB_ROOT. "/dang-nhap");
            exit();
        }
    }

    public function checkLogin(){
        if((!isset($_SESSION['user']))){
            header("Location:" . _WEB_ROOT. "/dang-nhap");
            exit();
        }


    }

    

    


}