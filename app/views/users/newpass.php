<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập mật khẩu mới</title>
    <link type="text/css" rel="stylesheet" 
      href=" <?php echo _WEB_ROOT; ?>//public/assets/clients/css/users/Signin-Signup.css"/>
    <scipt type="text/javascript" src="
      <?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/Signin-Signup.js"></scipt>

</head>
<body>
<?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
<div class="container">
    <div class="tabs">
        <div class="tab active" onclick="redirectTo('signin.php')">Đăng nhập</div>
        <div class="tab" onclick="redirectTo('register.php')">Đăng ký</div>
    </div>

    <div class="form-container active">
        <form action="newpass.php" method="POST">
          <h4>Cài lại mật khẩu mới</h4>
          <label for="login-password">Mật khẩu mới</label>
          <input type="newpassword" id="login-password" name="password" placeholder="Nhập Mật khẩu" required>

          <label for="login-password">Nhập lại mật khẩu mới</label>
          <input type="confirm-newpassword" id="login-password" name="password" placeholder="Nhập Mật khẩu" required>

            <button type="submit" class="btn">Đăng nhập</button>
          </form>
    </div>
        
</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
