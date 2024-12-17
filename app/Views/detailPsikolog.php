<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('css/dbpsikolog.css') ?>">
    <title>Psikolog : <?= esc($psikolog['username']) ?></title>
</head>

<body>
    <div id="profile-content">
        <div class="profile-card">
            <div class="profile-container">
                <div class="profile-image">

                    <img id="profile-img" src="<?= base_url($psikolog['foto']) ?>" alt="Profile Image">

                    <div class="edit-overlay" id="edit-overlay">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                </div>
                <input type="file" id="foto" name="foto" style="display: none;" />
            </div>
            <div class="profile-name"><?= esc($psikolog['username']) ?></div>
            <br />
            <i class="bi bi-person-bounding-box" style="font-size: 1.5rem"></i>
            <div class="section-title">Tentang Saya</div>
            <!-- Menggunakan contenteditable untuk memungkinkan perubahan langsung -->
            <div id="tentang-saya-text" contenteditable="false"><?= empty($psikolog['tentang_saya']) ? '-' : esc($psikolog['tentang_saya']) ?></div>
            <br><br>
            <i class="bi bi-chat-heart" style="font-size: 1.5rem"></i>
            <div class="section-title">Pendekatan Klinis</div>
            <div id="pendekatan-klinis-text" contenteditable="false"><?= empty($psikolog['pendekatan_klinis']) ? '-' : esc($psikolog['pendekatan_klinis']) ?></div>
            <br><br>
            <i class="bi bi-geo-alt" style="font-size: 1.5rem"></i>
            <div class="section-title">Domisili</div>
            <div class="section-content"><?= esc($psikolog['domisili']) ?></div>
        </div>
    </div>
</body>

</html>