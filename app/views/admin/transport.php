<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phương thức vận chuyển</title>
    <style>
        .form-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .form-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            min-width: 300px;
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
    <script>
        const BASE_URL = "<?php echo _BASE_URL; ?>";
    </script>
</head>

<body>

    <div>
        <h2>Danh sách phương thức vận chuyển</h2>
        <div>
            <button onclick="showForm('add')">Thêm mới
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên phương thức</th>
                    <th>Giá (VNĐ)</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getAllTransport as $transport) : ?>
                    <tr>
                        <td><?php echo $transport['transport_id'] ?></td>
                        <td><?php echo $transport['name'] ?></td>
                        <td><?php echo $transport['price'] ?></td>
                        <td>
                            <button onclick="showForm('edit', <?php echo $transport['transport_id'] ?>, '<?php echo $transport['name'] ?>', <?php echo $transport['price'] ?>)"> Sửa
                            </button>
                            <button onclick="showForm('delete', <?php echo $transport['transport_id'] ?>)"> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- Form Thêm -->
    <div id="form-add" class="form-overlay" style="display: none;">
        <div class="form-content">
            <span class="close-btn" onclick="closeForm('form-add')">&times;</span>
            <h4>Thêm phương thức vận chuyển</h4>
            <form id="addForm">
                <label>Tên phương thức:</label>
                <input type="text" id="addName" class="form-control" placeholder="Nhập tên" required>
                <label class="mt-2">Giá (VNĐ):</label>
                <input type="number" id="addPrice" class="form-control" placeholder="Nhập giá" required>
                <button type="button" onclick="submitAdd()">Thêm</button>
            </form>
        </div>
    </div>

    <!-- Form Sửa -->
    <div id="form-edit" class="form-overlay" style="display: none;">
        <div class="form-content">
            <span class="close-btn" onclick="closeForm('form-edit')">&times;</span>
            <h4>Sửa phương thức vận chuyển</h4>
            <form id="editForm">
                <input type="hidden" id="editId">
                <label>Tên phương thức:</label>
                <input type="text" id="editName" class="form-control" required>
                <label class="gia">Giá (VNĐ):</label>s
                <input type="number" id="editPrice" required>
                <button type="button" onclick="submitEdit()">Sửa</button>
            </form>
        </div>
    </div>

    <!-- Form Xóa -->
    <div id="form-delete" class="form-overlay" style="display: none;">
        <div class="form-content">
            <span class="close-btn" onclick="closeForm('form-delete')">&times;</span>
            <h4>Xóa phương thức vận chuyển</h4>
            <p>Bạn có chắc chắn muốn xóa phương thức này không?</p>
            <input type="hidden" id="deleteId">
            <button type="button" onclick="submitDelete()">Xóa</button>
        </div>
    </div>


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/transport.js"></script>

</body>

</html>