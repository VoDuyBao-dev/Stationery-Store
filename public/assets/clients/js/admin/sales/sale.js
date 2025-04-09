document.addEventListener('DOMContentLoaded', function () {
    const addPromotionBtn = document.getElementById('add-promotion-btn');
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    const addModalCloseBtns = document.querySelectorAll('.add-modal-close');
    const editModalCloseBtns = document.querySelectorAll('.edit-modal-close');
    const promotionForm = document.getElementById('promotion-form');
    const editPromotionForm = document.getElementById('edit-promotion-form');
    const promotionTableBody = document.getElementById('promotion-table').querySelector('tbody');
    const noDataRow = document.getElementById('no-data-row');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    let promotions = [];
    let editingRowIndex = null;
    let deleteRowIndex = null;

    addModal.style.display = 'none';
    editModal.style.display = 'none';
    confirmDeleteModal.style.display = 'none';

    addPromotionBtn.addEventListener('click', function () {
        addModal.style.display = 'flex';
        promotionForm.reset();
    });

    addModalCloseBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            addModal.style.display = 'none';
        });
    });

    editModalCloseBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            editModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target === addModal) addModal.style.display = 'none';
        if (event.target === editModal) editModal.style.display = 'none';
        if (event.target === confirmDeleteModal) confirmDeleteModal.style.display = 'none';
    });

    promotionForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(promotionForm);
        const newPromotion = {
            maGiamGia: formData.get('ma-giam-gia'),
            giaToiThieu: parseFloat(formData.get('gia-toi-thieu')) || 0,
            giam: parseInt(formData.get('giam')) || 0,
            ngayBatDau: formData.get('ngay-bat-dau'),
            ngayKetThuc: formData.get('ngay-ket-thuc'),
            trangThai: formData.get('trang-thai')
        };
        promotions.push(newPromotion);
        renderPromotions();
        addModal.style.display = 'none';
    });

    promotionTableBody.addEventListener('click', function (event) {
        const row = event.target.closest('tr');
        const index = parseInt(row.dataset.index);

        if (event.target.classList.contains('delete-promotion')) {
            deleteRowIndex = index;
            confirmDeleteModal.style.display = 'flex';
        } else if (event.target.classList.contains('edit-promotion')) {
            editingRowIndex = index;
            populateEditForm(promotions[index]);
            editModal.style.display = 'flex';
        }
    });

    cancelDeleteBtn.addEventListener('click', function () {
        confirmDeleteModal.style.display = 'none';
        deleteRowIndex = null;
    });

    confirmDeleteBtn.addEventListener('click', function () {
        if (deleteRowIndex !== null) {
            promotions.splice(deleteRowIndex, 1);
            renderPromotions();
            confirmDeleteModal.style.display = 'none';
            deleteRowIndex = null;
        }
    });

    editPromotionForm.addEventListener('submit', function (event) {
        event.preventDefault();
        if (editingRowIndex !== null) {
            const formData = new FormData(editPromotionForm);
            promotions[editingRowIndex] = {
                maGiamGia: formData.get('edit-ma-giam-gia'),
                giaToiThieu: parseFloat(formData.get('edit-gia-toi-thieu')) || 0,
                giam: parseInt(formData.get('edit-giam')) || 0,
                ngayBatDau: formData.get('edit-ngay-bat-dau'),
                ngayKetThuc: formData.get('edit-ngay-ket-thuc'),
                trangThai: formData.get('edit-trang-thai')
            };
            renderPromotions();
            editModal.style.display = 'none';
            editingRowIndex = null;
        }
    });

    function populateEditForm(promotion) {
        document.getElementById('edit-ma-giam-gia').value = promotion.maGiamGia;
        document.getElementById('edit-gia-toi-thieu').value = promotion.giaToiThieu;
        document.getElementById('edit-giam').value = promotion.giam;
        document.getElementById('edit-ngay-bat-dau').value = promotion.ngayBatDau;
        document.getElementById('edit-ngay-ket-thuc').value = promotion.ngayKetThuc;
        document.getElementById('edit-trang-thai').value = promotion.trangThai;
    }

    function renderPromotions() {
        promotionTableBody.innerHTML = '';
        if (promotions.length === 0) {
            noDataRow.style.display = '';
        } else {
            noDataRow.style.display = 'none';
            promotions.forEach((promotion, index) => {
                const row = promotionTableBody.insertRow();
                row.dataset.index = index;
                row.innerHTML = `
                    <td>${promotion.maGiamGia}</td>
                    <td>${promotion.giaToiThieu}</td>
                    <td>${promotion.giam}%</td>
                    <td>${promotion.ngayBatDau}</td>
                    <td>${promotion.ngayKetThuc}</td>
                    <td>${promotion.trangThai}</td>
                    <td class="actions">
                        <i class="fas fa-edit edit-promotion"></i>
                        <i class="fas fa-minus delete-promotion"></i>
                    </td>
                `;
            });
        }
    }
});
