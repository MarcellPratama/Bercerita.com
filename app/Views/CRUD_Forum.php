<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/Forum.css') ?>">
    <title>CRUD Forum Mahasiswa</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px 25px;
            border: none;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            color: #333;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #444;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Arial', sans-serif;
            transition: border 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="date"]:focus,
        .form-group input[type="number"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #624DE3;
            box-shadow: 0 0 5px rgba(98, 77, 227, 0.5);
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #624DE3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #4933b5;
        }

        .form-group input[type="file"] {
            padding: 5px;
            font-size: 14px;
        }

        .back-icon img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="menu">
        <div class="back-icon" onclick="window.history.back();">
            <img src="<?= base_url('Images/kembali.png') ?>" alt="Back Icon">
        </div>
        <div class="profile_pic">
            <?php if (!empty($mhsData['foto'])): ?>
                <img src="<?= base_url($mhsData['foto']) ?>" alt="Foto Profil Mahasiswa">
            <?php else: ?>
                <img src="<?= base_url('Images/default-profile.png') ?>" alt="Foto">
            <?php endif; ?>
        </div>
        <h3><?= strtoupper($mhsData['username'] ?? 'Nama Pengguna') ?></h3>

        <form class="search-container">
            <input type="text" class="search-input" placeholder="Cari forum...">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search search-icon" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </form>

        <div class="separator_A"></div>

        <div class="list_forum">
            <?php foreach ($forums as $forum): ?>
                <div class="profile_forum">
                    <?php if (!empty($forum['foto'])): ?>
                        <img src="<?= base_url($forum['foto']) ?>" alt="Foto Forum <?= esc($forum['nama_forum']) ?>">
                    <?php else: ?>
                        <img src="<?= base_url('Images/default-forum.png') ?>" alt="Foto Forum Default">
                    <?php endif; ?>
                    <h3><?= esc($forum['nama_forum']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="content">
        <h1>Detail Forum
            <button id="openModalBtn"
                style="float:right; font-size:16px; color:#fff; background-color:#333; padding:10px 15px; border:none; cursor:pointer; border-radius:5px;">Tambah Forum
            </button>
        </h1>
        <div class="separator_B"></div>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Jumlah Peserta</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forums as $forum): ?>
                    <tr>
                        <td><?= esc($forum['kode_forum']) ?></td>
                        <td><?= esc($forum['nama_forum']) ?></td>
                        <td><?= esc($forum['kategori_forum']) ?></td>
                        <td><?= esc($forum['deskripsi']) ?></td>
                        <td><?= esc($forum['tanggal']) ?></td>
                        <td><?= esc($forum['jumlah_peserta']) ?></td>
                        <td>
                            <?php if (!empty($forum['foto'])): ?>
                                <img src="<?= base_url($forum['foto']) ?>" alt="Foto Forum <?= esc($forum['nama_forum']) ?>" width="50" height="50">
                            <?php else: ?>
                                <img src="<?= base_url('Images/default-forum.png') ?>" alt="Foto Forum Default" width="50" height="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="<?= base_url('forum/delete/' . $forum['kode_forum']) ?>" method="post">
                                <?= csrf_field() ?>
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus forum ini?')" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Form untuk tambah forum -->
    <div id="myModal" class="modal">
        <div class="modal-content form-container">
            <span class="close">&times;</span>
            <h2>Tambah Forum Baru</h2>
            <form id="addForumForm" action="<?= base_url('forum/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_forum">Nama Forum</label>
                    <input type="text" id="nama_forum" name="nama_forum" placeholder="Masukkan nama forum" required>
                </div>
                <div class="form-group">
                    <label for="kategori_forum">Kategori Forum</label>
                    <select id="kategori_forum" name="kategori_forum" required>
                        <option value="">Pilih</option>
                        <option value="percintaan">Percintaan</option>
                        <option value="keluarga">Keluarga</option>
                        <option value="quarter_life_crisis">Quarter Life Crisis</option>
                        <option value="gangguan_mental">Gangguan Mental</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Forum</label>
                    <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi forum" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_peserta">Jumlah Peserta</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1" placeholder="Masukkan jumlah peserta" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Forum</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required>
                </div>
                <div class="form-group">
                    <button type="submit">Simpan Forum</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("myModal");
            const btn = document.getElementById("openModalBtn");
            const span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => modal.style.display = "none", 300);
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.animation = 'slideOut 0.3s ease-in';
                    setTimeout(() => modal.style.display = "none", 300);
                }
            }
        });

        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus forum ini?")) {
                window.location.href = url;
            }
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const items = document.querySelectorAll('.filter-item');

            items.forEach(item => {
                const title = item.querySelector('h2').textContent.toLowerCase();
                if (title.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        document.getElementById('tanggal').addEventListener('input', function() {
            const today = new Date().toISOString().split('T')[0];
            if (this.value > today) {
                alert('Tanggal tidak boleh di masa depan!');
                this.value = today;
            }
        });
    </script>

    <style>
        @keyframes slideOut {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-20px);
                opacity: 0;
            }
        }
    </style>
</body>

</html>
