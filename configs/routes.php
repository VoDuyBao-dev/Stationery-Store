<?php
$routes['default_controller'] = 'home';

// Đường dẫn ảo trỏ đến đường dẫn thật
// đường dẫn ảo là key còn đường dẫn thật là value
$routes['handle-otp'] = 'user/handle_action_OTP';
// Lỗi trang này
$routes['nhap-otp'] = 'user/nhap_otp';

$routes['dang-ky'] = 'user/register';
$routes['register_user'] = 'user/registerUser';
$routes['resend-otp'] = 'user/resendOTP';


$routes['dang-nhap'] = 'user/signin';
$routes['dang-xuat'] = 'user/signout';
$routes['forgot_pass'] = 'user/forgot_pass';
$routes['change_password'] = 'user/change_password';
$routes['chinh-sua-thong-tin'] = 'user/chinhsua';
// trang chu
$routes['trang-chu'] = 'product/TrangChu';
// test chi tiet san phampham
$routes['thong-tin-sp'] = 'product/productDetail';
// API response
$routes['getProductType'] = 'product/getProductType';

// Gio hang
$routes['handle_cart'] = 'cart/handle_cart';
$routes['view_cart'] = 'cart/view_cart';
$routes['deleteAll_cart'] = 'cart/deleteAll_cart';
$routes['deleteIdProduct_inCart'] = 'cart/deleteIdProduct_inCart';

// Chức năng admin
$routes['manage_users'] = 'AdminManageUser/listuser';
$routes['qlnguoi_dung'] = 'AdminManageUser/nguoidung';
$routes['qlsp'] = 'AdminManageUser/qlsp';
$routes['taosp'] = 'AdminManageUser/taosp';




$routes['thanh-toan'] = 'user/getUserInfo_Payment';
// // Xử lý form đc thông tin người dùng thanh toán do ajax gửi request lên
$routes['handleUserInfor_Payment'] = 'user/handleUserInfor_Payment';
// Xử lý form thông tin phương thức thanh toán và vận chuyển do ajax gửi request lên
$routes['processPayment'] = 'payment/initPayment';

// 1cái page not found
$routes['sanpham'] = 'product/sanpham';
$routes['phan-hoi'] = 'user/reply';
$routes['kqtim-kiem'] = 'user/search';
$routes['notfound'] = 'user/notfound';
//trang client_layout
$routes['client_layout'] = 'dashboard/index';

//trang admin_layout
$routes['admin_layout'] = 'dashboard/home';


$routes['san-pham'] = 'product/index';
$routes['nha_cung_cap'] = 'Categorie';

$routes['trang-chu'] = 'home';


// Chat giữa admin và khách hàng
$routes['^chat/([0-9]+)$'] = 'chat/detail/$1';
$routes['beginChat'] = 'chat/beginChat';
$routes['sendMessage'] = 'chat/sendMessage';
// Trang khuyến mãi
$routes['sale'] = 'Coupon/khuyenmai';
$routes['store'] = 'Coupon/store';
$routes['^update/([0-9]+)$'] = 'Coupon/show/$1';
$routes['update'] = 'Coupon/update';
$routes['destroy'] = 'Coupon/destroy';
// Trang quản lý đơn hàng của admin (xác nhận đơn hàng, giao hàng, đã giao thành công, bị hủy)
$routes['canxuly'] = 'AdminProduct/canxuly';
$routes['^detailOrder/([0-9]+)$'] = 'AdminProduct/detailOrder/$1';
$routes['daxuly'] = 'AdminProduct/done';
$routes['destroyOrder'] = 'AdminProduct/destroy';

$routes['admin/search'] = 'search';
$routes['admin/transport'] = 'transport/index';
$routes['admin/transportHandler'] = 'transport/transportHandler';
