document.addEventListener("DOMContentLoaded", function () {
    // Lấy các modal
    const addModal = document.getElementById("addModal");
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("confirmDeleteModal");

    // Nút mở modal thêm
    const addBtn = document.getElementById("add-promotion-btn");

    // Các nút đóng modal
    const addCloseBtns = document.querySelectorAll(".add-modal-close");
    const editCloseBtns = document.querySelectorAll(".edit-modal-close");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

    // Các nút "Sửa" và "Xóa"
    const editBtns = document.querySelectorAll(".edit-btn");
    const deleteBtns = document.querySelectorAll(".delete-btn");

    // Mở modal Thêm
    if (addBtn) {
        addBtn.addEventListener("click", function () {

            addModal.style.display = "flex";
        });
    }

    // Đóng modal Thêm
    addCloseBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            addModal.style.display = "none";
        });
    });

    // Mở modal Sửa
    editBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const couponId = this.dataset.id;
            document.getElementById("edit-coupon-id").value = couponId;
            editModal.style.display = "flex";
            // TODO: điền dữ liệu khuyến mãi vào form nếu cần
        });
    });

    // Đóng modal Sửa
    editCloseBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            editModal.style.display = "none";
        });
    });

    // Mở modal Xác nhận xóa
    deleteBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const couponId = this.dataset.id;
            document.getElementById("delete-coupon-id").value = couponId;
            deleteModal.style.display = "flex";
            // TODO: lưu ID cần xóa nếu cần
        });
    });

    // Đóng modal Xác nhận xóa
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener("click", function () {
            deleteModal.style.display = "none";
        });
    }

    // Đóng modal khi click ra ngoài nội dung
    window.addEventListener("click", function (event) {
        if (event.target === addModal) {
            addModal.style.display = "none";
        }
        if (event.target === editModal) {
            editModal.style.display = "none";
        }
        if (event.target === deleteModal) {
            deleteModal.style.display = "none";
        }
    });
});
