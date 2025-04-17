<?php


session_start();
if(!isset($_SESSION['giohang'])){
    $_SESSION['giohang'] = [];
}

require_once "bootstrap.php";

$app = new App();



