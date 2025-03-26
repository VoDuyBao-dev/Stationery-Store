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
        <div class="list_user">
            <h2>Chats</h2>
            <ul>
                <li>
                    <div id="user_name"></div>
                    <div><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/1.jpg" /> user 1</div>
                </li>

                <li>
                    <div id=" user_name"></div>
                    <div><img src="" /></div>user 2
                </li>
                <li>
                    <div id="user_name"></div>
                    <div><img src="" /></div>user 3
                </li>
                <li>
                    <div id="user_name"></div>
                    <div><img src="" /></div>user 4
                </li>
                <li>
                    <div id="user_name"></div>
                    <div><img src="" /></div>user 5
                </li>
            </ul>
        </div>
        <div class="context">
            <div class="message">
                <div class="message_right">
                    <div class="avatar"><img src="" alt=""></div>
                    <div class="content">
                        <div class="name">Nguyen Van A</div>
                        <div class="text">Hello</div>
                    </div>
                </div>
                <div class="message_left">
                    <div class="avatar">
                        <img src="" alt="">
                    </div>
                    <div class="content">
                        <div class="name">Nguyen Van B</div>
                        <div class="text">Hi</div>
                    </div>
                </div>
                <div class="message_right">
                    <div class="avatar">
                        <img src="" alt="">
                    </div>
                    <div class="content">
                        <div class="name">Nguyen Van A</div>
                        <div class="text">How are you?</div>
                    </div>
                </div>
                <div class="message_left">
                    <div class="avatar">
                        <img src="" alt="">
                    </div>
                    <div class="content">
                        <div class="name">Nguyen Van B</div>
                        <div class="text">I'm fine</div>
                    </div>
                </div>
            </div>
            <form action="/chat/sendMessage" method="POST">

                <div class="input">
                    <input type="hidden" name="receiver_id" value="2">
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

    </div>


</body>

</html>