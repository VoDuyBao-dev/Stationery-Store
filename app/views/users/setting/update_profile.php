<?php
session_start(); // Nếu bạn dùng session để xác định user đang đăng nhập

// Kết nối database
$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Lấy dữ liệu từ form
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// ID người dùng – giả sử bạn lưu trong session
$user_id = $_SESSION['user_id'] ?? 1; // Thay bằng session thực tế nếu có

// Câu truy vấn cập nhật (tùy theo có nhập mật khẩu hay không)
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name = ?, phone = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $phone, $email, $hashedPassword, $user_id]);
} else {
    $sql = "UPDATE users SET name = ?, phone = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $phone, $email, $user_id]);
}

// Chuyển hướng về trang profile
header("Location: edit_profile.php?status=success");
exit();
