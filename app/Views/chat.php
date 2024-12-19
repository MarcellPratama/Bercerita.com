<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #chat-box {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            padding: 10px;
        }

        #message {
            width: 80%;
            padding: 10px;
        }

        #send {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Realtime Chat dengan WebSocket</h1>
    <div id="chat-box"></div>
    <input type="text" id="message" placeholder="Tulis pesan...">
    <button id="send">Kirim</button>

    <script>
        const ws = new WebSocket('ws://localhost:8082');
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message');
        const sendButton = document.getElementById('send');

        // Ketika menerima pesan
        ws.onmessage = function(event) {
            const message = document.createElement('div');
            message.textContent = event.data;
            chatBox.appendChild(message);
            chatBox.scrollTop = chatBox.scrollHeight;
        };

        // Kirim pesan ke server
        sendButton.onclick = function() {
            const message = messageInput.value;
            if (message.trim()) {
                ws.send(message);
                const selfMessage = document.createElement('div');
                selfMessage.textContent = "Anda: " + message;
                chatBox.appendChild(selfMessage);
                messageInput.value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };
    </script>
</body>

</html>