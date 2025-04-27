document.addEventListener("DOMContentLoaded", function () {
    const addOrderBtn = document.getElementById("add-order-btn");
    // const myModal = document.getElementById("myModal");
    const editModal = document.getElementById("editModal");
    const viewDetailModal = document.getElementById("viewDetailModal");
    const editDetailModal = document.getElementById("editDetailModal");
    const deleteDetailModal = document.getElementById("deleteDetailModal");
    const confirmDeleteModal = document.getElementById("confirmDeleteModal");
    const confirmCancelModal = document.getElementById("confirmCancelModal");

    const closeButtons = document.querySelectorAll(".close");
    const cancelBtn = document.getElementById("cancel-btn");
    const editCancelBtn = document.getElementById("edit-cancel-btn");
    const delete_btn = document.getElementById("delete-btn");


    // Mở modal thêm đơn hàng mới
    // addOrderBtn.addEventListener("click", function () {
    //     myModal.style.display = "flex";
    // });

    // Đóng modal khi click nút đóng hoặc hủy
    closeButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            editModal.style.display = "none";
        });
    });

    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            // myModal.style.display = "none";
            editModal.style.display = "none";
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
            const orderId = this.getAttribute("sua-id");
            console.log(orderId);
            console.log(`${baseURL}/viewOrder/${orderId}`);
            fetch(`${baseURL}/viewOrder/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data || data.length === 0) {
                        throw new Error('Không có chi tiết đơn hàng nào.');
                    }
                    console.log(data);

                    const order = data.order;
                    const transports = data.transports;
                    console.log(order);
                    console.log(transports);
                    document.getElementById("edit_ma").value = order.order_id;
                    document.getElementById("edit_ngay").value = order.created_at;
                    document.getElementById("edit_nguoi").value = order.fullname;
                    document.getElementById("edit_tong").value = order.total_price;
                    document.getElementById("edit_thanhtoan").value = order.payment_method;
                    document.getElementById("transportOldPrice").value = order.price;
                    const select = document.getElementById('edit_vanchuyen');
                    select.innerHTML = '';

                    transports.forEach(transport => {
                        const option = document.createElement('option');
                        option.value = transport.transport_id;
                        option.textContent = `${transport.name} - ${transport.price}đ`;

                        if (transport.transport_id == order.transport_id) {
                            option.selected = true;
                        }

                        select.appendChild(option);
                    });
                    editModal.style.display = "flex";
                })
                .catch(error => {
                    console.error("Lỗi khi lấy dữ liệu đơn hàng:", error);
                });
        });
    });

    // xóa đơn hàng nếu trangThaiGioa = 2 (đơn hàng đã hủy)
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            const orderId = this.getAttribute("xoa-id");
            confirmDeleteModal.style.display = "flex";
            const hiddenInput = document.querySelector('#confirmDeleteModal input[name="order_id"]');
            if (hiddenInput) {
                hiddenInput.value = orderId;
            }
        });
    });
    // hủy đơn hàng nếu trangThaiGioa = 1 (đơn hàng đã hủy)
    document.querySelectorAll(".huy-btn").forEach(button => {
        button.addEventListener("click", function () {
            const orderId = this.getAttribute("huy-id");
            console.log(orderId);
            confirmCancelModal.style.display = "flex";
            const hiddenInput = document.querySelector('#confirmCancelModal input[name="order_id"]');
            if (hiddenInput) {
                hiddenInput.value = orderId;
            }
        });
    });

    const params = new URLSearchParams(window.location.search);
    const orderId = params.get("xem-id");
    if (orderId) {
        console.log("xem_id hoatj dongj");
        console.log(orderId);
        showOrderDetails(orderId);
    }
    else
        console.log("xem_id khong hoatj dongj");

    document.querySelectorAll('.viewOrderDetail-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const orderId = this.getAttribute("xem-id");
            console.log(`${baseURL}/detailOrder/${orderId}`);
            showOrderDetails(orderId);
        });
    });

    function showOrderDetails(orderId) {
        fetch(`${baseURL}/detailOrder/${orderId}?xem-id`)
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
                trangThaiGiao = '';
                const tbody = document.getElementById('order-details-table-body');
                tbody.innerHTML = ''; // Clear old content

                data.forEach((detail, index) => {
                    const row = document.createElement('tr');
                    trangThaiGiao = detail.trangThaiGiao;
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td><input type="text" value="${detail.tenDonHang || ''}" readonly></td>
                        <td><input type="text" value="${detail.phone || ''}" readonly></td>
                        <td><input type="text" value="${detail.address || ''}" readonly></td>
                        <td><textarea readonly>${detail.ghiChu || ''}</textarea></td>
                        <td><input type="text" value="${detail.name || ''}" readonly></td>
                        <td><input type="text" value="${detail.quantity}" readonly></td>
                        <td><input type="text" value="${Number(detail.priceCurrent).toLocaleString()}₫" readonly></td>
                        <td><input type="text" value="${Number(detail.priceCurrent * detail.quantity).toLocaleString()}₫" readonly></td>
                        <td><input type="text" value="${Number(detail.price).toLocaleString()}₫" readonly></td>
                    `;
                    // Thêm cột thao tác nếu trangThaiGiao == 0
                    if (detail.trangThaiGiao === '0') {
                        // Thêm cột TH "Trạng thái" nếu chưa có
                        const theadRow = document.getElementById('thead_row');
                        if (!document.getElementById('th_trang_thai')) {
                            const th = document.createElement('th');
                            th.id = 'th_trang_thai';
                            th.textContent = 'Trạng thái';
                            theadRow.appendChild(th);
                        }

                        const actionCell = document.createElement('td');
                        actionCell.innerHTML = `
                            <button class="btn-edit-order-detail" data-order_detail-id="${detail.order_detail_id}">Sửa</button>
                            <button class="btn-delete-order-detail" data-order_detail-id="${detail.order_detail_id}">Xóa</button>
                        `;
                        row.appendChild(actionCell);

                    }
                    else {
                        const theadRow = document.getElementById('thead_row');
                        const thTrangThai = document.getElementById('th_trang_thai');

                        // Nếu KHÔNG có dòng nào trạng thái giao = 0 => XÓA cột "Trạng thái"
                        if (thTrangThai) {
                            theadRow.removeChild(thTrangThai);
                        }
                    }

                    tbody.appendChild(row);


                });

                if (trangThaiGiao === '0') {
                    const actionRow = document.createElement('tr');
                    actionRow.innerHTML = `
                        <td colspan="100%">
                            <div id="xanNhanDonHang" style="text-align: right; margin-bottom: 10px;">
                                <form action="${baseURL}/xacnhan/${orderId}" method="post">
                                    <button type="submit" id="xacNhan">Xác nhận</button>
                                </form>
                            </div>
                        </td>`

                    tbody.appendChild(actionRow)
                }
                else if (trangThaiGiao === '1') {
                    const actionRow = document.createElement('tr');
                    actionRow.innerHTML = `
                        <td colspan="100%">
                            <div id="xacNhanThanhCong" style="text-align: right; margin-bottom: 10px;">
                                <form action="${baseURL}/xacNhanThanhCong/${orderId}" method="post">
                                    <button type="submit" id="xacNhanThanhCong">Xác nhận giao thành công</button>
                                </form>
                            </div>
                        </td>`

                    tbody.appendChild(actionRow)
                }
                // Sau khi render xong => gắn sự kiện cho các nút sửa, xóa
                addEditButtonListeners();
                deleteDetailOrder()

                // Hiển thị modal chi tiết
                viewDetailModal.style.display = 'flex';
            })
            .catch(error => {
                console.error('Lỗi khi lấy chi tiết đơn hàng:', error);
                alert('Không thể lấy dữ liệu chi tiết đơn hàng.');
            });
    }

    // Sửa bản ghi của chi tiết đơn hàng
    function addEditButtonListeners() {
        document.querySelectorAll('.btn-edit-order-detail').forEach(editBtn => {
            editBtn.addEventListener('click', function () {
                // const orderDetailId = this.dataset.order_detailId;
                const orderDetailId = this.getAttribute("data-order_detail-id");
                viewDetailModal.style.display = 'none';
                console.log(`${baseURL}/getOrderDetail/${orderDetailId}`);
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
                        const productTypes = data.productTypes;
                        console.log(data);
                        document.getElementById('edit_order_detail_id').value = detail.order_detail_id;
                        // document.getElementById('edit_product_type_id').value = detail.product_type_id;
                        document.getElementById('edit_order_id').value = detail.order_id;
                        document.getElementById('edit_tenDonHang').value = detail.tenDonHang;
                        document.getElementById('edit_phone').value = detail.phone;
                        document.getElementById('edit_address').value = detail.address;
                        document.getElementById('edit_ghiChu').value = detail.ghiChu;
                        // document.getElementById('edit_priceCurrent').value = detail.priceCurrent;
                        document.getElementById('edit_quantity').value = detail.quantity;

                        const select = document.getElementById('product_type_id');
                        select.innerHTML = '';

                        productTypes.forEach(productType => {
                            const option = document.createElement('option');
                            option.value = productType.product_type_id;
                            option.textContent = `${productType.name} - ${productType.priceCurrent}đ`;

                            if (productType.product_type_id == detail.product_type_id) {
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

    // xóa bản ghi của bảng chi tiết đơn hàng
    function deleteDetailOrder() {
        document.querySelectorAll('.btn-delete-order-detail').forEach(editBtn => {
            editBtn.addEventListener('click', function () {
                const orderDetailId = this.dataset.order_detailId;
                viewDetailModal.style.display = 'none';
                document.getElementById('deleteDetailModal').style.display = 'flex';
                const hiddenInput = document.querySelector('#deleteDetailModal input[name="order_detail_id"]');
                if (hiddenInput) {
                    hiddenInput.value = orderDetailId;
                }
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
        // if (myModal) myModal.style.display = "none";
        if (editModal) editModal.style.display = "none";
        if (viewDetailModal) viewDetailModal.style.display = "none";
        if (editDetailModal) editDetailModal.style.display = "none";
        if (deleteDetailModal) deleteDetailModal.style.display = "none";
        if (confirmDeleteModal) confirmDeleteModal.style.display = "none";
        if (confirmCancelModal) confirmCancelModal.style.display = "none";;
    };

    // Điều hướng tab
    window.redirectTo = function (url) {
        window.location.href = url;
    };

});
