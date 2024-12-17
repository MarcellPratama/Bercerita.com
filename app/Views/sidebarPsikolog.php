<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/dbpsikolog.css" />
    <title>Profile Page</title>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <img src="/images/Logo_Bercerita.com2.png" alt="Logo" />
                </div>
                <i class="bi bi-list" id="btn"></i>
            </div>
            <ul>
                <li><a href="profile." id="profile-btn"><i class="bi bi-person-circle"></i> Profil</a></li>
                <li><a href="jadwal.html" id="jadwal-btn"><i class="bi bi-calendar2-heart"></i> Jadwal Konsultasi</a></li>
                <li><a href="layanan.html" id="layanan-btn"><i class="bi bi-house-heart"></i> Layanan</a></li>
                <li><a href="/logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Profile Content -->
        <div class="content">
            <div id="profile-content">
                <div class="profile-card">
                    <div class="profile-image">
                        <img id="profile-img" src="<?= base_url(($psikolog['foto'])) ?>" alt="Profile Picture">
                        <i id="edit-photo-icon" class="bi bi-pencil-square" style="display:none;"></i>
                        <input type="file" id="foto" style="display:none" />
                    </div>
                    <div class="profile-name"><?= esc($psikolog['username']) ?></div>
                    <br />
                    <div class="section-title">Tentang Saya</div>
                    <div id="tentang-saya-text" contenteditable="false"><?= empty($psikolog['tentang_saya']) ? '-' : esc($psikolog['tentang_saya']) ?></div>
                    <br><br>
                    <div class="section-title">Pendekatan Klinis</div>
                    <div id="pendekatan-klinis-text" contenteditable="false"><?= empty($psikolog['pendekatan_klinis']) ? '-' : esc($psikolog['pendekatan_klinis']) ?></div>
                    <br><br>
                    <div class="section-title">Domisili</div>
                    <div class="section-content"><?= esc($psikolog['domisili']) ?></div>

                    <a href="#" id="edit-profile-btn" class="edit-button">Edit Profile</a>
                    <button id="save-profile-btn" class="submit-btn" style="display:none;">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/dbpsikolog.js"></script>
</body>
</html>
