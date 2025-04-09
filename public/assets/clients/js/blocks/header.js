document.addEventListener("DOMContentLoaded", function () {
    const settingSidebar = document.querySelector(".settingSidebar");
    const toggleButton = document.querySelector(".settingPanelToggle");

    // Khi nhấn vào nút settingPanelToggle, toggle class "showSettingPanel"
    toggleButton.addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn chặn chuyển trang nếu thẻ <a> có href
        settingSidebar.classList.toggle("showSettingPanel");
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
//cập nhật số lượng thông báo
document.addEventListener("DOMContentLoaded", function () {
    function updateNotifications() {
        fetch("/api/get-notifications") // API lấy số lượng thông báo
            .then(response => response.json())
            .then(data => {
                document.getElementById("wishlist-count").textContent = data.wishlist;
                document.getElementById("message-count").textContent = data.messages;
            })
            .catch(error => console.error("Lỗi khi tải thông báo:", error));
    }

    // Cập nhật mỗi 10 giây
    setInterval(updateNotifications, 3000);
    
    // Gọi ngay khi tải trang
    updateNotifications();
});

