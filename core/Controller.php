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
        }
    }
}