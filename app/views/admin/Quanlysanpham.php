<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh Sách Sản Phẩm</title>
  </head>
  <body>
    <div class="container">
      <h2>Danh Sách Sản Phẩm</h2>

      <!-- Các nút chức năng -->
      <div class="btn-group">
        <button class="btn btn-green">+ Tạo mới sản phẩm</button>
        <button class="btn btn-red">Xuất Excel</button>
        <button class="btn btn-gray">Xóa tất cả</button>
      </div>

      <!-- Ô tìm kiếm -->
      <div class="search-box">
        <input type="text" placeholder="Tìm kiếm..." />
      </div>

      <!-- Bảng danh sách sản phẩm -->
      <table class="product-table">
        <thead>
          <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Số lượng</th>
            <th>Tình trạng</th>
            <th>Giá bán</th>
            <th>Giá vốn</th>
            <th>Danh mục</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
            <!-- Sản phẩm 1 -->
          <tr>
            <td>VPP001</td>
            <td>Bút bi Thiên Long</td>
            <td><img src="/img/but.webp" alt="Bút bi" /></td>
            <td>100</td>
            <td><span class="badge in-stock">Còn hàng</span></td>
            <td>5.000 đ</td>
            <td>4.000 đ</td>
            <td>Bút viết</td>
            <td>
              <button class="action-btn edit">Sửa</button>
              <button class="action-btn delete">Xóa</button>
            </td>
          </tr>
           <!-- Sản phẩm 2 -->
          <tr>
            <td>VPP002</td>
            <td>Sổ tay A5</td>
            <td><img src="/img/but.webp" alt="Sổ tay" /></td>
            <td>50</td>
            <td><span class="badge in-stock">Còn hàng</span></td>
            <td>25.000 đ</td>
            <td>20.000 đ</td>
            <td>Sổ tay</td>
            <td>
              <button class="action-btn edit">Sửa</button>
              <button class="action-btn delete">Xóa</button>
            </td>
          </tr>
        </tr>
        <!-- Sản phẩm 3 -->
          <tr>
            <td>VPP003</td>
            <td>Thước kẻ 30cm</td>
            <td><img src="/img/but.webp" alt="Thước kẻ" /></td>
            <td>0</td>
            <td><span class="badge out-stock">Hết hàng</span></td>
            <td>10.000 đ</td>
            <td>9.000 đ</td>
            <td>Dụng cụ học tập</td>
            <td>
              <button class="action-btn edit">Sửa</button>
              <button class="action-btn delete">Xóa</button>
            </td>
          </tr>
           <!-- Sản phẩm 4 -->
           <tr>
            <td>VPP003</td>
            <td>Thước kẻ 30cm</td>
            <td><img src="/img/but.webp" alt="Thước kẻ" /></td>
            <td>0</td>
            <td><span class="badge out-stock">Hết hàng</span></td>
            <td>10.000 đ</td>
            <td>8.000 đ</td>
            <td>Dụng cụ học tập</td>
            <td>
              <button class="action-btn edit">Sửa</button>
              <button class="action-btn delete">Xóa</button>
            </td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </body>
</html>
