<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHAT</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .chat-container {
      width: 600px;
      height: 90vh;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }

    .chat-header {
      background-color: #075e54;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      border-radius: 10px 10px 0 0;
    }

    .chat-box {
      flex: 1;
      padding: 20px;
      overflow-y: scroll;
      background-color: #e5ddd5;
      display: flex;
      flex-direction: column;
    }

    /* Message Bubble Styling */
    .message {
      max-width: 80%;
      padding: 10px;
      border-radius: 15px;
      margin-bottom: 10px;
      font-size: 14px;
      display: inline-block;
      word-wrap: break-word;
      position: relative;
    }

    .message.sent {
      background-color: #dcf8c6;
      align-self: flex-end;
      /* Posisi pesan pengirim di sebelah kanan */
      margin-left: auto;
    }

    /* Received Messages (Bubble on Left) */
    .message.received {
      background-color: #ffffff;
      border: 1px solid #ddd;
      align-self: flex-start;
      margin-right: auto;
    }

    .message-time {
      font-size: 12px;
      color: #999;
      text-align: right;
      margin-top: 5px;
    }

    .input-container {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      background-color: #ffffff;
      border-top: 1px solid #ddd;
    }

    #message {
      width: 85%;
      padding: 10px;
      border-radius: 20px;
      border: 1px solid #ddd;
      font-size: 14px;
    }

    #send {
      width: 10%;
      background-color: #075e54;
      color: white;
      border: none;
      border-radius: 50%;
      padding: 10px;
      cursor: pointer;
    }

    #send:hover {
      background-color: #128c7e;
    }

    #send:focus {
      outline: none;
    }

    .chat-box::-webkit-scrollbar {
      width: 6px;
    }

    .chat-box::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 3px;
    }

    .chat-box::-webkit-scrollbar-thumb:hover {
      background-color: #555;
    }
  </style>
</head>

<body>
  <div class="chat-container">
    <div class="chat-header">
      Chat
    </div>
    <div class="chat-box" id="chat-box"></div>
    <div class="input-container">
      <input type="text" id="message" placeholder="Tulis pesan..." />
      <button id="send">&#8594;</button>
    </div>
  </div>

  <script src="/js/chat.js"></script>
  <script>
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message');
    const sendButton = document.getElementById('send');

    const socket = new WebSocket('ws://localhost:8081');

    socket.onopen = () => {
      console.log('Connected to WebSocket server');
    };

    socket.onmessage = (event) => {
      const message = JSON.parse(event.data);
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('message', message.type);
      messageDiv.innerHTML = `
        <span>${message.text}</span>
        <div class="message-time">${message.time}</div>
      `;
      chatBox.appendChild(messageDiv);
      chatBox.scrollTop = chatBox.scrollHeight;
    };

    function sendMessage() {
      const messageText = messageInput.value.trim();
      if (messageText !== '') {
        const message = {
          text: messageText,
          type: 'sent',
          time: new Date().toLocaleTimeString().slice(0, 5),
        };
        socket.send(JSON.stringify(message));
        messageInput.value = '';
      }
    }

    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
      }
    });
  </script>
</body>

</html>
