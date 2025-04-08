
// Hàm kiểm tra và gửi form
function validateAndSubmit(event) {
    // Kiểm tra nếu không có phương thức thanh toán được chọn
    var paymentMethod = document.querySelector("input[name='payment']:checked");

    var fullname = document.getElementById("fullname").value.trim();
    var phone = document.getElementById("phone").value.trim();

    if(fullname ===""){
        alert('Bạn phải nhập đầy đủ họ tên!');
        event.preventDefault(); 
        return false;
    }

    if(phone ===""){
        alert('Bạn phải nhập đầy đủ số điện thoại!');
        event.preventDefault();
        return false;
    }

    if(isValidPhone(phone) === false){
        alert('Số điện thoại không hợp lệ!');
        event.preventDefault();
        return false;
    }
    if (!paymentMethod) {
        // Nếu không có gì được chọn, hiển thị thông báo lỗi
        alert('Bạn phải chọn phương thức thanh toán!');
        event.preventDefault(); // Ngừng việc gửi form
        return false;
    }

    // Nếu đã chọn phương thức thanh toán, tiếp tục gọi submitBothForms
    submitBothForms(); // Gọi hàm gửi form cả hai dữ liệu người dùng và thanh toán
    event.preventDefault(); // Ngừng việc gửi form mặc định, vì đã gửi qua AJAX
}

function isValidPhone(phone) {
    
    var phoneRegex = /^(0|\+84)(\d{9,10})$/; 
    return phoneRegex.test(phone);
}

 // Gắn hàm validateAndSubmit() vào sự kiện click của nút "ĐẶT HÀNG"
document.getElementById('checkout-btn').addEventListener('click', validateAndSubmit);

function submitBothForms() {
    // Lấy dữ liệu từ form người dùng
    var userFormData = new FormData(document.getElementById('checkout-form'));
   
    // Thu thập dữ liệu từ phương thức vận chuyển và phương thức thanh toán
    var shippingMethod = document.getElementById("shipping").value;  // Phương thức vận chuyển
    var paymentMethod = document.querySelector("input[name='payment']:checked") ? document.querySelector("input[name='payment']:checked").value : null; // Phương thức thanh toán

    // Thêm dữ liệu phương thức vận chuyển và thanh toán vào FormData
    userFormData.append("shipping", shippingMethod);
    userFormData.append("payment", paymentMethod);
    console.log(userFormData);
    // Tạo đối tượng XMLHttpRequest để gửi dữ liệu đến UserController
    var xhr = new XMLHttpRequest();
    xhr.open("POST",  _WEB_ROOT + "/handleUserInfor_Payment", true);
    
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText); // Giả sử bạn trả về JSON từ UserController

            if (response.success) {
               
                // Dữ liệu người dùng đã gửi thành công, tiếp tục gửi dữ liệu thanh toán
                var paymentXhr = new XMLHttpRequest();
                paymentXhr.open("POST", _WEB_ROOT + "/processPayment", true);
                
                paymentXhr.onload = function () {
                    if (paymentXhr.status === 200) {
                        var paymentResponse = JSON.parse(paymentXhr.responseText); // Giả sử bạn trả về JSON từ PaymentController

                        if (paymentResponse.success) {
                            alert('Đặt hàng thành công!');
                        } else {
                            alert('Lỗi: ' + paymentResponse.message);
                        }
                    } else {
                        alert('Lỗi gửi yêu cầu thanh toán');
                    }
                };
                
                paymentXhr.send(userFormData); // Gửi dữ liệu đến PaymentController
            } else {
                alert('Lỗi: ' + response.error);
            }
        } else {
            alert('Lỗi gửi yêu cầu người dùng');
        }
    };

    xhr.send(userFormData); // Gửi dữ liệu người dùng
}

