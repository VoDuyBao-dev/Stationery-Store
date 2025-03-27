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