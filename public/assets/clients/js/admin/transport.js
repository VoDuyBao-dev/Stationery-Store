function showForm(action, id = null, name = '', price = 0) {
    if (action === 'add') {
        document.getElementById('form-add').style.display = 'flex';
    } else if (action === 'edit') {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editPrice').value = price;
        document.getElementById('form-edit').style.display = 'flex';
    } else if (action === 'delete') {
        document.getElementById('deleteId').value = id;
        document.getElementById('form-delete').style.display = 'flex';
    }
}

function closeForm(formId) {
    document.getElementById(formId).style.display = 'none';
}

function submitAdd() {
    const name = document.getElementById('addName').value;
    const price = document.getElementById('addPrice').value;

    if (!name || !price) {
        alert('Vui lòng nhập đầy đủ thông tin!');
        return;
    }

    // Gửi dữ liệu thêm mới đến server
    fetch('<?php echo _BASE_URL; ?>/admin/transportHandler', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'add', name, price })
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        });
}

function submitEdit() {
    const id = document.getElementById('editId').value;
    const name = document.getElementById('editName').value;
    const price = document.getElementById('editPrice').value;

    if (!name || !price) {
        alert('Vui lòng nhập đầy đủ thông tin!');
        return;
    }

    // Gửi dữ liệu chỉnh sửa đến server
    fetch('<?php echo _BASE_URL; ?>/admin/transportHandler', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'edit', id, name, price })
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        });
}

function submitDelete() {
    const id = document.getElementById('deleteId').value;

    // Gửi yêu cầu xóa đến server
    fetch('<?php echo _BASE_URL; ?>/admin/transportHandler', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'delete', id })
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        });
}