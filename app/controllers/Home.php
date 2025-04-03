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
        $this->render("layouts/client_layout");
    }

    public function getHomeID($id)
    {
        $data[] = $this->homeModel->getDetail($id);
        print_r($data);
    }
}
