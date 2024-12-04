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
        height: 112vh;
        background: linear-gradient(to bottom, #77E4C8, #36C2CE, #478CCF);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: white;
        border-radius: 0 10px 10px 0;
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

    .user-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }

    .user-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
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
        padding: 0;
        margin: 0;
    }


    .menu a:hover {
        background-color: #03b5c1;
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

    .container-table {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 7px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 5px;
        height: 640px;
    }


    table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px auto;
    }

    th,
    td {
        padding: 5px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background-color: #f0f0f0;
        color: #333;
        font-weight: 500;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    .btn-action {
        background-color: #ff4b5c;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .action-btn {
        font-size: 14px;
        color: #fff;
        padding: 6px 10px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
    }

    .action-btn.trash {
        background-color: #4caf50;
    }


    .pagination-container {
        margin-top: 20px;
        text-align: center;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination {
        position: absolute;
        align-items: right;
        gap: 3px;
        top: 670px;
        left: 1050px;
    }

    .pagination .page-item {
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        padding: 3px 4px;
        /* Kurangi padding untuk ukuran kotak lebih kecil */
    }

    .pagination .page-item a {
        text-decoration: none;
        color: inherit;
        display: inline-block;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .pagination .page-item.active .page-link {
        background-color: #ff0000;
        color: #fff;
        border: none;
    }

    .pagination .page-item:not(.active) {
        /* background-color: #e0e0e0; */
        color: #333;
        border-radius: 4px;
    }

    .pagination .page-item:not(.active):hover {
        background-color: #ffffff;
    }

    .search-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        position: relative;
        margin-left: auto;
        /* Memastikan posisi di kanan */
        width: 100%;
        max-width: 250px;
    }

    .search-container .search-icon {
        position: absolute;
        left: 10px;
        font-size: 14px;
        color: #888;
    }

    .search-container input[type="text"] {
        width: 100%;
        max-width: 300px;
        padding: 6px 6px 6px 30px;
        /* Tambahkan padding kiri untuk ikon */
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .search-container input[type="text"]:focus {
        outline: none;
        border-color: #00c2cb;
        box-shadow: 0 0 4px rgba(0, 194, 203, 0.3);
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

    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.3);
        padding: 20px;
        border-radius: 10px;
        z-index: 1000;
        width: 1700px;
        text-align: center;
    }

    .modal-content-trash {
        margin-top: 220px;
        flex-direction: column;
        align-items: center;
        background-color: white;
        margin-left: 585px;
        margin-right: 600px;
        width: 500px;
        height: 220px;
        border-radius: 5px;
    }

    .modal-content-trash i {
        font-size: 40px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .modal-content-trash p {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        margin-top: 10px;
    }

    .modal-content-trash .btn {
        padding: 10px 20px;
        /* Jarak dalam tombol */
        font-size: 16px;
        /* Ukuran teks */
        border-radius: 5px;
        /* Membuat sudut tombol melengkung */
        width: 100px;
        /* Lebar tombol yang sama */
        text-align: center;
        /* Pusatkan teks di tombol */
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
            <li><a href="adminDashboard"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="adminVerifikasi"><i class="fas fa-check-circle"></i> Verifikasi</a></li>

            <li>
                <a href="#" class="dropdown-toggle" onclick="toggleSubmenu(this)">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <ul class="submenu">
                    <li><a href="adminLihatPsikolog"><i class="fas fa-user"></i> Psikolog</a></li>
                    <li><a href="adminLihatMhs"><i class="fas fa-user-graduate"></i> Mahasiswa Psikologi</a></li>
                </ul>
            </li>
            <li><a href="kelolaMading" class="active"><i class="fas fa-file-alt"></i> Kelola Mading</a></li>
            <li><a href="/login"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2><span class="bold-text"></span> <span class="regular-text"></span></h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>

        <div class="container-table">
            <div class="search-container mb-3">
                <form method="get" action="kelolaMading" style="width: 100%; display: flex; align-items: center;">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari"
                        value="<?= isset($search) ? esc($search) : '' ?>" style="padding-left: 30px;" />
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Kode Catatan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Isi Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($catatan as $catatanItem): ?>
                    <tr>
                        <td><?= esc($catatanItem['kode_catatan']); ?></td>
                        <td><?= esc($catatanItem['tanggal_dibuat']); ?></td>
                        <td><?= esc($catatanItem['isi_catatan']); ?></td>
                        <td>
                            <span class="action-btn trash" title="Sampah"
                                data-id="<?= $catatanItem['kode_catatan']; ?>">
                                <i class="fas fa-trash"></i>
                            </span>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <ul class="pagination">
                    <!-- Tombol Sebelumnya -->
                    <li class="page-item <?= $pagination['currentPage'] == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link"
                            href="<?= $pagination['currentPage'] > 1 ? '?page=' . ($pagination['currentPage'] - 1) : '#'; ?>">&#x2039;</a>
                    </li>

                    <!-- Nomor Halaman -->
                    <?php
        // Tentukan rentang halaman yang ditampilkan (maksimal 4 nomor halaman)
        $maxVisiblePages = 4; // Maksimal 4 halaman
        $startPage = max(1, $pagination['currentPage'] - floor($maxVisiblePages / 2));
        $endPage = min($pagination['totalPages'], $startPage + $maxVisiblePages - 1);

        // Pastikan range halaman tetap 4 jika memungkinkan
        if ($endPage - $startPage + 1 < $maxVisiblePages) {
            $startPage = max(1, $endPage - $maxVisiblePages + 1);
        }
        ?>

                    <!-- Loop untuk menampilkan nomor halaman dengan rentang -->
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?= $i == $pagination['currentPage'] ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <!-- Tombol Berikutnya -->
                    <li
                        class="page-item <?= $pagination['currentPage'] == $pagination['totalPages'] ? 'disabled' : ''; ?>">
                        <a class="page-link"
                            href="<?= $pagination['currentPage'] < $pagination['totalPages'] ? '?page=' . ($pagination['currentPage'] + 1) : '#'; ?>">&#x203A;</a>
                    </li>
                </ul>
            </div>

            <div class="modal" id="modalSampah" style="display: none;">
                <div class="modal-content-trash">
                    <i class="fas fa-trash-circle" style="color: #ff6b6b; font-size: 40px;"></i>
                    <p>Apakah Anda yakin ingin menghapus?</p>
                    <button class="btn btn-secondary" id="btnBatal">Batal</button>
                    <button class="btn btn-danger" id="btnKonfirmasiTolak">Ya</button>
                </div>
            </div>


        </div>
    </div>
</body>
<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";

    // Toggle the arrow for submenu indicator
    const arrow = element.querySelector('.toggle-submenu');
    arrow.innerHTML = submenu.style.display === "block" ? "&#9652;" : "&#9662;";
}

document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".action-btn.trash");
    const modalSampah = document.getElementById("modalSampah"); // Modal yang akan ditampilkan
    const btnBatal = document.getElementById("btnBatal"); // Tombol batal
    const btnKonfirmasiTolak = document.getElementById("btnKonfirmasiTolak"); // Tombol konfirmasi hapus
    let selectedId = null; // Variabel untuk menyimpan ID yang akan dihapus

    // Event Listener untuk tombol "Sampah"
    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            selectedId = this.getAttribute("data-id"); // Ambil ID dari atribut data-id
            modalSampah.style.display = "flex"; // Tampilkan modal
        });
    });

    // Event Listener untuk tombol "Batal"
    btnBatal.addEventListener("click", function() {
        modalSampah.style.display = "none"; // Sembunyikan modal
    });

    // Event Listener untuk tombol "Ya" (Hapus)
    btnKonfirmasiTolak.addEventListener("click", function() {
        if (selectedId) {
            // Lakukan permintaan penghapusan ke server
            fetch(`/mading/deleteMading/${selectedId}`, {
                    method: "DELETE"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert("Data berhasil dihapus.");
                        location.reload(); // Muat ulang halaman
                    } else {
                        alert("Gagal menghapus data: " + data.message);
                    }
                })
                .catch(error => {
                    alert("Terjadi kesalahan: " + error.message);
                });

        }
        modalSampah.style.display = "none"; // Sembunyikan modal setelah konfirmasi
    });

    // Klik di luar modal untuk menutup modal
    window.addEventListener("click", function(event) {
        if (event.target === modalSampah) {
            modalSampah.style.display = "none"; // Sembunyikan modal jika klik di luar modal
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    let currentPage = 1;
    const rows = document.querySelectorAll("table tbody tr");
    const rowsPerPage = 10;
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage); // Total halaman

    // Fungsi untuk menampilkan halaman tertentu
    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = ''; // Tampilkan baris sesuai halaman
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai halaman
            }
        });
    }

    // Fungsi untuk merender pagination
    function renderPagination() {
        const paginationContainer = document.querySelector(".pagination ul");
        paginationContainer.innerHTML = ''; // Kosongkan pagination sebelumnya

        // Tombol Previous
        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#">&#x2039;</a>
            </li>`;

        // Tentukan rentang halaman yang akan ditampilkan (maksimal 4 halaman per waktu)
        const maxVisiblePages = 4; // Maksimal 4 halaman per waktu
        let startPage = Math.floor((currentPage - 1) / maxVisiblePages) * maxVisiblePages + 1;
        let endPage = Math.min(startPage + maxVisiblePages - 1, totalPages);

        // Nomor Halaman
        for (let i = startPage; i <= endPage; i++) {
            const isActive = i === currentPage ? 'active' : '';
            paginationContainer.innerHTML += `
                <li class="page-item ${isActive}">
                    <a class="page-link" href="#">${i}</a>
                </li>`;
        }

        // Tombol Next
        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#">&#x203A;</a>
            </li>`;

        attachPaginationEvents(); // Tambahkan event listener ke tombol
    }

    // Fungsi untuk menambahkan event listener pada pagination
    function attachPaginationEvents() {
        const pageItems = document.querySelectorAll(".pagination .page-item");
        const prevButton = pageItems[0];
        const nextButton = pageItems[pageItems.length - 1];

        // Tombol Previous
        prevButton.addEventListener("click", function() {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                renderPagination();
            }
        });

        // Tombol Next
        nextButton.addEventListener("click", function() {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
                renderPagination();
            }
        });

        // Klik pada nomor halaman
        pageItems.forEach((item, index) => {
            if (index > 0 && index < pageItems.length - 1) { // Abaikan tombol Previous dan Next
                item.addEventListener("click", function() {
                    const pageNum = parseInt(item.textContent);
                    if (!isNaN(pageNum)) {
                        currentPage = pageNum;
                        showPage(currentPage);
                        renderPagination();
                    }
                });
            }
        });
    }

    // Inisialisasi tampilan halaman pertama dan pagination
    showPage(currentPage);
    renderPagination();
});

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput"); // Input pencarian
    const tableBody = document.getElementById("tableBody"); // Tabel tempat data ditampilkan
    const originalRows = Array.from(tableBody.rows); // Salin data asli untuk filter

    // Fungsi untuk melakukan pencarian
    function performSearch() {
        const searchQuery = searchInput.value.trim()
            .toLowerCase(); // Ambil input pencarian dan ubah ke lowercase

        // Jika input kosong, kembalikan semua data
        if (!searchQuery) {
            tableBody.innerHTML = ""; // Kosongkan tabel
            originalRows.forEach((row) => tableBody.appendChild(row)); // Tampilkan semua data
            return;
        }

        // Filter baris berdasarkan input pencarian pada kolom catatan
        const filteredRows = originalRows.filter((row) => {
            const catatanElement = row.querySelector(
                ".isi_catatan"); // Cari elemen dengan kelas .isi_catatan
            if (catatanElement) {
                const catatan = catatanElement.textContent.toLowerCase(); // Ambil isi catatan di baris
                return catatan.includes(searchQuery); // Cek apakah catatan mengandung input pencarian
            }
            return false; // Jika tidak ada .isi_catatan, abaikan baris ini
        });

        // Perbarui tabel dengan hasil pencarian
        tableBody.innerHTML = ""; // Kosongkan tabel
        if (filteredRows.length > 0) {
            filteredRows.forEach((row) => tableBody.appendChild(row)); // Tambahkan baris yang cocok
        } else {
            tableBody.innerHTML =
                `<tr><td colspan="5">Tidak ada data ditemukan.</td></tr>`; // Jika tidak ada hasil
        }
    }

    // Tambahkan debounce untuk mengurangi jumlah pencarian
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Pasang event listener pada input dengan debounce
    searchInput.addEventListener("input", debounce(performSearch,
        300)); // Event input untuk pencarian real-time
});
</script>

</html>