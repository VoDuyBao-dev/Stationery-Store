<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signup.css"/>
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
        <form action="signin.php" method="POST">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" placeholder="Nhập Email" required>

            <label for="login-password">Mật khẩu</label>
            <input type="password" id="login-password" name="password" placeholder="Nhập Mật khẩu" required>
            <div class="forgot" onclick="redirectTo('forgot_pass.php')">Quên mật khẩu?</div>
            
            <button type="submit" class="btn">Đăng nhập</button>

        </form>
    </div>
</div>
<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</body>
</html>
