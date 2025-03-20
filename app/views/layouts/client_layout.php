<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client layout</title>

</head>
<body>

<div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <h2 style="color: green" ">Đăng ký thành công!</h2>
    <?php endif; ?>
    <h2>Đây là nội dung của client_layout</h2>

</div>


</body>
</html>
