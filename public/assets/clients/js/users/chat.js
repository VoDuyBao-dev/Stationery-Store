function toggleStickerMenu() {
    document.getElementById("stickerMenu").classList.toggle("show");
}

function selectSticker(imgElement) {
    let stickerSrc = imgElement.getAttribute("id");
    if (stickerSrc) {
        document.getElementById("stickerInput").value = stickerSrc; // Lưu đường dẫn ảnh vào input ẩn
        document.getElementById("messageInput").removeAttribute("required"); // Không bắt buộc nhập text nếu chọn sticker
        document.querySelector("form").submit(); // Gửi tin nhắn ngay lập tức
    }
    else stickerSrc = 1;

}

function scrollToBottom() {
    var chatBox = document.querySelector(".message");
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
}

window.onload = scrollToBottom; // Cuộn khi tải trang
document.querySelector("form").onsubmit = function () {
    setTimeout(scrollToBottom, 200); // Cuộn sau khi gửi tin nhắn
};


// document.getElementById('chatForm').addEventListener('submit', function (e) {
//     e.preventDefault(); // Ngăn form gửi thông thường

//     const formData = new FormData(this);

//     fetch('<?php echo _BASE_URL; ?>/chat/sendMessage', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 // Thêm tin nhắn mới vào giao diện
//                 const chatBox = document.getElementById('chatBox');
//                 chatBox.innerHTML += `<div>${data.message}</div>`;
//                 document.getElementById('message').value = ''; // Xóa nội dung tin nhắn
//             } else {
//                 alert(data.error);
//             }
//         })
//         .catch(error => console.error('Lỗi:', error));
// });