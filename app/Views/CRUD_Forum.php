<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/forum.css') ?>">
    <title>CRUD Forum Mahasiswa</title>
    <style>
        /* Style untuk modal popup */
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
    </style>
</head>

<body>
    <div class="menu">
        <div class="profile_pic">
            <?php if (!empty($mahasiswa['foto'])): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($mahasiswa['foto']) ?>" alt="Foto Profil Mahasiswa">
            <?php else: ?>
                <img src="<?= base_url('Images/default-profile.png') ?>" alt="Foto Profil Default">
            <?php endif; ?>
        </div>
        <h3><?= strtoupper($mahasiswa['username'] ?? 'Nama Pengguna') ?></h3>

        <div class="search-container">
            <img src="<?= base_url('icon/Cari.png') ?>" alt="Cari" class="search-icon">
            <input type="text" class="search-input" placeholder="Cari forum...">
        </div>

        <img src="<?= base_url('icon/Gear.png') ?>" alt="Gear" class="gear-icon" onclick="window.location.href='<?= base_url('mahasiswa/edit') ?>'">
        <div class="separator_A"></div>

        <div class="list_forum">
            <?php foreach ($forums as $forum): ?>
                <div class="profile_forum">
                    <?php if (!empty($forum['foto'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($forum['foto']) ?>" alt="Foto Forum <?= esc($forum['nama_forum']) ?>">
                    <?php else: ?>
                        <img src="<?= base_url('Images/default-forum.png') ?>" alt="Foto Forum Default">
                    <?php endif; ?>
                    <h3><?= esc($forum['nama_forum']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="content">
        <h1>Detail Anggota
        <button id="openModalBtn" style="float:right; font-size:16px; color:#fff; background-color:#624DE3; padding:10px 15px; border:none; cursor:pointer; border-radius:5px;">Tambah Forum</button>
        </h1>
        <div class="separator_B"></div>

        <table>
            <?php foreach ($forums as $forum): ?>
                <tr>
                    <td><?= esc($forum['kode_forum']) ?></td>
                    <td><?= esc($forum['nama_forum']) ?></td>
                    <td><?= esc($forum['kategori_forum']) ?></td>
                    <td><?= esc($forum['tanggal']) ?></td>
                    <td><?= esc($forum['jumlah_peserta']) ?></td>
                    <td>
                        <?php if (!empty($forum['foto'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($forum['foto']) ?>" width="50" height="50">
                        <?php else: ?>
                            <img src="<?= base_url('Images/default-forum.png') ?>" width="50" height="50">
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?= base_url('forum/delete/' . $forum['kode_forum']) ?>" method="POST">
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal untuk formulir tambah forum -->
    <div id="myModal" class="modal">
        <div class="modal-content form-container">
            <span class="close">&times;</span>
            <h2>Tambah Forum Baru</h2>
            <form id="addForumForm" action="<?= base_url('forum/add') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_forum">Nama Forum</label>
                    <input type="text" id="nama_forum" name="nama_forum" placeholder="Masukkan nama forum" required>
                </div>
                <div class="form-group">
                    <label for="kategori_forum">Kategori Forum</label>
                    <input type="text" id="kategori_forum" name="kategori_forum" placeholder="Masukkan kategori forum" required>
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
        // JavaScript untuk mengatur modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("myModal");
            const btn = document.getElementById("openModalBtn");
            const span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
