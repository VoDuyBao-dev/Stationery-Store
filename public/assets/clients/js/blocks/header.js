document.addEventListener("DOMContentLoaded", function() {
    const userIcon = document.getElementById("userIcon");
    const dropdownUser = document.getElementById("dropdownUser");

    // Khi click vào icon người dùng
    userIcon.addEventListener("click", function(event) {
        event.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
        dropdownUser.classList.toggle("show");
    });

    // Khi click ra ngoài dropdown thì ẩn menu
    document.addEventListener("click", function(event) {
        if (!userIcon.contains(event.target) && !dropdownUser.contains(event.target)) {
            dropdownUser.classList.remove("show");
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let pageTitle = document.title; // Lấy tiêu đề của trang
    let breadcrumbTitle = document.querySelector(".breadcrumb-banner h2"); // Chọn phần tử tiêu đề trong breadcrumb
    let breadcrumbSpan = document.querySelector(".breadcrumb-banner span"); // Chọn span trong breadcrumb

    if (breadcrumbTitle && breadcrumbSpan) {
        breadcrumbTitle.textContent = pageTitle; // Cập nhật tiêu đề breadcrumb
        breadcrumbSpan.textContent = pageTitle; // Cập nhật breadcrumb navigation
    }
});
function updateCart(id, quantity) {
    fetch('cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `update_id=${id}&new_quantity=${quantity}`
    }).then(() => location.reload());
}
function removeItem(id) {
    fetch('cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `remove_id=${id}`
    }).then(() => location.reload());
}

function checkout() {
    alert('Thanh toán thành công!');
}

function toggleCart() {
    document.getElementById("cartPanel").classList.toggle("active");
}


window.onscroll = function () {
    var button = document.getElementById("backToTop");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
};

// Hàm cuộn lên đầu trang mượt mà
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


