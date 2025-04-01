<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="ProductCategory.css">
</head>

<body>
    <div class="container">
        <div class="filter-container">
            <span>Sắp xếp:</span>
            <button class="filter-button active" data-filter="name-asc">Tên A → Z</button>
            <button class="filter-button" data-filter="name-desc">Tên Z → A</button>
            <button class="filter-button" data-filter="price-asc">Giá tăng dần</button>
            <button class="filter-button" data-filter="price-desc">Giá giảm dần</button>
            <button class="filter-button" data-filter="newest">Hàng mới</button>
        </div>

        <div class="product-list">
            <div class="product">
                <img src="./img.jpg" alt="Bút xóa giấy">
                <p class="name">Bút xóa giấy</p>
                <p class="price"><span class="new">18.000đ</span> <span class="old">53.000đ</span></p>
                <button class="btn">Tùy chọn</button>
            </div>
            <div class="product">
                <img src="./img.jpg" alt="Bút mực nhiều màu">
                <p class="name">9 cây bút mực nhiều màu sắc xinh xắn</p>
                <p class="price"><span class="new">44.000đ</span> <span class="old">63.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="./img.jpg" alt="Bút highlight">
                <p class="name">Bút highlight pastel dạ quang ghi nhớ</p>
                <p class="price"><span class="new">15.000đ</span> <span class="old">35.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="./img.jpg" alt="Bút đánh dấu">
                <p class="name">Màu Sắc Bút Đánh Dấu Hai Đầu</p>
                <p class="price"><span class="new">24.000đ</span> <span class="old">43.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
            <div class="product">
                <img src="./img.jpg" alt="Bút đánh dấu">
                <p class="name">Màu Sắc Bút Đánh Dấu Hai Đầu</p>
                <p class="price"><span class="new">24.000n> <span class="old">43.000đ</span></p>
                <button class="btn">Xem ngay</button>
            </div>
        </div>
    </div>
</body>
</html>