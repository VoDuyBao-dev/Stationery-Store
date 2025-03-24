<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signup.css"/>


</head>
<body>
<!-- Hiển thị cảnh báo  -->
<?php if (!empty($_SESSION['signin_incorrect'])): ?>
    <div class="error-message"><?= $_SESSION['signin_incorrect']; ?></div>
<?php endif; ?>

<div class="container">
    <div class="tabs">
        <div class="tab active" onclick="redirectTo('signin.php')">Đăng nhập</div>
        <div class="tab" onclick="redirectTo('register.php')">Đăng ký</div>
    </div>

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

            <button type="submit" name="submit-signin" class="btn">Đăng nhập</button>
        </form>
    </div>


</div>


</body>
</html>
