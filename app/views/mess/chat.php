
<?php $breadcrumb = "Chat"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css"
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/chat.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/cart/cart.js"></script>

    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        main {
            margin-left: 280px;
        }
    </style>
</head>

<body>
    <?php if ($role == "admin") : ?>
        <?php include_once _DIR_ROOT . '/app/views/blocks/header-admin.php'; ?> 
        <?php include_once _DIR_ROOT . '/app/views/blocks/menu-admin.php'; ?>
    <?php else : ?>
        <?php include_once _DIR_ROOT . '/app/views/blocks/header.php'; ?> 
        <?php include_once _DIR_ROOT . '/app/views/blocks/menu.php'; ?>
    <?php endif;?>
    <main>
    <div class="chat-container">
        <?php if ($role == "admin") { ?>
            <div class="list_user" style="width: 25%;">
                <h2>Stationery</h2>
                <ul>
                    <?php foreach ($chatList as $oneUser) : ?>
                        <li>
                            <a href="<?php echo _BASE_URL; ?>/chat/<?php echo $oneUser['user_id']; ?>">
                                <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'user') ? 'admin_avatar.png' : 'user_avatar.png'; ?>" alt=""></div>
                                <?php echo htmlspecialchars($oneUser['fullname']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>
        <?php if ($role == "admin" || $role == "user") { ?>
            <div class="context">
                <div class="message">
                    <?php if (count($messages) == 0) : ?>
                        <div style="text-align: center;">Bạn có thắc mắc gì? Ngu thì đừng thắc mắc</div>
                    <?php else : ?>
                        <?php foreach ($messages as $msg) : ?>
                            <?php if ($msg['sender_id'] == $sender_id) : ?>
                                <div class="message_right">
                                    <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'admin_avatar.png' : 'user_avatar.png'; ?>" alt=""></div>
                                    <div class="content">
                                        <div class="text"> <?php if ($msg['sticker_id'] != 1) : ?>
                                                <img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/sticker/<?php echo htmlspecialchars($msg['sticker_id']); ?>.png" class="sticker-img">
                                            <?php else : ?>
                                                <?php echo htmlspecialchars($msg['message']); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="time"><?php echo $msg['formatted_time']; ?></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="message_left">
                                    <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'user') ? 'admin_avatar.png' : 'user_avatar.png'; ?>" alt=""></div>
                                    <div class="content">
                                        <div class="text"> <?php if ($msg['sticker_id'] != 1) : ?>
                                                <img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/sticker/<?php echo htmlspecialchars($msg['sticker_id']); ?>.png" class="sticker-img">
                                            <?php else : ?>
                                                <?php echo htmlspecialchars($msg['message']); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="time"><?php echo $msg['formatted_time']; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <form action="<?php echo _BASE_URL; ?>/sendMessage" method="POST">
                    <div class="input">
                        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                        <input type="hidden" id="stickerInput" name="sticker_id" value="1"> <!-- Input ẩn cho sticker -->
                        <input type="text" id="messageInput" name="message" placeholder="Nhập tin nhắn..." required>
                        <button type="button" onclick="toggleStickerMenu()">🖼 Sticker</button>
                        <button type="submit">Gửi</button>
                    </div>
                    <div id="stickerMenu" class="sticker-menu">
                        <?php foreach ($allSticker as $index => $sticker): ?>
                            <?php if ($index === (count($allSticker) - 1)) break;  ?>
                            <img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/sticker/<?php echo $sticker["sticker_id"] ?>.png" id=<?php echo $sticker["sticker_id"] ?> onclick="selectSticker(this)">
                        <?php endforeach; ?>
                    </div>
                </form>

            </div>

            <div class="information">
                <h2>Thông tin chi tiết</h2>
                <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'user') ? 'admin_avatar.png' : 'user_avatar.png'; ?>" alt=""></div>
                <div class="name"><?php echo $information['fullname']; ?></div>
                <div class="email"><?php echo $information['email']; ?></div>
                <div class="phone"><?php echo $information['phone']; ?></div>
            </div>
        <?php } ?>
    </div>

    <script type="text/javascript" src=" <?php echo _BASE_URL; ?>/public/assets/clients/js/users/chat.js"></script>
    
    <?php include_once _DIR_ROOT . '/app/views/blocks/footer.php'; ?>
    </main>
    <!-- <script>
        function selectSticker(sticker) {
            const stickerId = sticker.id;
            document.getElementById('stickerInput').value = stickerId; // Cập nhật giá trị của input ẩn
            document.getElementById('messageInput').value = ''; // Xóa nội dung tin nhắn
        }

        function toggleStickerMenu() {
            const stickerMenu = document.getElementById('stickerMenu');
            stickerMenu.style.display = (stickerMenu.style.display === 'block') ? 'none' : 'block';
        }
    </script> -->

</body>

</html>