<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../static/CSS/Signin-Signup.css">
    <script src="../static/java/Signin-Signup.js"></script>

</head>
<body>

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

            <button type="submit" class="btn">Đăng nhập</button>
        </form>
    </div>

    <!-- Form Đăng ký -->
    <div class="form-container">
        <form action="./register.php" method="POST">
            <label for="ho">Họ</label>
            <input type="text" id="ho" name="ho" placeholder="Nhập Họ" required>

            <label for="ten">Tên</label>
            <input type="text" id="ten" name="ten" placeholder="Nhập Tên" required>

            <label for="sdt">Số điện thoại</label>
            <input type="tel" id="sdt" name="sdt" placeholder="Nhập Số điện thoại" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập Email" required>

            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập Mật khẩu" required>

            <button type="submit" class="btn">Tạo tài khoản</button>
        </form>
    </div>
</div>


</body>
</html>
