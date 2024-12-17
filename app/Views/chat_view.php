<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - <?= esc($forum['nama_forum']) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/Forum.css') ?>">
    <style>
        /* Tampilan Kontainer Chat */
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 400px;
            overflow-y: auto;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 8px 12px;
            border-radius: 5px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .message.mahasiswa {
            background-color: #D1C4E9;
            align-self: flex-start;
        }

        .message.klien {
            background-color: #C8E6C9;
            align-self: flex-end;
        }

        /* Input Chat */
        .input-container {
            display: flex;
            margin-top: 20px;
            gap: 10px;
        }

        .input-container textarea {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-container button {
            padding: 10px 15px;
            background-color: #624DE3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .input-container button:hover {
            background-color: #4933b5;
        }
    </style>
</head>

<body>
    <!-- Header Menu -->
    <div class="menu">
        <div class="back-icon" onclick="window.history.back();">
            <img src="<?= base_url('Images/kembali.png') ?>" alt="Back Icon" style="width: 30px; height: 30px;">
        </div>
        <h3><?= strtoupper($mhsData['username'] ?? 'Nama Pengguna') ?></h3>
        <div class="list_forum">
            <h2>Forum Chat: <?= esc($forum['nama_forum']) ?></h2>
        </div>
    </div>

    <!-- Kontainer Chat -->
    <div class="content">
        <div class="chat-container" id="chatContainer">
            <?php foreach ($pesanChat as $pesan): ?>
                <div class="message <?= $pesan['kd_user_klien'] ? 'klien' : 'mahasiswa' ?>">
                    <strong><?= esc($pesan['username_klien'] ?? $pesan['username_mahasiswa']) ?>:</strong>
                    <?= esc($pesan['pesan']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Input Chat -->
        <div class="input-container">
            <textarea id="messageInput" placeholder="Tulis pesan..."></textarea>
            <button id="sendMessageBtn">Kirim</button>
        </div>
    </div>

    <!-- Script WebSocket -->
    <script>
        // Inisialisasi koneksi WebSocket
        const socket = new WebSocket('ws://localhost:8080');

        socket.onopen = () => {
            console.log('Koneksi WebSocket berhasil dibuka.');
        };

        socket.onmessage = (event) => {
            console.log('Pesan diterima:', event.data);
            const chatContainer = document.getElementById('chatContainer');
            const data = JSON.parse(event.data);

            // Tambahkan pesan baru ke chat container
            const newMessage = document.createElement('div');
            newMessage.classList.add('message', data.kd_user_klien ? 'klien' : 'mahasiswa');
            newMessage.innerHTML = `<strong>${escapeHTML(data.username)}:</strong> ${escapeHTML(data.pesan)}`;
            chatContainer.appendChild(newMessage);
            chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll otomatis ke bawah
        };

        socket.onerror = (error) => {
            console.error('Terjadi kesalahan WebSocket:', error);
        };

        socket.onclose = () => {
            console.log('Koneksi WebSocket ditutup.');
        };

        // Fungsi untuk mengirim pesan
        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();

            if (message) {
                const messageData = {
                    username: '<?= esc($mhsData['username'] ?? 'Nama Pengguna') ?>',
                    pesan: message,
                    kd_user_klien: true
                };

                socket.send(JSON.stringify(messageData));
                messageInput.value = '';
            }
        }

        // Event listener tombol kirim
        document.getElementById('sendMessageBtn').addEventListener('click', sendMessage);

        // Event listener untuk enter key
        document.getElementById('messageInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });

        // Fungsi untuk menghindari XSS
        function escapeHTML(string) {
            const div = document.createElement('div');
            div.textContent = string;
            return div.innerHTML;
        }
    </script>
</body>

</html>
