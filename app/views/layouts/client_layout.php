<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery</title>
    <style>
        menu {
            float: left;
        }

        main {
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>
</head>

<body>
    <header>
        <?php require_once _DIR_ROOT . "/app/views/blocks/header.php"; ?>
    </header>

    <menu>
        <?php require_once _DIR_ROOT . "/app/views/blocks/menu.php"; ?>
    </menu>
    <main>
        <?php require_once _DIR_ROOT . "/app/views/users/TrangChu.php" ?>
    </main>

    <footer>
        <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
    </footer>


</body>

</html>