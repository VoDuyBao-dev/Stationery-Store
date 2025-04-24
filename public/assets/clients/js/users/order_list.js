document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const orderId = this.getAttribute("xem-id");
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
                        
                    `;
                        tbody.appendChild(row);
                    });
                    viewDetailModal.style.display = 'flex';

                })
                .catch(error => {
                    console.error('Lỗi khi lấy chi tiết đơn hàng:', error);
                    alert('Không thể lấy dữ liệu chi tiết đơn hàng.');
                });
        });

    });

    // Đóng modal khi click bên ngoài
    window.addEventListener("click", function (event) {
        if (event.target.classList.contains("modal")) {
            viewDetailModal.style.display = 'none';
        }
    });

    // Xử lý hủy đơn hàng
    const cancelButtons = document.querySelectorAll('.cancel-btn');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-id');
            
            if(confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                fetch(`${_WEB_ROOT}/huy-don-hang`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        order_id: orderId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Đã hủy đơn hàng thành công');
                        location.reload(); // Tải lại trang để cập nhật trạng thái
                    } else {
                        alert(data.message || 'Có lỗi xảy ra khi hủy đơn hàng');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi hủy đơn hàng');
                });
            }
        });
    });

    // Date filter handling
    const filterBtn = document.getElementById('filter-btn');
    const resetBtn = document.getElementById('reset-filter');
    const fromDate = document.getElementById('from-date');
    const toDate = document.getElementById('to-date');

    filterBtn.addEventListener('click', function() {
        if (!fromDate.value || !toDate.value) {
            alert('Vui lòng chọn khoảng thời gian');
            return;
        }

        if (fromDate.value > toDate.value) {
            alert('Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
            return;
        }

        window.location.href = `${_WEB_ROOT}/danh-sach-don-hang?from_date=${fromDate.value}&to_date=${toDate.value}`;
    });

    resetBtn.addEventListener('click', function() {
        window.location.href = `${_WEB_ROOT}/danh-sach-don-hang`;
    });

    // Set date values if they exist in URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('from_date')) {
        fromDate.value = urlParams.get('from_date');
        toDate.value = urlParams.get('to_date');
    }
});
