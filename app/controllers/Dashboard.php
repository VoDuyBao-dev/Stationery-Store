<?php

class Dashboard extends Controller
{

    private $userModel;
    private $orderModel;
    private $productModel;
    public function home()
    {
        $this->validateAdmin();
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
        $this->productModel = $this->model('ProductModel');
        $newsUSer = $this->userModel->getAllnewUser();
        $countUSer = $this->userModel->countUser();
        $countOrder = $this->orderModel->countOrder();
        $countProduct = $this->productModel->countProduct();
        $data = [
            'newsUSer' => $newsUSer,
            'countUSer' => $countUSer,
            'countOrder' => $countOrder,    
            'countProduct' => $countProduct  

        ];
        
        $this->render("layouts/admin_layout", $data);
    }
}
