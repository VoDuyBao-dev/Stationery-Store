// document.addEventListener("DOMContentLoaded", function () {
//     const settingSidebar = document.querySelector(".settingSidebar");
//     const toggleButton = document.querySelector(".settingPanelToggle");

//     // Khi nhấn vào nút settingPanelToggle, toggle class "showSettingPanel"
//     toggleButton.addEventListener("click", function (event) {
//         event.preventDefault(); // Ngăn chặn chuyển trang nếu thẻ <a> có href
//         settingSidebar.classList.toggle("showSettingPanel");
//     });
// });




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

