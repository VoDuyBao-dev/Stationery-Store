<?php

class Dashboard extends Controller
{
   

    public function home()
    {
        $this->render("layouts/admin_layout");
    }

    public function testLayoutADmin()
    {
        $this->render("layouts/layout_admin_test");
    }
}