<?php

class Dashboard extends Controller
{


    public function home()
    {
        $this->validateAdmin();
        $this->render("layouts/admin_layout");
    }
}
