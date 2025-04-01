<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css"
        href="<?php echo _BASE_URL; ?>/public/assets/clients/css/users/chat.css" />

</head>

<body>
    <div class="container">
        <?php if ($role == "admin") { ?>
            <div class="list_user" style="width: 25%;">
                <h2>Chats</h2>
                <ul>
                    <?php foreach ($chatList as $user) : ?>
                        <li>
                            <a href="<?php echo _BASE_URL; ?>/chat/<?php echo $user['user_id']; ?>">
                                <div><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/sticker/<?php echo $user['user_id'] ?>.png" />
                                    <?php echo htmlspecialchars($user['user_id']) . htmlspecialchars($user['fullname']); ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (!isset($admin_id)) : ?>
            <div class="context">
                <div class="message" style="text-align: center;">Bạn muốn nhắn tin cho ai</div>
                <form action="<?php echo  _BASE_URL; ?>/chat/sendMessage" method="POST">
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
                <div class="avatar">
                    <img src="" alt="User Avatar">
                </div>
                <div class="name">Tên</div>
                <div class="email">Email</div>
                <div class="phone">Phone</div>
            </div>

        <?php else : ?>
            <?php if ($role == "admin" || $role == "user") { ?>
                <div class="context">
                    <div class="message">
                        <!-- $msg['sender_id'] == $_SESSION['user_id'] -->
                        <?php if (count($messages) == 0) : ?>
                            <div style="text-align: center;">Bạn có thắc mắc gì</div>
                        <?php else : ?>
                            <?php foreach ($messages as $msg) : ?>
                                <?php if ($msg['sender_id'] == 2) : ?>
                                    <div class="message_right">
                                        <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'admin_avatar.png' : 'user_avatar_' . $msg['sender_id'] . '.png'; ?>" alt=""></div>
                                        <div class="content">
                                            <div class="name"><?php echo ($role == 'admin') ? 'Admin' : 'Bạn'; ?></div>
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
                                        <div class="avatar"><img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'user_avatar_' . $msg['sender_id'] . '.png' : 'admin_avatar.png'; ?>" alt=""></div>
                                        <div class="content">
                                            <div class="name"><?php echo ($role == 'admin') ? 'User ' . htmlspecialchars($msg['sender_id']) : 'Admin'; ?></div>
                                            <div class="text"><?php echo htmlspecialchars($msg['message']); ?></div>
                                            <div class="time"><?php echo $msg['formatted_time']; ?></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <form action="<?php echo _BASE_URL; ?>/chat/sendMessage" method="POST">
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
                    <div class="avatar">
                        <img src="<?php echo _BASE_URL; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'user_avatar_' . $userInfo['user_id'] . '.png' : 'admin_avatar.png'; ?>" alt="User Avatar">
                    </div>
                    <div class="name"><?php echo htmlspecialchars($userInfo['fullname']); ?></div>
                    <div class="email"><?php echo htmlspecialchars($userInfo['email']); ?></div>
                    <div class="phone"><?php echo htmlspecialchars($userInfo['phone']); ?></div>
                </div>
            <?php } ?>
        <?php endif; ?>
    </div>

    <script type="text/javascript" src=" <?php echo _BASE_URL; ?>/public/assets/clients/js/users/chat.js"></script>
</body>

</html>