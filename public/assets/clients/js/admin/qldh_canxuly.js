document.addEventListener('DOMContentLoaded', () => {
    const addModal = document.getElementById('myModal');
    const editModal = document.getElementById('editModal');
    const viewModal = document.getElementById('viewModal');
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    const addBtn = document.getElementById('add-order-btn');
    const closeBtns = document.querySelectorAll('.close');
    const cancelAddBtn = document.getElementById('cancel-btn');
    const cancelEditBtn = document.getElementById('edit-cancel-btn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const addForm = document.getElementById('order-form');
    const editForm = document.getElementById('edit-order-form');
    const tbody = document.querySelector('#order-table tbody');
    const orderDetails = document.getElementById('order-details');

    let currentEditingRow = null;
    let rowToDelete = null; // Biến để lưu trữ hàng cần xóa

    function updateCount() {
        const count = tbody.querySelectorAll('tr').length - (tbody.querySelector('.no-data') ? 1 : 0);
        document.getElementById('count-can-xu-ly').textContent = count;
    }

    addBtn.onclick = () => addModal.style.display = 'flex';
    cancelAddBtn.onclick = () => addModal.style.display = 'none';
    cancelEditBtn.onclick = () => editModal.style.display = 'none';
    cancelDeleteBtn.onclick = () => confirmDeleteModal.style.display = 'none';
    closeBtns.forEach(btn => btn.onclick = () => {
        addModal.style.display = 'none';
        editModal.style.display = 'none';
        viewModal.style.display = 'none';
        confirmDeleteModal.style.display = 'none';
    });

    window.onclick = e => {
        if (e.target === addModal) addModal.style.display = 'none';
        if (e.target === editModal) editModal.style.display = 'none';
        if (e.target === viewModal) viewModal.style.display = 'none';
        if (e.target === confirmDeleteModal) confirmDeleteModal.style.display = 'none';
    };

    addForm.onsubmit = (e) => {
        e.preventDefault();

        const ma = addForm.ma.value.trim();
        const ngay = addForm.ngay.value;
        const nguoi = addForm.nguoi.value.trim();
        const tong = addForm.tong.value.trim();
        const thanhtoan = addForm.thanhtoan.value.trim();
        const vanchuyen = addForm.vanchuyen.value.trim();

        if (!ma) return alert("Mã đơn hàng không được để trống");

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${ma}</td>
            <td>${ngay}</td>
            <td>${nguoi}</td>
            <td>${tong}</td>
            <td>${thanhtoan}</td>
            <td>${vanchuyen}</td>
            <td style="text-align:center">
                <i class="fas fa-edit edit-order" style="cursor: pointer;"></i>
                <i class="fas fa-minus delete-order" style="cursor: pointer; color: black;"></i>
            </td>
            <td style="text-align:center">
                <button class="view-order">Xem thêm</button>
            </td>
        `;

        const noData = tbody.querySelector('.no-data');
        if (noData) noData.remove();

        tbody.appendChild(row);
        addModal.style.display = 'none';
        addForm.reset();
        updateCount();
    };

    tbody.addEventListener('click', e => {
        const target = e.target;
        const row = target.closest('tr');

        if (target.classList.contains('view-order')) {
            const cells = row.querySelectorAll('td');
            orderDetails.innerHTML = `
                <p><strong>Mã đơn hàng:</strong> ${cells[0].textContent}</p>
                <p><strong>Ngày đặt hàng:</strong> ${cells[1].textContent}</p>
                <p><strong>Người nhận:</strong> ${cells[2].textContent}</p>
                <p><strong>Tổng hóa đơn:</strong> ${cells[3].textContent}</p>
                <p><strong>Phương thức thanh toán:</strong> ${cells[4].textContent}</p>
                <p><strong>Phương thức vận chuyển:</strong> ${cells[5].textContent}</p>
            `;
            viewModal.style.display = 'flex';
        }

        if (target.classList.contains('delete-order')) {
            rowToDelete = row; // Lưu trữ hàng cần xóa
            confirmDeleteModal.style.display = 'flex'; // Hiển thị modal xác nhận
        }

        if (target.classList.contains('edit-order')) {
            currentEditingRow = row;
            const cells = row.querySelectorAll('td');
            editForm['edit-ma'].value = cells[0].textContent;
            editForm['edit-ngay'].value = cells[1].textContent;
            editForm['edit-nguoi'].value = cells[2].textContent;
            editForm['edit-tong'].value = cells[3].textContent;
            editForm['edit-thanhtoan'].value = cells[4].textContent;
            editForm['edit-vanchuyen'].value = cells[5].textContent;
            editModal.style.display = 'flex';
        }
    });

    confirmDeleteBtn.onclick = () => {
        if (rowToDelete) {
            rowToDelete.remove();
            if (tbody.querySelectorAll('tr').length === 0) {
                tbody.innerHTML = `<tr><td colspan="8" class="no-data">Không có bản ghi nào</td></tr>`;
            }
            updateCount();
            confirmDeleteModal.style.display = 'none'; // Ẩn modal sau khi xóa
            rowToDelete = null; // Reset biến
        }
    };

    editForm.onsubmit = (e) => {
        e.preventDefault();

        if (!currentEditingRow) return;

        const ma = editForm['edit-ma'].value.trim();
        const ngay = editForm['edit-ngay'].value;
        const nguoi = editForm['edit-nguoi'].value.trim();
        const tong = editForm['edit-tong'].value.trim();
        const thanhtoan = editForm['edit-thanhtoan'].value.trim();
        const vanchuyen = editForm['edit-vanchuyen'].value.trim();

        if (!ma) return alert("Mã đơn hàng không được để trống");

        currentEditingRow.innerHTML = `
            <td>${ma}</td>
            <td>${ngay}</td>
            <td>${nguoi}</td>
            <td>${tong}</td>
            <td>${thanhtoan}</td>
            <td>${vanchuyen}</td>
            <td style="text-align:center">
                <i class="fas fa-edit edit-order" style="cursor: pointer;"></i>
                <i class="fas fa-minus delete-order" style="cursor: pointer; color: red;"></i>
            </td>
            <td style="text-align:center">
                <button class="view-order">Xem thêm</button>
            </td>
        `;

        editModal.style.display = 'none';
        editForm.reset();
        currentEditingRow = null;
    };

    updateCount();
});