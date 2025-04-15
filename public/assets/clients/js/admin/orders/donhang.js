document.addEventListener("DOMContentLoaded", function () {
    const addOrderBtn = document.getElementById("add-order-btn");
    const myModal = document.getElementById("myModal");
    const editModal = document.getElementById("editModal");
    const viewDetailModal = document.getElementById("viewDetailModal");
    const editDetailModal = document.getElementById("editDetailModal");
    const confirmDeleteModal = document.getElementById("confirmDeleteModal");

    const closeButtons = document.querySelectorAll(" .close");
    const cancelBtn = document.getElementById("cancel-btn");
    const editCancelBtn = document.getElementById("edit-cancel-btn");
    const delete_btn = document.getElementById("delete-btn");


    // Mở modal thêm đơn hàng mới
    addOrderBtn.addEventListener("click", function () {
        myModal.style.display = "flex";
    });

    // Đóng modal khi click nút đóng hoặc hủy
    closeButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            myModal.style.display = "none";
        });
    });

    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            myModal.style.display = "none";
        });
    }
    if (editCancelBtn) {
        editCancelBtn.addEventListener("click", function () {
            editModal.style.display = "none";
        });
    }

    // Mở modal và load dữ liệu từ URL 'viewOrder'
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            const orderId = this.getAttribute("data-order-id");

            fetch(`${baseURL}/viewOrder/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const order = data.order;
                        document.getElementById("edit-ma").value = order.order_id;
                        document.getElementById("edit-ngay").value = order.created_at;
                        document.getElementById("edit-nguoi").value = order.fullname;
                        document.getElementById("edit-tong").value = order.total_price;
                        document.getElementById("edit-thanhtoan").value = order.payment_method;
                        document.getElementById("edit-vanchuyen").value = order.name;

                        editModal.style.display = "flex";
                    } else {
                        alert("Không tìm thấy đơn hàng.");
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi lấy dữ liệu đơn hàng:", error);
                });
        });
    });




    document.querySelectorAll('.viewOrderDetail-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const orderId = this.dataset.id;
            console.log(`${baseURL}/detailOrder/${orderId}`);

            fetch(`${baseURL}/detailOrder/${orderId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data || data.length === 0) {
                        throw new Error('Không có chi tiết đơn hàng nào.');
                    }

                    const tbody = document.getElementById('order-details-table-body');
                    tbody.innerHTML = ''; // Clear old content

                    data.forEach((detail, index) => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td><input type="text" value="${detail.tenDonHang || ''}" readonly></td>
                            <td><input type="text" value="${detail.phone || ''}" readonly></td>
                            <td><input type="text" value="${detail.address || ''}" readonly></td>
                            <td><textarea readonly>${detail.ghiChu || ''}</textarea></td>
                            <td><input type="text" value="${detail.name || ''}" readonly></td>
                            <td><input type="text" value="${Number(detail.priceCurrent).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${detail.quantity}" readonly></td>
                            <td><input type="text" value="${Number(detail.priceCurrent * detail.quantity).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${Number(detail.price).toLocaleString()}₫" readonly></td>
                            <td><input type="text" value="${Number(detail.total_price).toLocaleString()}₫" readonly></td>
                        `;

                        tbody.appendChild(row);

                        if (detail.trangThaiGiao == 0) {
                            const actionRow = document.createElement('tr');
                            actionRow.innerHTML = `
                                <th colspan="11" style="text-align: right;">
                                    <button class="btn-edit-order-detail" data-order_detail-id="${detail.order_detail_id}">Sửa</button>
                                    <button class="btn-delete-order-detail" data-order_detail-id="${detail.order_detail_id}">Xóa</button>
                                </th>
                            `;
                            tbody.appendChild(actionRow);
                        }
                    });

                    // Sau khi render xong => gắn sự kiện cho các nút sửa
                    addEditButtonListeners();

                    // Hiển thị modal chi tiết
                    viewDetailModal.style.display = 'flex';
                })
                .catch(error => {
                    console.error('Lỗi khi lấy chi tiết đơn hàng:', error);
                    alert('Không thể lấy dữ liệu chi tiết đơn hàng.');
                });
        });
    });

    function addEditButtonListeners() {
        document.querySelectorAll('.btn-edit-order-detail').forEach(editBtn => {
            editBtn.addEventListener('click', function () {
                const orderDetailId = this.dataset.order_detailId;
                viewDetailModal.style.display = 'none';

                if (!orderDetailId) {
                    alert('Không tìm thấy ID chi tiết đơn hàng!');
                    return;
                }

                fetch(`${baseURL}/getOrderDetail/${orderDetailId}`)
                    .then(res => {
                        if (!res.ok) throw new Error(`Lỗi khi gọi API: ${res.status}`);
                        return res.json();
                    })
                    .then(data => {
                        const detail = data.orderDetail;
                        const transports = data.transports;

                        document.getElementById('edit_order_detail_id').value = detail.order_detail_id;
                        document.getElementById('edit_order_id').value = detail.order_id;
                        document.getElementById('edit_tenDonHang').value = detail.tenDonHang;
                        document.getElementById('edit_phone').value = detail.phone;
                        document.getElementById('edit_address').value = detail.address;
                        document.getElementById('edit_ghiChu').value = detail.ghiChu;
                        document.getElementById('edit_priceCurrent').value = detail.priceCurrent;
                        document.getElementById('edit_quantity').value = detail.quantity;

                        const select = document.getElementById('edit_transport_id');
                        select.innerHTML = '';

                        transports.forEach(transport => {
                            const option = document.createElement('option');
                            option.value = transport.transport_id;
                            option.textContent = `${transport.name} - ${transport.price}đ`;

                            if (transport.transport_id == detail.transport_id) {
                                option.selected = true;
                            }

                            select.appendChild(option);
                        });
                        editDetailModal.style.display = 'flex';
                    })
                    .catch(err => {
                        console.error('Lỗi khi lấy dữ liệu:', err);
                        alert('Lỗi khi lấy dữ liệu chi tiết đơn hàng.');
                    });
            });
        });
    }


    // Đóng modal khi click bên ngoài
    window.addEventListener("click", function (event) {
        if (event.target.classList.contains("modal")) {
            hideAllModals();
        }
    });

    // Hàm đóng tất cả các modal
    function hideAllModals() {
        if (myModal) myModal.style.display = "none";
        if (editModal) editModal.style.display = "none";
        if (viewDetailModal) viewDetailModal.style.display = "none";
        if (editDetailModal) editDetailModal.style.display = "none";
    };

    // Điều hướng tab
    window.redirectTo = function (url) {
        window.location.href = url;
    };

});
