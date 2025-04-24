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
                        <td><input type="text" value="${Number(detail.total_price).toLocaleString()}₫" readonly></td>
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

});
