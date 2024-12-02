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
    </style>
</head>

<body>
    <div class="menu">
        <div class="profile_pic">
            <?php if (!empty($mhsData['foto'])): ?>
            <img src="<?= base_url($mhsData['foto']) ?>" alt="Foto Profil Mahasiswa">
            <?php else: ?>
            <img src="<?= base_url('Images/default-profile.png') ?>" alt="Foto">
            <?php endif; ?>
        </div>
        <h3><?= strtoupper($mhsData['username'] ?? 'Nama Pengguna') ?></h3>

        <div class="search-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-search search-icon" viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
            <input type="text" class="search-input" placeholder="Cari forum...">
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear gear-icon"
            viewBox="0 0 16 16" onclick="window.location.href='<?= base_url('mahasiswa/edit') ?>'">
            <path
                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
            <path
                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
        </svg>
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
                style="float:right; font-size:16px; color:#fff; background-color:#624DE3; padding:10px 15px; border:none; cursor:pointer; border-radius:5px;">Tambah
                Forum</button>
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
                        <img src="<?= base_url($forum['foto']) ?>" alt="Foto Forum <?= esc($forum['nama_forum']) ?>"
                            width="50" height="50">
                        <?php else: ?>
                        <img src="<?= base_url('Images/default-forum.png') ?>" alt="Foto Forum Default" width="50"
                            height="50">
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?= base_url('forum/delete/' . $forum['kode_forum']) ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus forum ini?')"
                                class="btn btn-danger">Hapus</button>
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
            <form id="addForumForm" action="<?= base_url('forum/create') ?>" method="post"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_forum">Nama Forum</label>
                    <input type="text" id="nama_forum" name="nama_forum" placeholder="Masukkan nama forum" required>
                </div>
                <div class="form-group">
                    <label for="kategori_forum">Kategori Forum</label>
                    <input type="text" id="kategori_forum" name="kategori_forum" placeholder="Masukkan kategori forum"
                        required>
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
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1"
                        placeholder="Masukkan jumlah peserta" required>
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