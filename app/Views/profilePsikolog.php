<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/dbpsikolog.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Profil Psikolog</title>
</head>

<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="top">

                <i class="bi bi-list" id="btn"></i>
            </div>
            <br> <br>
            <div class="user">
                <?php
                $imageSrc = !empty($psikolog['foto']) && strpos($psikolog['foto'], 'uploads/FOTO/') !== false
                    ? base_url($psikolog['foto'])
                    : base_url('uploads/FOTO/' . ($psikolog['foto'] ?? 'default.jpg'));
                ?>
                <img id="profile-img-sidebar" src="<?= $imageSrc ?>" alt="Profile Image">
                <div class="halo">
                    <p class="bold">Halo</p>
                    <p><?= esc($psikolog['username']) ?></p>
                </div>
            </div>
            <ul>
                <li>
                    <a href="#" id="profile-btn">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem"></i>
                        <span class="nav-item">Profil</span>
                    </a>
                    <span class="tooltip">Profil</span>
                </li>
                <li>
                    <a href="#" id="jadwal-btn">
                        <i class="bi bi-calendar2-heart" style="font-size: 1.5rem"></i>
                        <span class="nav-item">Jadwal Konsultasi</span>
                    </a>
                    <span class="tooltip">Jadwal Konsultasi</span>
                    <div class="submenu" id="submenu">
                        <a href="#" id="konsultasi-online">Konsultasi Online</a>
                        <a href="#" id="konsultasi-offline">Konsultasi Tatap Muka</a>
                    </div>
                </li>
                <li>
                    <a href="#" id="layanan-btn">
                        <i class="bi bi-house-heart" style="font-size: 1.5rem"></i>
                        <span class="nav-item">Layanan</span>
                    </a>
                    <span class="tooltip">Layanan</span>
                </li>
                <li>
                    <a href="/logout" class="nav-link">
                        <i class="bi bi-box-arrow-in-left" style="font-size: 1.5rem"></i>
                        <span class="nav-item">Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </ul>
        </div>
    </div>


    <form id="profile-form" method="post" enctype="multipart/form-data"
        action="<?= base_url('/psikolog/updateProfilePhoto') ?>">
        <div class="content">
            <div id="profile-content">
                <div class="profile-card">
                    <div class="profile-container">
                        <div class="profile-image">

                            <img id="profile-img" src="<?= $imageSrc ?>" alt="Profile Image">

                            <div class="edit-overlay" id="edit-overlay">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input type="file" id="foto" name="foto" style="display: none;" />
                    </div>

                    <div class="profile-name"> <?= esc($psikolog['username']) ?></div>
                    <br>
                    <i class="bi bi-person-bounding-box" style="font-size: 1.5rem"></i>
                    <div class="section-title">Tentang Saya</div>
                    <textarea id="tentang-saya-text" name="tentang_saya" style="display:none;"
                        rows="1"><?= empty($psikolog['tentang_saya']) ? '' : esc($psikolog['tentang_saya']) ?></textarea>
                    <div id="tentang-saya-text-view" contenteditable="false">
                        <?= empty($psikolog['tentang_saya']) ? '-' : esc($psikolog['tentang_saya']) ?></div>

                    <br><br>
                    <i class="bi bi-chat-heart" style="font-size: 1.5rem"></i>
                    <div class="section-title">Pendekatan Klinis</div>
                    <textarea id="pendekatan-klinis-text" name="pendekatan_klinis" style="display:none;"
                        rows="1"><?= empty($psikolog['pendekatan_klinis']) ? '' : esc($psikolog['pendekatan_klinis']) ?></textarea>
                    <div id="pendekatan-klinis-text-view" contenteditable="false">
                        <?= empty($psikolog['pendekatan_klinis']) ? '-' : esc($psikolog['pendekatan_klinis']) ?>
                    </div>
                    <br><br>
                    <i class="bi bi-geo-alt" style="font-size: 1.5rem"></i>
                    <div class="section-title">Domisili</div>
                    <div class="section-content"> <?= esc($psikolog['domisili']) ?> </div>

                    <a href="#" id="edit-profile-btn" class="edit-button">Edit Profile</a>
                    <button id="save-profile-btn" class="submit-btn" style="display:none;">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
const editProfileBtn = document.getElementById("edit-profile-btn");
const saveProfileBtn = document.getElementById("save-profile-btn");
const tentangSayaText = document.getElementById("tentang-saya-text");
const pendekatanKlinisText = document.getElementById("pendekatan-klinis-text");
const fotoInput = document.getElementById("foto");
const profileImg = document.getElementById("profile-img");
const tentangSayaTextView = document.getElementById("tentang-saya-text-view");
const pendekatanKlinisTextView = document.getElementById("pendekatan-klinis-text-view");
const btn = document.querySelector("#btn");
const sidebar = document.querySelector(".sidebar");
const editOverlay = document.getElementById("edit-overlay");
const profileImgSidebar = document.getElementById("profile-img-sidebar");


// Fungsi untuk masuk ke mode edit
function enableEditMode() {
    // Menampilkan textarea untuk edit
    tentangSayaText.style.display = "block";
    pendekatanKlinisText.style.display = "block";
    tentangSayaTextView.style.display = "none";
    pendekatanKlinisTextView.style.display = "none";

    // Menampilkan tombol simpan dan input foto
    saveProfileBtn.style.display = "inline-block";
    editProfileBtn.style.display = "none"; // Sembunyikan tombol "Edit Profil"
    fotoInput.style.display = "inline-block";

    // Tambahkan border agar terlihat lebih jelas
    tentangSayaText.style.border = "1px solid #ccc";
    pendekatanKlinisText.style.border = "1px solid #ccc";
}

// Fungsi untuk menyimpan perubahan
function disableEditMode() {
    // Mengembalikan tampilan ke mode tampilan
    tentangSayaText.style.display = "none";
    pendekatanKlinisText.style.display = "none";
    tentangSayaTextView.style.display = "block";
    pendekatanKlinisTextView.style.display = "block";

    // Update konten tampilan dengan isi dari textarea
    tentangSayaTextView.innerText = tentangSayaText.value;
    pendekatanKlinisTextView.innerText = pendekatanKlinisText.value;

    // Sembunyikan tombol simpan dan input foto
    saveProfileBtn.style.display = "none";
    editProfileBtn.style.display = "inline-block"; // Tampilkan kembali tombol "Edit Profil"
    fotoInput.style.display = "none";
}

// Event listener untuk tombol "Edit Profil"
editProfileBtn.addEventListener("click", function(e) {
    e.preventDefault();
    enableEditMode(); // Masuk ke mode edit
});

saveProfileBtn.addEventListener("click", function(e) {
    e.preventDefault();

    // Validasi format file foto (opsional)
    if (fotoInput.files.length > 0) {
        const file = fotoInput.files[0];
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert("Format foto tidak valid! Hanya JPG dan PNG yang diizinkan.");
            return;
        }
    }

    // Periksa jika field 'Tentang Saya' sudah dihapus (kosong)
    if (tentangSayaText.value.trim() === "") {
        tentangSayaTextView.innerText = "-"; // Tampilkan placeholder "-"
        tentangSayaText.value = ""; // Simpan nilai kosong di textarea
    } else {
        tentangSayaTextView.innerText = tentangSayaText.value; // Update dengan isian
    }

    // Periksa jika field 'Pendekatan Klinis' sudah dihapus (kosong)
    if (pendekatanKlinisText.value.trim() === "") {
        pendekatanKlinisTextView.innerText = "-"; // Tampilkan placeholder "-"
        pendekatanKlinisText.value = ""; // Simpan nilai kosong di textarea
    } else {
        pendekatanKlinisTextView.innerText = pendekatanKlinisText.value; // Update dengan isian
    }

    // Kirim form untuk menyimpan perubahan
    document.getElementById("profile-form").submit();
});



btn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
});


editOverlay.addEventListener("click", function() {
    fotoInput.click();
});


fotoInput.addEventListener("change", function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update gambar di sidebar dan tampilan utama secara real-time
            profileImg.src = e.target.result;
            profileImgSidebar.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

</html>