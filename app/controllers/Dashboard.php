<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->render("layouts/client_layout");
    }

    public function home()
    {
        $this->render("layouts/admin_layout");
    }
}