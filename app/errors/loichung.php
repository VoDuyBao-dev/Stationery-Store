<?php
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Đã xảy ra lỗi!';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lỗi hệ thống</title>
</head>
<body>
<h2>Đã xảy ra lỗi:</h2>
<p><?php echo $message; ?></p>
<a href="/">Quay lại trang chủ</a>
</body>
</html>

