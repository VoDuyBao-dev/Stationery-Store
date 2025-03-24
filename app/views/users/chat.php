<?php
session_start();
// $isAdmin = $_SESSION['role'] == 'admin';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/chat.css">
</head>

<body>
    <div class="chat-container">

        <div class="user-list">
            <h3>Danh sách khách hàng</h3>
            <ul>
                <?php foreach ($users as $user) : ?>
                    <li onclick="fetchMessages(<?php echo $user['id']; ?>)">
                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/users/<?php echo $user['avatar']; ?>" alt="">
                        <span><?php echo $user['name']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="chat-box">
            <div class="message">
                <div class="message-content">
                    <span class="message-text">Xin chào!</span>
                </div>
            </div>
            <div class="input-box">
                <input type="text" id="message" placeholder="Nhập tin nhắn...">
                <button onclick="sendMessage()">Gửi</button>
                <span class="icon-sticker" onclick="showIcons()">😊</span>
                <span class="icon-sticker" onclick="showStickers()">🎨</span>
            </div>
        </div>
    </div>

    <script>
        type = "text/javascript"
        href = "<?php echo _WEB_ROOT; ?> /public/assets/clients/js/users/chat.js "
    </script>

</body>

</html>