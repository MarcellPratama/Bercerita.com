<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        #chat-box { width: 100%; height: 400px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; }
        #message { width: 80%; padding: 10px; }
        #send { padding: 10px; }
    </style>
</head>
<body>
    <h1>Realtime Chat dengan WebSocket</h1>
    <div id="chat-box"></div>
    <input type="text" id="message" placeholder="Tulis pesan...">
    <button id="send">Kirim</button>

    <script src="/js/chat.js"></script>
</body>
</html>
