<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bercerita Dashboard - Verifikasi Pengguna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <style>
    * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        margin: 0;
        display: flex;
        background-color: #f5f5f5;
    }

    .sidebar {
        width: 245px;
        height: 100vh;
        background: linear-gradient(to bottom, #77E4C8, #36C2CE, #478CCF);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: white;
        border-radius: 0 10px 10px 0;
    }

    .user-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
        margin-left: 35px;
    }

    .user-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .menu {
        list-style: none;
        /* Remove bullet points */
        padding: 0;
        /* Remove default padding */
        margin: 0;
        /* Remove default margin */
    }

    .menu a {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        color: white;
        font-size: 18px;
        font-weight: 500;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .menu a:hover {
        background-color: #03b5c1;
    }

    .menu a.active {
        background-color: #088395;
    }

    .main-content {
        flex: 1;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h2 {
        font-size: 24px;
        color: #333;
    }

    .header .bold-text {
        font-weight: 700;
    }

    .header .regular-text {
        font-weight: 400;
    }

    .logo {
        height: 50px;
    }

    .sidebar ul {
        list-style: none;
        width: 100%;
        color: white;
    }

    .sidebar ul li {
        position: relative;
        margin: 15px 0;
        color: white;
    }

    .sidebar ul li a {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        text-decoration: none;
        color: #b0bec5;
        transition: 0.3s;
        border-radius: 5px;
        font-size: 18px;
        color: white;
    }

    .sidebar ul li a:hover {
        color: #fff;
    }

    .sidebar ul li a i {
        margin-right: 15px;
        font-size: 18px;
        color: white;
    }

    .sidebar ul li a.active {
        /* background-color: #37474f; */
        color: #fff;
    }

    /* Submenu */
    .submenu {
        display: none;
        padding-left: 20px;
        background-color: rgba(0, 194, 203, 0.1);
        border-radius: 5px;
    }

    .submenu li a {
        padding: 10px 15px;
        font-size: 14px;
        color: #b0bec5;
        text-decoration: none;
    }

    .submenu li a:hover {
        color: #fff;
    }

    /* Panah untuk indikator submenu */
    .toggle-submenu {
        margin-left: auto;
        font-size: 14px;
        cursor: pointer;
    }

    .detail-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 1500px;
        background-color: #e9ecef;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: 560px;
    }

    .detail-row {
        display: flex;
        flex-direction: column;
        padding: 8px;
        background-color: #e9ecef;
        border-radius: 5px;
        margin-bottom: 1px;
    }

    .detail-label {
        font-weight: bold;
        color: #333;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .detail-value {
        background-color: #d1d3d4;
        padding: 8px;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    a.detail-link {
        color: #800080;
        text-decoration: none;
        margin-right: 10px;
    }

    a.detail-link:hover {
        text-decoration: underline;
    }

    .back-btn-modal {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        margin-top: 20px;
        /* Menambahkan jarak lebih besar di atas tombol */
        width: 100%;
    }

    .back-btn-modal:hover {
        background-color: #e74c3c;
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-profile">
            <img src="/profil.jpeg" alt="User Image" class="user-img" />
            <h5>Patrisia Cindy</h5>
        </div>

        <ul class="menu">
            <li><a href="<?= base_url('adminDashboard'); ?>"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="<?= base_url('adminVerifikasi'); ?>" class="active"><i class="fas fa-check-circle"></i>
                    Verifikasi</a></li>
            <li>
                <a href="#" class="dropdown-toggle" onclick="toggleSubmenu(this)">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <ul class="submenu">
                    <li><a href="<?= base_url('adminLihatPsikolog'); ?>"><i class="fas fa-user"></i> Psikolog</a></li>
                    <li><a href="<?= base_url('adminLihatMhs'); ?>"><i class="fas fa-user-graduate"></i> Mahasiswa
                            Psikologi</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('kelolaMading'); ?>"><i class="fas fa-file-alt"></i>
                    Kelola Mading</a></li>
            <li><a href="<?= base_url('login'); ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2><span class="bold-text">Tampilan</span> <span class="regular-text">Mahasiswa Psikologi |
                    <?= htmlspecialchars($mahasiswa['username']); ?></span></h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>
        <div class="detail-container">
            <div class="detail-row">
                <span class="detail-label">Nama Pengguna</span>
                <span class="detail-value"><?= $mahasiswa['username']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value"><?= $mahasiswa['email']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NIM</span>
                <span class="detail-value"><?= $mahasiswa['nim']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Asal Universitas</span>
                <span class="detail-value"><?= $mahasiswa['asal_univ']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Foto Diri</span>
                <a href="#" onclick="showImageModal('<?= $mahasiswa['foto']; ?>')" class="detail-link">Lihat Foto</a>
            </div>
            <div class="detail-row">
                <span class="detail-label">Foto KTM</span>
                <a href="#" onclick="showImageModal('<?= $mahasiswa['fotoKTM']; ?>')" class="detail-link">Lihat Foto</a>
            </div>
            <!-- <a href="/adminVerifikasi" class="back-btn">Kembali</a> -->
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <!-- Gambar -->
                    <img id="modalImage" src="#" alt="Image Preview" class="img-fluid rounded mb-3">

                    <!-- Tombol Kembali di bawah gambar -->
                    <div class="d-flex justify-content-center">
                        <a href="/adminLihatDetailMhsPsikologi/<?= htmlspecialchars($registrasi['kd_registrasi']); ?>"
                            class="btn btn-danger mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

function showImageModal(imageUrl) {
    // Set the image source
    document.getElementById('modalImage').src = imageUrl;

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}
</script>

</html>