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
    editBtns.forEach(button => {
        button.addEventListener('click', function () {
            const couponId = this.dataset.id;  // Lấy coupon_id từ data-id của button
            // Gửi yêu cầu AJAX để lấy dữ liệu chi tiết của coupon
            console.log(`${baseURL}/show/` + couponId);
            fetch(`${baseURL}/show/` + couponId)
                .then(response => response.json())
                .then(data => {
                    // Điền dữ liệu vào các trường form
                    document.getElementById('edit-coupon-id').value = data.coupon_id;  // Trường coupon_id
                    document.getElementById('price_min').value = data.price_min;  // Trường price_min
                    document.getElementById('discount').value = data.discount;    // Trường discount
                    document.getElementById('start_date').value = data.start_date; // Trường start_date
                    document.getElementById('end_date').value = data.end_date;    // Trường end_date
                    document.getElementById('status').value = data.status;        // Trường status
                    document.getElementById('code').value = data.code;            // Trường code
                    // Hiển thị modal (hoặc form sửa)
                    document.getElementById('editModal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                });
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
        cancelDeleteBtn.addEventListener("click", function (e) {
            e.preventDefault(); // Ngăn gửi form
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
