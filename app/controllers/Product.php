<?php

class Product extends Controller
{
    public $productModel;
    public $data = [];

    public function __construct()
    {
        echo "index product";
        $this->productModel = $this->model("ProductModel");
    }

    public function index()
    {
        $list_product = $this->productModel->getList();
        $this->data["list_product"] = $list_product;
        $this->data["title"] = "Test chức năng biến key thành biến nè";


//            Render ra views
        $this->render("products/list", $this->data);
    }

    public function detail()
    {
        $this->data["content"] = "products/detail";

        $this->render("layouts/client_layout", $this->data);
    }


}