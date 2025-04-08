<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tạo mới sản phẩm</title>
    <link rel="stylesheet" href="/css/TaoSp.css" />
  </head>
  <body>
    <div class="container">
      <div class="header_1">
        <a href="/duong-dan-den-trang-danh-sach-san-pham">
          <h1>Danh sách sản phẩm / Thêm sản phẩm</h1>
        </a>
      </div>
      <div class="content">
        <h2 style="margin-bottom: 20px; font-size: 30px;">Tạo mới sản phẩm</h2>
        <form class="form">
          <div class="form-row">
            <div class="form-group">
              <label for="ma-san-pham">Mã sản phẩm</label>
              <input type="text" id="ma-san-pham" />
            </div>
            <div class="form-group">
              <label for="ten-san-pham">Tên sản phẩm</label>
              <input type="text" id="ten-san-pham" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="so-luong">Số lượng</label>
              <input type="number" id="so-luong" />
            </div>
            <div class="form-group">
              <label for="tinh-trang">Tình trạng</label>
              <select id="tinh-trang">
                <option value="">- Chọn tình trạng -</option>
                <option value="con-hang">Còn hàng</option>
                <option value="het-hang">Hết hàng</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="danh-muc">Danh mục</label>
              <select id="danh-muc">
                <option value="">- Chọn danh mục -</option>
                <option value=""></option>
                <option value=""></option>
              </select>
            </div>
            <div class="form-group">
              <label for="gia-ban">Giá bán</label>
              <input type="number" id="gia-ban" />
            </div>
            <div class="form-group">
              <label for="gia-von">Giá vốn</label>
              <input type="number" id="gia-von" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group-full">
              <label for="anh-san-pham">Ảnh sản phẩm</label>
              <button type="button" id="chon-anh">Chọn ảnh</button>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group-full1">
              <label for="mo-ta-san-pham">Mô tả sản phẩm</label>
              <textarea id="mo-ta-san-pham"></textarea>
            </div>
          </div>

          <div class="form-row buttons">
            <button type="submit" class="btn-luu">Lưu lại</button>
            <button type="button" class="btn-huy">Hủy bỏ</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
