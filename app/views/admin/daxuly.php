<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng</title>
    <link rel="stylesheet" href="daxuly.css">
</head>
<body>
    <div class="container">
        <h2>Quản lý đơn hàng</h2>
        <div class="tabs">
            <button class="tab">Cần xử lý (0)</button>
            <button class="tab active">Đã xử lý (0)</button>
        </div>

        <div class="actions">
            <input type="date" class="date-picker">
        </div>
        <div class="search-container">
            <input type="text" id="order-id" placeholder="Nhập mã đơn hàng">
            <button id="search-btn">Q</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Người sửa đơn</th>
                    <th>Thời gian sửa đơn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="no-data">Không có bản ghi nào</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <span>Bản Ghi Mỗi Trang</span>
            <select>
                <option>10</option>
                <option>20</option>
                <option>50</option>
            </select>
            <span>0 of 0</span>
            <button>&lt;</button>
            <button>&gt;</button>
        </div>
    </div>
</body>
</html>