<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
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
        <form action="forgot_pass.php" method="POST">
          <h4>Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu nhé!</h4>
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" placeholder="Nhập Email" required>
            <p class="forgot" onclick="redirectTo('signin.php')"><span>Quay lại</span> tại đây<p>
            <button type="submit" class="btn">Lấy lại mật khẩu</button>
          </form>
    </div>
        
</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
