<?php
$routes['default_controller'] = 'home';

// Đường dẫn ảo trỏ đến đường dẫn thật
// đường dẫn ảo là key còn đường dẫn thật là value

$routes['dang-ky'] = 'user/register';
$routes['nhap-otp'] = 'user/verifyOTP';
$routes['resend-otp'] = 'user/resendOTP';
$routes['chat'] = 'user/chat';


//trang client_layout
$routes['client_layout'] = 'dashboard/index';

$routes['san-pham'] = 'product/index';
$routes['nha_cung_cap'] = 'Categorie';

$routes['trang-chu'] = 'home';