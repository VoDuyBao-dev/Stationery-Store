<?php

//Kế thừa lại Controller bên core để dùng method của nó
class Home extends Controller
{
    public $homeModel;

    public function __construct()
    {
        $this->homeModel = $this->model("HomeModel");
    }

    public function index()
    {
        $data[] = $this->homeModel->getList();
//        print_r($data);
        echo 'home index';
    }

    public function getHomeID($id)
    {
        $data[] = $this->homeModel->getDetail($id);
        print_r($data);
       
    }


}