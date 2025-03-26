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

// Danh sách các class migration cần chạy
$migrations = [
    'Users',
    'Brands',
    'Categories',
    'Products',
    'Product_images',
    'Coupons',
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
