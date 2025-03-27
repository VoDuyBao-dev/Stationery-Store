<?php
$routes['default_controller'] = 'home';

// Đường dẫn ảo trỏ đến đường dẫn thật
// đường dẫn ảo là key còn đường dẫn thật là value
$routes['handle-otp'] = 'user/handle_action_OTP';
$routes['nhap-otp'] = 'user/nhap_otp';

$routes['dang-ky'] = 'user/register';
$routes['register_user'] = 'user/registerUser';
$routes['resend-otp'] = 'user/resendOTP';


$routes['dang-nhap'] = 'user/signin';
$routes['forgot_pass'] = 'user/forgot_pass';
$routes['change_password'] = 'user/change_password';
//trang client_layout
$routes['client_layout'] = 'dashboard/index';

$routes['san-pham'] = 'product/index';
$routes['nha_cung_cap'] = 'Categorie';

$routes['trang-chu'] = 'home';

$routes['^chat/([0-9]+)$'] = 'chat/detail/$1';
$routes['beginChat'] = 'chat/beginChat';
$routes['chat/sendMessage'] = 'chat/sendMessage';
