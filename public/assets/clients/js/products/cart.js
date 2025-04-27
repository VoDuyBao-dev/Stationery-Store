// Thêm hàm debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Sửa lại hàm validateQuantity
function validateQuantity(input) {
    // Lấy giá trị và loại bỏ các ký tự không phải số
    let value = input.value.replace(/[^0-9]/g, '');

    // Nếu giá trị rỗng hoặc = 0, set về 1
    if (!value || value === '0') {
        value = '1';
    }

    // Nếu giá trị không phải số
    if (!/^\d+$/.test(input.value)) {
        alert('Vui lòng chỉ nhập số');
        input.value = value;
        return;
    }

    if (value > 100) {
        alert("Số lượng tối đa là 100");
        input.value = 100;
    }

    // Cập nhật giá trị đã được validate
    input.value = value;

    // Lấy product_type_id
    let productTypeId = input.closest('.cart-item').querySelector('.product-type-id').value;

    // Gọi hàm cập nhật số lượng với debounce
    debouncedCapNhat(productTypeId, value);
}

// Tạo phiên bản debounce của hàm capNhatSoLuong
const debouncedCapNhat = debounce((productTypeId, quantity) => {
    capNhatSoLuong(productTypeId, quantity);
}, 500); // Đợi 500ms sau khi người dùng ngừng nhập

// Cập nhật và tăng giảm số lượng trong cart
function capNhatSoLuong(productTypeId, quantity) {
    $.ajax({
        url: _WEB_ROOT + "/Capnhatsoluong/capnhat_soluong",
        method: "POST",
        data: {
            product_type_id: productTypeId,
            quantity: quantity
        },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }
            // Cập nhật lại phần HTML item
            document.getElementById("cart").innerHTML = response.html_cart;
            // Cập nhật tổng tiền
            document.getElementById("tong-tien").innerHTML = number_format(response.tongtien) + '₫';
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

// Hàm format số
function number_format(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function tangsoluong(button) {
    var input = button.previousElementSibling;
    var value = parseInt(input.value);

    if (value < 100) {
        input.value = value + 1;
    } else {
        alert("Số lượng tối đa là 100");
        input.value = 100;
    }
    // Lấy product_type_id từ .cart-item
    var cartItem = button.closest(".cart-item");
    var hiddenInput = cartItem.querySelector(".product-type-id");
    var productTypeId = hiddenInput.value;

    capNhatSoLuong(productTypeId, input.value);

}

function giamsoluong(button) {
    var input = button.nextElementSibling;
    var value = parseInt(input.value);

    if (value > 1) {
        input.value = value - 1;
    } else {
        input.value = 1;
        alert("Số lượng tối thiểu là 1");
    }
    // Lấy product_type_id từ .cart-item
    var cartItem = button.closest(".cart-item");
    var hiddenInput = cartItem.querySelector(".product-type-id");
    var productTypeId = hiddenInput.value;


    capNhatSoLuong(productTypeId, input.value);

}

// Tăng giảm số lượng trong chi tiết sản phẩm vaf kiểm tra số lượng

function capNhatHiddenQuantity(value) {
    document.getElementById("hidden-quantity").value = value;
}

function kiemtrasoluong_productDetail(input) {

    var number = parseInt(input.value);

    if (number < 1) {
        input.value = 1;
        alert("Số lượng ít nhất là 1");
    } else if (number > 100) {
        input.value = 100;
        alert("Số lượng tối đa là 100");
    }

    capNhatHiddenQuantity(input.value)

}

function tangsoluong_productDetail(button) {
    var input = button.previousElementSibling;
    var value = parseInt(input.value);

    if (value < 100) {
        input.value = value + 1;
    } else {
        alert("Số lượng tối đa là 100");
        input.value = 100;
    }
    capNhatHiddenQuantity(input.value)


}

function giamsoluong_productDetail(button) {
    var input = button.nextElementSibling;
    var value = parseInt(input.value);

    if (value > 1) {
        input.value = value - 1;

    } else {
        input.value = 1;
        alert("Số lượng tối thiểu là 1");
    }
    capNhatHiddenQuantity(input.value)

<<<<<<< HEAD:public/assets/clients/js/products/cart.js
}
=======
}

// xóa toàn bộ vỏ hàng

document.getElementById('clear-cart-btn').addEventListener('click', function(event) {
    const confirmDelete = confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?');
    if (!confirmDelete) {
        event.preventDefault(); // Ngăn chặn hành động mặc định nếu người dùng chọn "Không"
    }
});
>>>>>>> 580a8c3c434e68307f420358f437d186cf2d80fd:public/assets/clients/js/cart/cart.js
