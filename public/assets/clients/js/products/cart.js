function kiemtrasoluong(input) {
    var value = input.value.trim();

    // Kiểm tra nếu không phải số nguyên dương
    if (!/^\d+$/.test(value)) {
        alert("Vui lòng chỉ nhập số nguyên từ 1 đến 10");
        input.value = 1;
        return;
    }

    var number = parseInt(value);

    if (number < 1) {
        input.value = 1;
        alert("Số lượng ít nhất là 1");
    } else if (number > 10) {
        input.value = 10;
        alert("Số lượng tối đa là 10");
    }
    
}

function tangsoluong(button) {
    var input = button.previousElementSibling;
    var value = parseInt(input.value);
  
    if (value < 10) { 
        input.value = value + 1;
    } else {
        alert("Số lượng tối đa là 10");
        input.value = 10;
    }
    // Lấy product_type_id từ .cart-item
    var cartItem = button.closest(".cart-item");
    var hiddenInput = cartItem.querySelector(".product-type-id");
    var productTypeId = hiddenInput.value;
   
    $.post(_WEB_ROOT+"/Capnhatsoluong/capnhat_soluong", {
        product_type_id: productTypeId,
        quantity: input.value
    },
        function(data) {
            const response = JSON.parse(data);

            // Cập nhật lại phần HTML item
            document.getElementById("cart").innerHTML = response.html_cart;
            // Cập nhật tổng tiền
            document.getElementById("tong-tien").innerHTML = response.tongtien;
        
           
            
        }
    );

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
   

    $.post(_WEB_ROOT+"/Capnhatsoluong/capnhat_soluong", {
        product_type_id: productTypeId,
        quantity: input.value
    },
        function(data) {
            const response = JSON.parse(data);

            // Cập nhật lại phần HTML item
            document.getElementById("cart").innerHTML = response.html_cart;
            // Cập nhật tổng tiền
            document.getElementById("tong-tien").innerHTML = response.tongtien;
        }
    );

}