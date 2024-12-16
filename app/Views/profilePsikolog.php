<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile psikolog</title>
</head>
<body>
<div id="profile-content">
    <div class="profile-card">
        <div class="profile-image">
            <img id="profile-img" src="<?= base_url(($psikolog['foto'])) ?>" alt="Profile Picture">
            <i id="edit-photo-icon" class="bi bi-pencil-square" style="display:none;"></i>
            <input type="file" id="foto" style="display:none" />
        </div>
        <div class="profile-name"><?= esc($psikolog['username']) ?></div><br />
            <i class="bi bi-person-bounding-box" style="font-size: 1.5rem"></i>
        <div class="section-title">Tentang Saya</div>
        <div id="tentang-saya-text" contenteditable="false"><?= empty($psikolog['tentang_saya']) ? '-' : esc($psikolog['tentang_saya']) ?></div><br><br>
        <i class="bi bi-chat-heart" style="font-size: 1.5rem"></i>
              <div class="section-title">Pendekatan Klinis</div>
              <div id="pendekatan-klinis-text" contenteditable="false"><?= empty($psikolog['pendekatan_klinis']) ? '-' : esc($psikolog['pendekatan_klinis']) ?></div>
              <br><br>
              <i class="bi bi-geo-alt" style="font-size: 1.5rem"></i>
              <div class="section-title">Domisili</div>
              <div class="section-content"><?= esc($psikolog['domisili']) ?></div>

              <a href="#" id="edit-profile-btn" class="edit-button">Edit Profile</a>
              <button id="save-profile-btn" class="submit-btn" style="display:none;">Simpan</button> <!-- Tombol simpan untuk menyimpan perubahan -->
          </div>

</body>

</html>