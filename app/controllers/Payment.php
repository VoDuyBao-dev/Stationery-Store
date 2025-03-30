<?php


//Kế thừa lại Controller bên core để dùng method của nó
class Payment extends Controller
{
    public function index()
    {
        $this->render("users/Payment");
    }


}