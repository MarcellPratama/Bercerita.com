const ws = new WebSocket('ws://localhost:8082');
const chatBox = document.getElementById('chat-box');
const messageInput = document.getElementById('message');
const sendButton = document.getElementById('send');

// Ketika menerima pesan
ws.onmessage = function (event) {
    const message = document.createElement('div');
    message.textContent = event.data;
    chatBox.appendChild(message);
    chatBox.scrollTop = chatBox.scrollHeight;
};

// Kirim pesan ke server
sendButton.onclick = function () {
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
