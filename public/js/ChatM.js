const socket = new WebSocket('ws://localhost:8081');

const chatBox = document.getElementById('chat-box');
const messageInput = document.getElementById('message');
const sendButton = document.getElementById('send');

function displayMessages(msg, type) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message', type);

    messageDiv.innerHTML = `
        <span>${msg.text}</span>
        <div class="message-time">${new Date().toLocaleTimeString().slice(0, 5)}</div>
    `;

    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendMessage() {
    const messageText = messageInput.value.trim();
    if (messageText !== '') {
        const message = {
            text: messageText,
            type: 'sent',
            time: new Date().toLocaleTimeString().slice(0, 5)
        };

        socket.send(JSON.stringify({
            kd_klien: 'klien1',
            kd_mahasiswa: 'mhs1', 
            text: messageText
        }));

        displayMessages(message, 'sent');
        messageInput.value = ''; 
    }
}

socket.onmessage = function (event) {
    const receivedMessage = JSON.parse(event.data);
    displayMessages(receivedMessage, 'received');
};

sendButton.addEventListener('click', sendMessage);

messageInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
    }
});
