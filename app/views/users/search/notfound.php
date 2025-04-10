<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/users/search/notfound.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
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
