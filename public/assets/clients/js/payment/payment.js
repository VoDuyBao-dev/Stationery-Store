document.addEventListener('DOMContentLoaded', function () {
    const momoOption = document.getElementById('ewallet');
    const momoExtra = document.getElementById('momo-options');
    const momoQR = document.getElementById('momo_qr'); //  lấy input Quét mã QR
    const paymentRadios = document.querySelectorAll('input[name="payment"]');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (momoOption.checked) {
                momoExtra.style.display = 'block';
                momoQR.checked = true; //  tự động chọn QR khi chọn MoMo
            } else {
                momoExtra.style.display = 'none';
            }
        });
    });
});

function isValidPhone(phone) {
    
    var phoneRegex = /^(0|\+84)(\d{9,10})$/; 
    return phoneRegex.test(phone);
}

// Hàm kiểm tra và gửi form
function validateAndSubmit(event) {
    // Kiểm tra nếu không có phương thức thanh toán được chọn
    var paymentMethod = document.querySelector("input[name='payment']:checked");
    var fullname = document.getElementById("fullname").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var shippingMethod = document.getElementById("shipping").value;

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

    if (shippingMethod === "none") {
        alert('Bạn phải chọn phương thức vận chuyển!');
        event.preventDefault();
        return false;
    }


    if (!paymentMethod) {
        // Nếu không có gì được chọn, hiển thị thông báo lỗi
        alert('Bạn phải chọn phương thức thanh toán!');
        event.preventDefault(); // Ngừng việc gửi form
        return false;
    }

    if(countCart === 0){
        alert('Giỏ hàng của bạn đang trống!');
        event.preventDefault(); // Ngừng việc gửi form
        return false;
    }

    // Nếu đã chọn phương thức thanh toán, tiếp tục gọi submitBothForms
    submitBothForms(); // Gọi hàm gửi form cả hai dữ liệu người dùng và thanh toán
    event.preventDefault(); // Ngừng việc gửi form mặc định, vì đã gửi qua AJAX
}



 // Gắn hàm validateAndSubmit() vào sự kiện click của nút "ĐẶT HÀNG"
document.getElementById('checkout-btn').addEventListener('click', validateAndSubmit);

function submitBothForms() {
    // Lấy dữ liệu từ form người dùng
    var userFormData = new FormData(document.getElementById('checkout-form'));
   
    // Lấy giá trị tổng tiền và xử lý
    var totalElement = document.getElementById('total-amount').innerText;
    var amount = totalElement.split(':')[1]
                             .trim()
                             .replace(/\./g, '')  // Loại bỏ dấu chấm
                             .replace('₫', '')
                             .trim();

    // Thêm số tiền vào FormData
    userFormData.append("tongtien", amount);

    // Thu thập dữ liệu từ phương thức vận chuyển và phương thức thanh toán
    var shippingMethod = document.getElementById("shipping").value;  // Phương thức vận chuyển
    var paymentMethod = document.querySelector("input[name='payment']:checked") ? document.querySelector("input[name='payment']:checked").value : null; // Phương thức thanh toán

    
    // Nếu là thanh toán qua VNPay, thêm redirect=1 để thỏa mãn $_POST['redirect'] của VNPay service
    if (paymentMethod === 'bank') {
        userFormData.append("redirect", "1");
    }

    // Thêm phương thức MOMO nếu được chọn
    if (paymentMethod === 'ewallet') {
        var momoMethod = document.querySelector("input[name='momo_method']:checked") ? 
            document.querySelector("input[name='momo_method']:checked").value : null;

        userFormData.append("momo_method", momoMethod);
    } 
    // Thêm dữ liệu phương thức thanh toán vào FormData
    userFormData.append("payment", paymentMethod);
    // Thêm dữ liệu phương thức vận chuyển và thanh toán vào FormData
    userFormData.append("shipping", shippingMethod);
    
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
                        var paymentResponse = JSON.parse(paymentXhr.responseText);
                        console.log(paymentResponse);
                        if (paymentMethod === 'bank') {
                            // Xử lý thanh toán VNPay
                            if (paymentResponse.success) {
                                window.location.href = paymentResponse.data; // Chuyển hướng đến cổng thanh toán VNPay
                            } else {
                                Swal.fire({
                                    title: 'Thất bại!',
                                    text: paymentResponse.message,
                                    icon: 'error',
                                    confirmButtonText: 'Đóng'
                                });
                            }
                        } else if(paymentMethod === 'cod') {
                            // Xử lý thanh toán COD 
                            if (paymentResponse.success) {
                                window.location.href = paymentResponse.redirect; // Chuyển hướng đến trang kết quả
                            } else {
                                Swal.fire({
                                    title: 'Thất bại!',
                                    text: paymentResponse.message,
                                    icon: 'error',
                                    confirmButtonText: 'Đóng'
                                });
                            }
                        } else if (paymentMethod === 'ewallet') {
                            if (paymentResponse.success) {
                                window.location.href = paymentResponse.data; // Chuyển hướng đến trang thanh toán MoMo
                            } else {
                                Swal.fire({
                                    title: 'Thất bại!',
                                    text: paymentResponse.message,
                                    icon: 'error',
                                    confirmButtonText: 'Đóng'
                                });
                            }
                        }
                    } else {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Không thể gửi yêu cầu thanh toán. Vui lòng thử lại sau.',
                            icon: 'error',
                            confirmButtonText: 'Đóng'
                        });
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

// Tách riêng phần xử lý URL parameters 
function checkPaymentStatus() {
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const message = urlParams.get('message');

    if (message) {
        if (success === 'true') {
            Swal.fire({
                title: 'Thành công!',
                text: decodeURIComponent(message)+ ' ❤️',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = _WEB_ROOT + '/trang-chu';
                }
            });
        } else {
            Swal.fire({
                title: 'Thất bại!',
                text: decodeURIComponent(message),
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }
}

// Gọi hàm kiểm tra khi trang load xong
window.onload = checkPaymentStatus;

document.getElementById('shipping').addEventListener('change', calculateTotal);

function calculateTotal() {
    const shippingMethod = document.getElementById('shipping').value;

    fetch(_WEB_ROOT + '/calculateTotal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `shipping_method=${shippingMethod}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('subtotal-amount').textContent = 
                formatCurrency(data.data.totalProduct_cost);
            document.getElementById('shipping-amount').textContent = 
                formatCurrency(data.data.shipping_fee);
            document.getElementById('discount-amount').textContent = 
                `-${formatCurrency(data.data.discount)}`;
            document.getElementById('total-amount').textContent = 
                `Tổng thanh toán: ${formatCurrency(data.data.final_total)}`;
        }
    })
    .catch(error => console.error('Error:', error));
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}