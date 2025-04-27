<?php $breadcrumb = "Nhập mật khẩu mới"; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập mật khẩu mới</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signout/Signin-Signup.css"/>
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
        <form action="<?php echo _WEB_ROOT . '/change_password'; ?>" method="POST">
          <h4>Cài lại mật khẩu mới</h4>
          <label for="login-password">Mật khẩu mới</label>
          <input type="password" id="login-password" name="newPassword" placeholder="Nhập Mật khẩu" required>

          <label for="login-password">Nhập lại mật khẩu mới</label>
          <input type="password" id="login-password" name="conf_new_password" placeholder="Nhập Mật khẩu" required>
          
           <!-- Hiển thị lỗi -->
           <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <button type="submit" name="submit-newPass" class="btn">Đăng nhập</button>
          </form>
          
    </div>
        
</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
