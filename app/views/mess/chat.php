<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css"
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/users/chat.css">

</head>

<body>
    <div class="container">
        <?php if ($role == "admin") { ?>
            <div class="list_user">
                <h2>Chats</h2>
                <ul>
                    <?php foreach ($chatList as $user) : ?>
                        <li>
                            <a href="/chat/detail/<?php echo $user['id']; ?>">
                                <div><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/sticker/<?php echo $user['id'] ?>.png" />

                                    <?php echo htmlspecialchars($user['id']) . htmlspecialchars($user['fullname']); ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>
        <?php if ($role == "admin" || $role == "user") { ?>
            <div class="context">
                <div class="message">
                    <?php foreach ($messages as $msg) : ?>
                        <?php if ($msg['sender_id'] == $_SESSION['user_id']) : ?>
                            <div class="message_right">
                                <div class="avatar"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'admin-avatar.jpg' : 'user-avatar.jpg'; ?>" alt=""></div>
                                <div class="content">
                                    <div class="name"><?php echo ($role == 'admin') ? 'Admin' : 'Bạn'; ?></div>
                                    <div class="text"><?php echo htmlspecialchars($msg['message']); ?></div>
                                    <div class="time"><?php echo $msg['formatted_time']; ?></div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="message_left">
                                <div class="avatar"><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/<?php echo ($role == 'admin') ? 'user-avatar.jpg' : 'admin-avatar.jpg'; ?>" alt=""></div>
                                <div class="content">
                                    <div class="name"><?php echo ($role == 'admin') ? 'User ' . htmlspecialchars($msg['sender_id']) : 'Admin'; ?></div>
                                    <div class="text"><?php echo htmlspecialchars($msg['message']); ?></div>
                                    <div class="time"><?php echo $msg['formatted_time']; ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <form action="/chat/sendMessage" method="POST">
                    <div class="input">
                        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                        <input type="text" name="message" placeholder="Nhập tin nhắn..." required>
                        <button type="submit">Gửi</button>
                    </div>
                </form>
            </div>

            <div class="information">
                <h2>Details</h2>
                <div class="avatar">
                    <img src="" alt="">
                </div>
                <div class="name">Nguyen Van A</div>
                <div class="email">email</div>
                <div class="phone">sdt</div>
                <div class="stk">stk</div>
            </div>
        <?php } ?>
    </div>


</body>

</html>