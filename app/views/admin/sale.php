<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khuyến mãi</title>
    <link rel="stylesheet" href="sale.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Quản lý Khuyến mãi</h2>

        <div id="promotion-actions">
            <button id="add-promotion-btn">Thêm khuyến mãi mới</button>
        </div>

        <table id="promotion-table">
            <thead>
                <tr>
                    <th>Mã giảm giá</th>
                    <th>Giá tối thiểu</th>
                    <th>Giảm (%)</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr id="no-data-row">
                    <td colspan="7" class="no-data">Không có khuyến mãi nào</td>
                </tr>
            </tbody>
        </table>

        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close add-modal-close">&times;</span>
                <h2>Thêm khuyến mãi mới</h2>
                <form id="promotion-form">
                    <div class="form-group">
                        <label for="ma-giam-gia">Mã giảm giá:</label>
                        <input type="text" id="ma-giam-gia" name="ma-giam-gia" required>
                    </div>
                    <div class="form-group">
                        <label for="gia-toi-thieu">Giá tối thiểu:</label>
                        <input type="number" id="gia-toi-thieu" name="gia-toi-thieu" min="0">
                    </div>
                    <div class="form-group">
                        <label for="giam">Giảm (%):</label>
                        <input type="number" id="giam" name="giam" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="ngay-bat-dau">Ngày bắt đầu:</label>
                        <input type="date" id="ngay-bat-dau" name="ngay-bat-dau" required>
                    </div>
                    <div class="form-group">
                        <label for="ngay-ket-thuc">Ngày kết thúc:</label>
                        <input type="date" id="ngay-ket-thuc" name="ngay-ket-thuc" required>
                    </div>
                    <div class="form-group">
                        <label for="trang-thai">Trạng thái:</label>
                        <select id="trang-thai" name="trang-thai">
                            <option value="Đang áp dụng">Đang áp dụng</option>
                            <option value="Hết hạn">Hết hạn</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-btn add-modal-close">Hủy</button>
                        <button type="submit">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close edit-modal-close">&times;</span>
                <h2>Sửa khuyến mãi</h2>
                <form id="edit-promotion-form">
                    <div class="form-group">
                        <label for="edit-ma-giam-gia">Mã giảm giá:</label>
                        <input type="text" id="edit-ma-giam-gia" name="edit-ma-giam-gia" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit-gia-toi-thieu">Giá tối thiểu:</label>
                        <input type="number" id="edit-gia-toi-thieu" name="edit-gia-toi-thieu" min="0">
                    </div>
                    <div class="form-group">
                        <label for="edit-giam">Giảm (%):</label>
                        <input type="number" id="edit-giam" name="edit-giam" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="edit-ngay-bat-dau">Ngày bắt đầu:</label>
                        <input type="date" id="edit-ngay-bat-dau" name="edit-ngay-bat-dau" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-ngay-ket-thuc">Ngày kết thúc:</label>
                        <input type="date" id="edit-ngay-ket-thuc" name="edit-ngay-ket-thuc" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-trang-thai">Trạng thái:</label>
                        <select id="edit-trang-thai" name="edit-trang-thai">
                            <option value="Đang áp dụng">Đang áp dụng</option>
                            <option value="Hết hạn">Hết hạn</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-btn edit-modal-close">Hủy</button>
                        <button type="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal xác nhận xóa -->
<div id="confirmDeleteModal" class="modal">
    <div class="modal-content">
        <h3>Bạn có chắc chắn muốn xóa khuyến mãi này?</h3>
        <div class="form-actions">
            <button id="cancelDeleteBtn" class="cancel-btn">Hủy</button>
            <button id="confirmDeleteBtn">Xóa</button>
        </div>
    </div>
</div>

    <script src="sale.js"></script>
</body>
</html>