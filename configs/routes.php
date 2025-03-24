<?php
$routes['default_controller'] = 'home';

// Đường dẫn ảo trỏ đến đường dẫn thật
// đường dẫn ảo là key còn đường dẫn thật là value

$routes['register'] = 'user/register';
$routes['signin'] = 'user/signin';
$routes['enter-otp'] = 'user/verifyOTP';
$routes['resend-otp'] = 'user/resendOTP';
$routes['forgot-pass'] = 'user/forgot_pass';
$routes['new-pass'] = 'user/newpass';
// $routes[''] = 'user/home';



//trang client_layout
$routes['client_layout'] = 'dashboard/index';

$routes['san-pham'] = 'product/index';
$routes['nha_cung_cap'] = 'Categorie';

$routes['trang-chu'] = 'home';


?>