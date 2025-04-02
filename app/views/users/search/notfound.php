<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/search/notfound.css"/>
    <title>Không tìm thấy sản phẩm</title>
</head>
<body>
<?php  require_once _DIR_ROOT . "/app/views/blocks/header.php";?>
<?php  require_once _DIR_ROOT . "/app/views/blocks/menu.php";?>
    <div class="not-found-container">
        <h2>Rất tiếc, sản phẩm bạn tìm kiếm không tồn tại!</h2>
        <p>Hãy thử tìm kiếm sản phẩm khác hoặc quay về trang chủ </p>
    </div>
    <div class="not-found-footer">
    <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </div>
</body>
</html>
