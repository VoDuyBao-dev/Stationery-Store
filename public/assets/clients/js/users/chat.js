function sendMessage() {
    let message = document.getElementById('message').value;
    fetch("send.php", {
        method: "POST",
        body: JSON.stringify({
            message
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(() => {
        document.getElementById('message').value = "";
        loadMessages();
    });
}

function loadMessages() {
    fetch("load.php").then(res => res.json()).then(data => {
        let messagesDiv = document.getElementById("messages");
        messagesDiv.innerHTML = "";
        data.forEach(msg => {
            let div = document.createElement("div");
            div.innerText = msg.message;
            messagesDiv.appendChild(div);
        });
    });
}

function showIcons() {
    alert("Chọn icon (chức năng sẽ làm sau)");
}

function showStickers() {
    alert("Chọn sticker (chức năng sẽ làm sau)");
}

loadMessages();