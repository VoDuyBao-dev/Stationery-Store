<?php
// trang chu
$routes['trang-chu'] = 'product/index';

// Đường dẫn ảo trỏ đến đường dẫn thật
// đường dẫn ảo là key còn đường dẫn thật là value
$routes['handle-otp'] = 'user/handle_action_OTP';
// Lỗi trang này
$routes['nhap-otp'] = 'user/nhap_otp';

$routes['dang-ky'] = 'user/register';
$routes['register_user'] = 'user/registerUser';
$routes['resend-otp'] = 'user/resendOTP';
$routes['dang-nhap'] = 'user/signin';

// xử lí đăng nhập bằng google
$routes['handleLogin_google'] = 'GoogleController/handleLogin_google';


$routes['dang-xuat'] = 'user/signout';
$routes['forgot_pass'] = 'user/forgot_pass';
$routes['change_password'] = 'user/change_password';

$routes['chinh-sua-thong-tin'] = 'user/editInfomation';
// Lấy các sản phẩm tùy vào lưaj chọn danh mục ở Văn phòng phẩm cho bạn ở trang chủ
$routes['getProductsBy_category'] = 'product/getProductsBy_category';




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



$routes['thanh-toan'] = 'cart/getTransport_Payment';
// // Xử lý form đc thông tin người dùng thanh toán do ajax gửi request lên
$routes['handleUserInfor_Payment'] = 'user/handleUserInfor_Payment';

// xử lý giá vận chuyển và coupon và tổng tiền phải thanh toán do ajax gửi request lên
$routes['calculateTotal'] = 'payment/calculateTotal';

// Xử lý form thông tin phương thức thanh toán và vận chuyển do ajax gửi request lên
$routes['processPayment'] = 'payment/initPayment';

// thanh toán VNPAY
$routes['handleVNPayCallback'] = 'payment/handleVNPayCallback';

// thanh toán Momo
$routes['handleMomoRedirect'] = 'MomoController/handleMomoRedirect';
$routes['handleMomoIPN'] = 'MomoController/handleMomoIPN';
$routes['handleMomoCallback'] = 'payment/handleMomoCallback';


$routes['qlsp'] = 'product/allProducts';
$routes['taosp'] = 'product/createProduct';
$routes['daxuly'] = 'AdminManageUser/done';
$routes['canxuly'] = 'AdminManageUser/canxuly';
$routes['sale'] = 'AdminManageUser/khuyenmai';

// xong
$routes['productByCategory'] = 'product/productByCategory';
// sản phẩm bán chạy ở danh mục nổi bật
$routes['allBestSelling'] = 'product/allBestSelling';

$routes['phan-hoi'] = 'user/reply';
// xong
$routes['kqtim-kiem'] = 'product/resultSearch';
// bỏ trang not found này
$routes['notfound'] = 'product/notfound';



//trang admin_layout
$routes['admin_layout'] = 'dashboard/home';


?>

<!-- sửa sản phẩm dành cho bạn, quản lý user vs giỏ hàng -->