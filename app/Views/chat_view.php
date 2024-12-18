<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #chatbox {
            width: 100%;
            height: 300px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            padding: 10px;
        }

        #message {
            width: 80%;
        }

        #send {
            width: 18%;
        }
    </style>
</head>

<body>
    <h1>Realtime Chat</h1>
    <div id="chatbox"></div>
    <input type="text" id="message" placeholder="Type your message..." />
    <button id="send">Send</button>

    <script>
        const conn = new WebSocket('ws://localhost:8081/chat');

        conn.onopen = function() {
            console.log("Connection established.");
            // Kode untuk mengirim pesan setelah koneksi terbuka
            conn.send(message);
        };

        conn.onmessage = function(e) {
            const msg = document.createElement('div');
            msg.textContent = e.data;
            chatbox.appendChild(msg);
        };

        conn.onerror = function(error) {
            console.error("WebSocket error:", error);
        };

        conn.onclose = function() {
            console.log("Connection closed.");
        };
    </script>
</body>

</html>