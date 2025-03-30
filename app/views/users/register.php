<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link type="text/css" rel="stylesheet"
          href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signup.css"/>
    <script type="text/javascript" src=" <?php echo _WEB_ROOT; ?>/public/assets/clients/js/users/Signin-Signup.js"></script>
       
</head>
<body>

<?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>
<div class="container">
<div class="tabs">
        <div class="tab" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-nhap'; ?>')">Đăng nhập</div>
                 <div class="tab active" onclick="redirectTo('<?php echo _WEB_ROOT . '/dang-ky'; ?>')">Đăng ký</div>
     </div> 

     <!-- bao loi -->
<?php if (!empty($_SESSION['fail'])): ?>
                <div class="error-message"><?= $_SESSION['fail']; ?></div>
                <?php unset($_SESSION['fail']); ?>
            <?php endif; ?>


    <div class="form-container active">
        <form action="<?php echo _WEB_ROOT . '/dang-ky'; ?>" method="POST">
            <label for="ho">Họ và tên</label>
            <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($old_fullname ?? '') ?>"
                   placeholder="Nhập Họ và tên"
                   required>


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
            <input type="password" id="password" name="password" autocomplete="off" placeholder=" Nhập Mật khẩu"
                   required>

            <label for="password">Nhập lại mật khẩu</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập Lại mật khẩu" required>
              <!--Hiển thị lỗi của confirm password-->
              <?php if (!empty($error_confirmPassword)) : ?>
                <div class="error-message"><?php echo $error_confirmPassword; ?></div>
            <?php endif; ?>

            <button type="submit" name="submit" class="btn">Tạo tài khoản</button>
        </form>
    </div>

</div>

<?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>

</body>
</html>
