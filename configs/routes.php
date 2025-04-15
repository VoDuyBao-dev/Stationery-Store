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

$routes['chinh-sua-thong-tin'] = 'user/chinhsua';
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



$routes['thanh-toan'] = 'user/UserInfor_Payment';
// // Xử lý form đc thông tin người dùng thanh toán do ajax gửi request lên
$routes['handleUserInfor_Payment'] = 'user/handleUserInfor_Payment';

// Xử lý form thông tin phương thức thanh toán và vận chuyển do ajax gửi request lên
$routes['processPayment'] = 'payment/initPayment';

// thanh toán VNPAY
$routes['handleVNPayCallback'] = 'payment/handleVNPayCallback';

// thanh toán Momo
$routes['handleMomoRedirect'] = 'MomoController/handleMomoRedirect';
$routes['handleMomoIPN'] = 'MomoController/handleMomoIPN';
$routes['handleMomoCallback'] = 'payment/handleMomoCallback';



$routes['qlsp'] = 'AdminManageUser/qlsp';
$routes['taosp'] = 'AdminManageUser/taosp';


// 1cái page not found
$routes['all_product'] = 'product/sanpham';
$routes['phan-hoi'] = 'user/reply';
$routes['kqtim-kiem'] = 'user/search';
$routes['notfound'] = 'user/notfound';



//trang admin_layout
$routes['admin_layout'] = 'dashboard/home';





// Chat giữa admin và khách hàng
$routes['^chat/([0-9]+)$'] = 'chat/detail/$1';
$routes['beginChat'] = 'chat/beginChat';
$routes['sendMessage'] = 'chat/sendMessage';

// Trang khuyến mãi
$routes['sale'] = 'Coupon/khuyenmai';
$routes['store'] = 'Coupon/store';
$routes['^show/([0-9]+)$'] = 'Coupon/show/$1';
$routes['update'] = 'Coupon/update';
$routes['destroy'] = 'Coupon/destroy';

// Trang quản lý đơn hàng của admin (xác nhận đơn hàng, giao hàng, đã giao thành công, bị hủy)
$routes['canxuly'] = 'AdminProduct/canxuly';       // toàn bộ order có trangThaiGiao != 3
$routes['^detailOrder/([0-9]+)$'] = 'AdminProduct/detailOrder/$1';     // chi tiết đơn hàng (có nhiều loại sản phẩm)
$routes['^getOrderDetail/([0-9]+)$'] = 'AdminProduct/getOrderDetail/$1';   // hiển thị trang sửa từng loại sản phẩm (từng bản ghi của order_detail)
$routes['updateOrderDetail'] = 'AdminProduct/updateOrderDetail';            // cập nhật lại đơn hàng (có nhiều loại sản phẩm)
$routes['destroyOrder'] = 'AdminProduct/destroy';            // xóa đơn hàng có trangThaiGiao == 2 (đã hủy)

$route['^viewOrder/([0-9]+)$'] = 'AdminProduct/viewOrder/$1';     // xem chi tiết đơn hàng (có nhiều loại
$routes['updateOrder'] = 'AdminProduct/updateOrder';
$routes['daxuly'] = 'AdminProduct/done';
