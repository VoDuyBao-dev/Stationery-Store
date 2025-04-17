<?php
// Ví dụ dữ liệu người dùng từ database
$user = [
    'name' => 'Nguyễn Văn A',
    'phone' => '0123456789',
    'email' => 'example@gmail.com'
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông tin cá nhân</title>
  <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/setting/chinhsuathongtin.css">
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
</head>
<body>
<header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
  </header>  

<div class="form-container">
  <h1>Thông tin cá nhân</h1>
  <form action="<?php echo _WEB_ROOT;?>/app/users/setting/update_profile.php" method="POST" id="profileForm">
    <label for="name">Họ và tên</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>"  required>

    <label for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled readonly>

    <label for="address">Địa chỉ</label>
    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>

    <div class="button-group">
      <button type="button" id="editBtn"  class="form-button">Cập nhật thông tin</button>
      
    </div>
  </form>
</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
