<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signup.css"/>
    <scipt type="text/javascript" src="
        <?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/Signin-Signup.js"></scipt>
</head>
<body>
    
<?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
<div class="container">
    <div class="tabs">
        <div class="tab" onclick="redirectTo('signin.php')">Đăng nhập</div>
        <div class="tab active" onclick="redirectTo('register.php')">Đăng ký</div>
    </div>
    <h2 class="error-message"><?php if (!empty($fail)) {
            echo $fail;
        } ?></h2>


    <div class="form-container active">
        <form action="<?php echo _WEB_ROOT . '/dang-ky'; ?>" method="POST">
            <label for="ho">Họ</label>
            <input type="text" id="ho" name="ho" value="<?= htmlspecialchars($old_ho ?? '') ?>" placeholder="Nhập Họ"
                   required>
            <label for="ten">Tên</label>
            <input type="text" id="ten" name="ten" value="<?= htmlspecialchars($old_ten ?? '') ?>"
                   placeholder="Nhập Tên" required>

            <label for="sdt">Số điện thoại</label>
            <input type="tel" id="sdt" name="sdt" value="<?= htmlspecialchars($old_sdt ?? '') ?>"
                   placeholder="Nhập Số điện thoại" minlength="9" maxlength="13"
                   required>
            <!--Hiển thị lỗi của số điện thoại-->
            <?php if (!empty($error_sdt)) : ?>
                <div class="error-message"><?php echo $error_sdt; ?></div>
            <?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($old_email ?? '') ?>"
                   placeholder="Nhập Email" required>
            <!--error email-->

            <?php if (!empty($error_email)) : ?>
                <div class="error-message"><?php echo $error_email; ?></div>
            <?php endif; ?>

            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" autocomplete="off" placeholder=" Nhập Mật khẩu" required>

            <label for="password">Nhập lại mật khẩu</label>
            <input type="confirm-password" id="password" name="password" placeholder="Nhập Mật khẩu" required>

            <button type="submit" name="submit" class="btn">Tạo tài khoản</button>
        </form>
    </div>

</div>

<?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>

</body>
</html>
