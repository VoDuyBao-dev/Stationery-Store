<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Nhập OTP</title>

    <link rel="stylesheet" href="<?= _WEB_ROOT; ?>/public/assets/clients/css/users/Signin-Signout/otp.css"/>
</head>
<body>


<div class="otp-container">
    <h2>Xác thực OTP</h2>

    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if (!empty($error_otp)): ?>
        <div class="error-message"><?= htmlspecialchars($error_otp) ?></div>
    <?php endif; ?>
    <?php if (!empty($create_user)): ?>
        <div class="error-message"><?= htmlspecialchars($create_user) ?></div>
    <?php endif; ?>


    <form action="<?= _WEB_ROOT ?>/handle-otp" method="POST" class="otp-form">
    <!-- Input ẩn để xác định chức năng -->
    <input type="hidden" name="action" value="<?= htmlspecialchars($_GET['action'] ?? 'default') ?>">

        <div class="otp-inputs">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" inputmode="numeric" required/>
            <?php endfor; ?>
        </div>

        <button type="submit" name="submit">Xác nhận</button>

    </form>
    <!-- Nút Gửi lại mã OTP -->
    <button type="button" id="resendOtpBtn" class="resend-btn">Gửi lại mã OTP</button>

    <!-- Thông báo khi gửi lại mã OTP -->
    <div id="resendMessage" class="success-message" style="display: none;"></div>

</div>

<script>
    // Tự động chuyển sang ô tiếp theo khi nhập
    document.querySelectorAll('.otp-inputs input').forEach((input, index, inputs) => {
        input.addEventListener('input', (e) => {
            if (e.inputType !== 'deleteContentBackward') {
                if (input.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // Xử lý gửi lại mã OTP bằng AJAX
    document.getElementById('resendOtpBtn').addEventListener('click', function () {
        // Vô hiệu hóa nút khi đang xử lý để tránh spam
        const resendBtn = this;
        resendBtn.disabled = true;
        resendBtn.innerText = 'Đang gửi...';

        // Gửi yêu cầu AJAX đến controller để tạo và gửi lại OTP
        fetch('<?= _WEB_ROOT ?>/resend-otp', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {

                return response.text(); // Lấy dữ liệu thô trước khi parse JSON
            })
            .then(text => {

                try {
                    const data = JSON.parse(text); // Thử parse JSON
                    console.log("✅ JSON đã parse:", data);

                    const message = document.getElementById('resendMessage');
                    if (data.success) {
                        message.innerText = '✅ Mã OTP đã được gửi lại thành công!';
                        message.style.color = 'green';
                    } else {
                        message.innerText = `❌ ${data.error}`;
                        message.style.color = 'red';
                    }
                    message.style.display = 'block';
                } catch (e) {
                    console.error("❌ Lỗi khi parse JSON:", e, text);
                }
            })
            .catch(error => {
                console.error("❌ Lỗi khi xử lý phản hồi:", error);
            })
            .finally(() => {
                resendBtn.disabled = false;
                resendBtn.innerText = 'Gửi lại mã OTP';
            });
    });

</script>

</body>
</html>

