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
$routes['manage_users'] = 'AdminManage/listuser';



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


$routes['quan-ly-san-pham'] = 'AdminManage/qlsp';
$routes['them-san-pham'] = 'AdminManage/addProduct';


// xong
$routes['productByCategory'] = 'product/productByCategory';
// sản phẩm bán chạy ở danh mục nổi bật
$routes['allBestSelling'] = 'product/allBestSelling';

$routes['phan-hoi'] = 'user/reply';
// xong
$routes['kqtim-kiem'] = 'product/resultSearch';
// bỏ trang not found này
$routes['notfound'] = 'product/notfound';


// Danh sách đơn hàng của user
$routes['danh-sach-don-hang'] = 'order/orderList';

// tìm kiếm đơn hàng của user
$routes['tim-kiem-don-hang'] = 'order/searchOrder';

// Hủy đơn hàng phía user
$routes['huy-don-hang'] = 'order/cancelOrder';

//trang admin_layout
$routes['admin_layout'] = 'dashboard/home';

// endpoint trả dữ liệu báo doanh thu cho fetch
$routes['bao-cao-doanh-thu'] = 'ReportController/getRevenueData';
// export excel
$routes['bao-cao-doanh-thu/export'] = 'ReportController/exportExcel';

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
$routes['daxuly'] = 'AdminOrder/done';

$routes['canxuly'] = 'AdminOrder/canxuly';       // toàn bộ order có trangThaiGiao != 3
$routes['^detailOrder/([0-9]+)$'] = 'AdminOrder/detailOrder/$1';     // chi tiết đơn hàng (có nhiều loại sản phẩm)
$routes['xacnhan'] = 'AdminOrder/xacnhan';                // xác nhận đơn hàng và chuyển sang trạng thái đang giao hàng
$routes['^viewOrder/([0-9]+)$'] = 'AdminOrder/viewOrder/$1';     // xem chi tiết đơn hàng (có nhiều loại
$routes['suaDon'] = 'AdminOrder/suaDon';
$routes['huyDon'] = 'AdminOrder/huyDon';
$routes['xoaDon'] = 'AdminOrder/xoaDon';            // xóa đơn hàng có trangThaiGiao == 2 (đã hủy)

$routes['^getOrderDetail/([0-9]+)$'] = 'AdminOrder/getOrderDetail/$1';   // hiển thị trang sửa từng loại sản phẩm (từng bản ghi của order_detail)
$routes['updateOrderDetail'] = 'AdminOrder/updateOrderDetail';            // cập nhật lại đơn hàng (có nhiều loại sản phẩm)
$routes['deleteDetail'] = 'AdminOrder/deleteDetail';            // cập nhật lại đơn hàng (có nhiều loại sản phẩm)







