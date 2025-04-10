<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link type="text/css" rel="stylesheet" 
      href=" <?php echo _WEB_ROOT; ?>//public/assets/clients/css/users/Signin-Signout/Signin-Signup.css"/>
      <script type="text/javascript" src=" <?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/Signin-Signup.js"></script>
      <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>

</head>
<body>
<?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
<div class="container">
    <div class="tabs">
        <div class="tab active" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-nhap'; ?>')">Đăng nhập</div>
        <div class="tab" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-ky'; ?>')">Đăng ký</div>
    </div>

    <div class="form-container active">
        <form action="<?php echo _WEB_ROOT . '/forgot_pass'; ?>" method="POST">
          <h4>Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu nhé!</h4>

          <!-- bao loi -->
<?php if (!empty($_SESSION['fail'])): ?>
                <div class="error-message"><?= $_SESSION['fail']; ?></div>
                <?php unset($_SESSION['fail']); ?>
            <?php endif; ?>

            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" value="<?= htmlspecialchars($_SESSION['oldEmail_forgotPass'] ?? '') ?>" placeholder="Nhập Email" required>
            <!-- Hiển thị lỗi Email -->
           
             <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <p class="forgot" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-nhap'; ?>')"><span>Quay lại</span> tại đây<p>
            <button type="submit" name="submit" class="btn">Lấy lại mật khẩu</button>
          </form>
    </div>
        
</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
