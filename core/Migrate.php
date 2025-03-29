<?php
require_once __DIR__ . "/../configs/database.php";
require_once __DIR__ . "/Connection.php";
require_once __DIR__ . "/Database.php";
global $config;
try {
    if (!is_array($config) || !isset($config['database'])) {
        die("Lỗi: Không thể tải cấu hình cơ sở dữ liệu!\n");
    }
    $db = Connection::getInstance($config['database'])->getConnection();
    echo "Kết nối database thành công!\n";
} catch (Exception $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

// Viết hàm để tọa id tự động cho tất cả các bảng có type = "int" size = 6;

// Danh sách các class migration cần chạy
$migrations = [
    'Users',
    'Brands',
    'Categories',
    'Products',
    'product_type',
    'Product_images',
    'Coupons',
    'transport',
    'Orders',
    'Order_details',
    'Stickers',
    'Chat',
    'Reviews'

];

// Chạy từng migration
foreach ($migrations as $migration) {
    require_once __DIR__ . "/../database/migrations/{$migration}.php";
    $migrationClass = new $migration();
    $migrationClass->up(); // Truyền kết nối vào class
}


echo "🎉 Tất cả bảng đã được tạo thành công!\n";
