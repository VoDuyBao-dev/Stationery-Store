<?php

// require_once __DIR__ . "/../bootstrap.php";

require_once __DIR__ . "/../core/Connection.php";

// Kết nối đến database
try {
    $config = require __DIR__ . "/../configs/database.php";
    if (!is_array($config) || !isset($config['database'])) {
        die("❌ Lỗi: Không thể tải cấu hình cơ sở dữ liệu!\n");
    }
    $db = Connection::getInstance($config['database'])->getConnection();
    echo "✅ Kết nối database thành công!\n";
} catch (Exception $e) {
    die("❌ Lỗi kết nối: " . $e->getMessage());
}

// Danh sách các class migration cần chạy
$migrations = [
    'Users',
    'Brands',
    'Categories',
    'Products',
    'Product_images',
    'Orders',
    'Order_details',
    'Coupons',
    'Chat',
    'Reviews',
    'Icons_stickers'
];

// Chạy từng migration
foreach ($migrations as $migration) {

    require_once __DIR__ . "/../database/migrations/{$migration}.php";
    $migrationClass = new $migration();
    $migrationClass->up(); // Truyền kết nối vào class
}


echo "🎉 Tất cả bảng đã được tạo thành công!\n";
