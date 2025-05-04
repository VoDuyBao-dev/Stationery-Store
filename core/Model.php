<?php

// Base Model
class Model extends Database
{
//    để các lớp con kế thừa
    protected $db;

    public function __construct()
    {
        parent::__construct();

    }
}