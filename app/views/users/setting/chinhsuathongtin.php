<?php
// Ví dụ dữ liệu người dùng từ database
use core\Helpers;
$user = $_SESSION['user'] ?? "";

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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
</head>
<body>
<header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
  </header>  

<div class="form-container">
  <h1>Thông tin cá nhân</h1>
 
    
    
  <form action="<?php echo _WEB_ROOT;?>/chinh-sua-thong-tin" method="POST" id="profileForm">
    <label for="name">Họ và tên</label>
<<<<<<< HEAD
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>"  required>

    <label for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled readonly>

    <label for="address">Địa chỉ</label>
    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>
=======
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['fullname']) ?>" placeholder="Nhập họ và tên" required>

    <label for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Nhập số điện thoại" required>

    <?php if ($message = Helpers::getFlash('error_sdt')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled   readonly>

>>>>>>> bad4a40b9b25beca09f4563b540fc206f9c6fa8b

    <label for="address">Địa chỉ</label>  
    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" placeholder="Nhập địa chỉ" required>

    <?php if ($message = Helpers::getFlash('error_address')): ?>
    <div class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <input type="hidden" name="user_id" value="<?=$user['user_id'] ?>">
    <div class="button-group">
<<<<<<< HEAD
      <button type="button" id="editBtn"  class="form-button">Cập nhật thông tin</button>
=======
      <button type="submit" name="submit" id="editBtn"  class="form-button">Cập nhật thông tin</button>
>>>>>>> bad4a40b9b25beca09f4563b540fc206f9c6fa8b
      
    </div>
  </form>
</div>

<<<<<<< HEAD
=======
<script>
  function enableEdit() {

    document.getElementById('editBtn').style.display = 'none';
    document.getElementById('profileForm').style.display = 'inline-block';
  }
</script>


<?php if ($noti = Helpers::getFlash('notification')): ?>
<script>
Swal.fire({
    title: <?= $noti['type'] === 'success' ? "'Thành công!'" : "'Thất bại!'" ?>,
    text: decodeURIComponent("<?= rawurlencode($noti['message']) ?>"),
    icon: "<?= $noti['type'] ?>",
    confirmButtonText: "OK"
});
</script>
<?php endif; ?>

>>>>>>> bad4a40b9b25beca09f4563b540fc206f9c6fa8b
<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
