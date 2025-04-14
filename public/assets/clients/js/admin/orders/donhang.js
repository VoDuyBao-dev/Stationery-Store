document.addEventListener("DOMContentLoaded", function () {
    const addOrderBtn = document.getElementById("add-order-btn");
    const modal = document.getElementById("myModal");
    const editModal = document.getElementById("editModal");
    const viewModal = document.getElementById("viewModal");

    const closeButtons = document.querySelectorAll(".modal .close");
    const cancelBtn = document.getElementById("cancel-btn");

    const editForm = document.getElementById("edit-order-form");
    const orderForm = document.getElementById("order-form");

    const editCancelBtn = document.getElementById("edit-cancel-btn");

    if (editCancelBtn) {
        editCancelBtn.addEventListener("click", function () {
            hideAllModals();
        });
    }

    // Mở modal thêm đơn hàng mới
    addOrderBtn.addEventListener("click", function () {
        modal.style.display = "flex";
    });

    // Đóng modal khi click nút đóng hoặc hủy
    closeButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            hideAllModals();
        });
    });

    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            hideAllModals();
        });
    }


    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const orderId = this.dataset.id;

            fetch(`${baseURL}/detailOrder/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data || data.length === 0) {
                        alert("Không có dữ liệu chi tiết đơn hàng.");
                        return;
                    }

                    const tbody = document.getElementById('order-details-table-body');
                    tbody.innerHTML = '';

                    data.forEach((detail, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><input type="text" value="${index + 1}" readonly></td>
                            <td><input type="text" value="${detail.tenDonHang}" readonly></td>
                            <td><input type="text" value="${detail.phone}" readonly></td>
                            <td><input type="text" value="${detail.address}" readonly></td>
                            <td><textarea readonly>${detail.ghiChu || ''}</textarea></td>
                            <td><input type="text" value="${detail.name}" readonly></td>
                            <td><input type="text" value="${Number(detail.priceCurrent).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${detail.quantity}" readonly></td>
                            <td><input type="text" value="${Number(detail.cost).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${Number(detail.price).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${Number(detail.total_price).toLocaleString()}₫" readonly></td>
                        `;
                        tbody.appendChild(row);
                    });

                    // Hiển thị nút sửa nếu trangThaiGiao === 0
                    const trangThaiGiao = data[0].trangThaiGiao ?? 1;
                    const editBtn = document.getElementById('editOrderBtn');
                    if (trangThaiGiao == 0) {
                        editBtn.style.display = 'inline-block';
                        editBtn.onclick = function () {
                            window.location.href = `${baseURL}/adminproduct/edit/${orderId}`;
                        };
                    } else {
                        editBtn.style.display = 'none';
                    }

                    document.getElementById('viewModal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Lỗi khi lấy chi tiết đơn hàng:', error);
                    alert("Không thể lấy chi tiết đơn hàng. Vui lòng thử lại.");
                });
        });
    });



    // Đóng modal khi click bên ngoài
    window.addEventListener("click", function (event) {
        if (event.target.classList.contains("modal")) {
            hideAllModals();
        }
    });

    // Xử lý click "Sửa"
    const editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const orderId = button.getAttribute("data-id");
            // TODO: Gọi API hoặc lấy dữ liệu đơn hàng từ biến toàn cục nếu có
            fillEditForm(orderId); // Giả định bạn sẽ làm phần này
            editModal.style.display = "flex";
        });
    });



    // Xử lý submit form thêm đơn hàng
    if (orderForm) {
        orderForm.addEventListener("submit", function (e) {
            e.preventDefault();
            // TODO: Gửi dữ liệu lên server (AJAX hoặc form action)
            alert("Thêm đơn hàng mới!");
            hideAllModals();
        });
    }

    // Xử lý submit form sửa đơn hàng
    if (editForm) {
        editForm.addEventListener("submit", function (e) {
            e.preventDefault();
            // TODO: Gửi dữ liệu cập nhật lên server
            alert("Cập nhật đơn hàng thành công!");
            hideAllModals();
        });
    }

    // Hàm đóng tất cả các modal
    function hideAllModals() {
        if (modal) modal.style.display = "none";
        if (editModal) editModal.style.display = "none";
        if (viewModal) viewModal.style.display = "none";
    };

    // Điều hướng tab
    window.redirectTo = function (url) {
        window.location.href = url;
    };

    // Hàm này nên được hoàn thiện khi có dữ liệu cụ thể từ PHP hoặc API
    function fillEditForm(orderId) {
        // TODO: AJAX lấy dữ liệu chi tiết đơn hàng theo orderId và fill vào form
        console.log("Fill dữ liệu cho đơn hàng ID: " + orderId);
        // Ví dụ:
        // document.getElementById("edit-ma").value = orderId;
        // document.getElementById("edit-ngay").value = "2024-04-13";
        // ...
    };
});
