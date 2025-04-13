<?php
use core\Helpers;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signout/Signin-Signup.css"/>
    <script type="text/javascript"
            src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/Signin-Signup.js"></script>

            <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
</head>
<body>
<?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>



<div class="container">
        <div class="tabs">
        <div class="tab active" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-nhap'; ?>')">Đăng nhập</div>
                 <div class="tab" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-ky'; ?>')">Đăng ký</div>
     </div> 

     <!-- Hiển thị cảnh báo  -->
<?php if (!empty($_SESSION['warning_signin'])): ?>
    <div class="error-message"><?= $_SESSION['warning_signin']; ?></div>
<?php endif; ?>

<!-- Hiển thị đăng ký thành công -->
<?php if ($message = Helpers::getFlash('success')): ?>
    <div class="success-message"><?php echo $message; ?></div>
<?php endif; ?>


    

    <div class="form-container active">
        <form action="<?php echo _WEB_ROOT . '/dang-nhap'; ?>" method="POST">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email"
                   value="<?= htmlspecialchars($_SESSION['old_email'] ?? '') ?>"
                   placeholder="Nhập Email" required>

            <!-- Hiển thị lỗi -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <label for="login-password">Mật khẩu</label>
            <input type="password" id="login-password" name="password" placeholder="Nhập Mật khẩu" required>
            <div class="forgot"><a href="<?php echo _WEB_ROOT; ?>/forgot_pass"> Quên mật khẩu?</a></div>

            <button type="submit" name="submit-signin" class="btn">Đăng nhập</button>

        </form>

        
    </div>
    <div>
    <a href="<?= $url ?? ''?>">Đăng nhập với google</a>
    </div>


</div>


<?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
</body>
</html>