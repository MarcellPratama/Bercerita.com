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
        height: 111vh;
        background-color: #00c2cb;
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
        transition: background 0.3s;
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
        background-color: #00c2cb;
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

    .container-table {
        margin-top: 5px;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 7px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: 630px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
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

    .action-btn {
        font-size: 14px;
        color: #fff;
        padding: 6px 10px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
    }

    .action-btn.reject {
        background-color: #ff6b6b;
    }

    .action-btn.approve {
        background-color: #4caf50;
    }

    .action-btn.view {
        background-color: #ffae42;
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
        top: 330px;
        left: 525px;
    }

    .pagination .page-item {
        font-size: 14px;
        padding: 3px 4px;
        /* Reduce padding for smaller box size */
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
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

    .modal-content {
        margin-top: 230px;
        flex-direction: column;
        align-items: center;
        background-color: white;
        margin-left: 615px;
        margin-right: 700px;
        width: 400px;
        height: 180px;
    }

    .modal-content i {
        margin-top: 20px;
        /* Adjust as needed */
        margin-bottom: 10px;
    }

    .modal p {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin: 0;
        margin-top: 10px;
    }

    #modalCloseBtn {
        margin-top: 20px;
        background-color: #00c2cb;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    #modalCloseBtn:hover {
        background-color: #00a5a6;
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

    .modal-content-reject {
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

    .modal-content-reject i {
        font-size: 40px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .modal-content-reject p {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        margin-top: 10px;
    }

    .modal-content-reject .btn {
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
            <li><a href="#" class="active"><i class="fas fa-check-circle"></i> Verifikasi</a></li>
            <li>
                <a href="#" class="dropdown-toggle" onclick="toggleSubmenu(this)">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <ul class="submenu">
                    <li><a href="adminLihatPsikolog"><i class="fas fa-user"></i> Psikolog</a></li>
                    <li><a href="adminLihatMhs"><i class="fas fa-user-graduate"></i> Mahasiswa Psikologi</a></li>
                </ul>
            </li>
            <li><a href="kelolaMading"><i class="fas fa-file-alt"></i> Kelola Mading</a></li>
            <li><a href="/login"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2><span class="bold-text">Verifikasi</span> <span class="regular-text">Pengguna</span></h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>

        <div class="container-table">
            <div class="search-container mb-3">
                <form method="get" action="/adminVerifikasi" style="width: 100%; display: flex; align-items: center;">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari"
                        value="<?= isset($search) ? esc($search) : '' ?>" style="padding-left: 30px;" />
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php $no = 1; ?>
                    <?php foreach ($pengguna as $user): ?>
                    <tr class="userRow">
                        <td><?= $no++; ?></td>
                        <td class="username"><?= esc($user['username']); ?></td>
                        <td><?= esc($user['kategori']); ?></td>
                        <td><?= esc($user['status_verifikasi']); ?></td>

                        <td>
                            <!-- Reject Button -->
                            <span class="action-btn reject" title="Tolak" data-id="<?= $user['id']; ?>"><i
                                    class="fas fa-times"></i></span>
                            <!-- Approve Button -->
                            <span class="action-btn approve" title="Setujui" data-id="<?= $user['id']; ?>"><i
                                    class="fas fa-check"></i></span>
                            <!-- View Button -->
                            <?php if ($user['kategori'] === 'Mahasiswa Psikologi'): ?>
                            <a href="/adminLihatDetailMhs/<?= $user['id']; ?>" class="action-btn view"
                                title="Lihat Detail Mahasiswa">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php elseif ($user['kategori'] === 'Psikolog'): ?>
                            <a href="/adminLihatDetailPsikolog/<?= $user['id']; ?>" class="action-btn view"
                                title="Lihat Detail Psikolog">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php else: ?>
                            <span class="action-btn disabled" title="Kategori Tidak Valid">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">&#x203A;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Modal Konfirmasi Tolak -->
            <div class="modal" id="modalTolak" style="display: none;">
                <div class="modal-content-reject">
                    <i class="fas fa-times-circle" style="color: #ff6b6b; font-size: 40px;"></i>
                    <p>Apakah Anda yakin ingin menolak pengguna ini?</p>
                    <button class="btn btn-secondary" id="btnBatal">Batal</button>
                    <button class="btn btn-danger" id="btnKonfirmasiTolak">Ya</button>
                </div>
            </div>


            <div class="modal" id="topUpModal" style="display: none;">
                <div class="modal-content">
                    <i class="fas fa-check-circle" style="color: #28a745; font-size: 40px;"></i>
                    <p>Berhasil Verifikasi</p>
                    <button class="btn btn-primary" id="modalCloseBtn">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
// Apprtion
const approveButtons = document.querySelectorAll('.action-btn.approve');
approveButtons.forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        fetch(`/verifikasi/approve/${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('User approved!');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Error: ' + data.message); // Show error message
                }
            })
            .catch(error => {
                alert('An error occurred: ' + error
                    .message); // Handle any errors from the fetch request
            });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const rejectButtons = document.querySelectorAll('.action-btn.reject');
    const modalTolak = document.getElementById('modalTolak');
    const btnBatal = document.getElementById('btnBatal');
    const btnKonfirmasiTolak = document.getElementById('btnKonfirmasiTolak');
    let userIdTolak = null;

    // Show the modal when the "Tolak" button (reject) is clicked
    rejectButtons.forEach(button => {
        button.addEventListener('click', function() {
            userIdTolak = this.getAttribute('data-id'); // Get user ID from the button
            modalTolak.style.display = 'block'; // Show the modal
        });
    });

    // Close the modal when the "Batal" button is clicked
    btnBatal.addEventListener('click', function() {
        modalTolak.style.display = 'none'; // Hide the modal
    });

    // Confirm rejection when the "Ya" button is clicked
    btnKonfirmasiTolak.addEventListener('click', function() {
        if (userIdTolak) {
            fetch(`/verifikasi/reject/${userIdTolak}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert('Pengguna berhasil ditolak.');
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        alert('Terjadi kesalahan: ' + data.message); // Show error message
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan: ' + error.message); // Handle any errors
                });
        }
        modalTolak.style.display = 'none'; // Hide the modal after confirming rejection
    });
});


function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";

    // Toggle the arrow for submenu indicator
    const arrow = element.querySelector('.toggle-submenu');
    arrow.innerHTML = submenu.style.display === "block" ? "&#9652;" : "&#9662;";
}


document.addEventListener("DOMContentLoaded", function() {
    // Inisialisasi pagination setelah halaman dimuat
    let currentPage = 1;
    const rows = document.querySelectorAll("table tbody tr");
    const totalRows = rows.length;
    const rowsPerPage = 10; // Jumlah baris per halaman
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    // Fungsi untuk menampilkan halaman yang sesuai
    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = ''; // Tampilkan baris sesuai halaman
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak sesuai halaman
            }
        });
    }

    // Fungsi untuk merender tombol-tombol pagination
    function renderPagination() {
        const paginationContainer = document.querySelector(".pagination ul");
        paginationContainer.innerHTML = ''; // Kosongkan pagination sebelumnya

        // Tombol Previous
        paginationContainer.innerHTML += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                          <a class="page-link" href="#">&#x2039;</a>
                                      </li>`;

        // Tentukan rentang halaman yang akan ditampilkan
        const maxVisiblePages = 4; // Tampilkan maksimal 4 halaman
        let startPage = Math.max(1, currentPage - 1); // Mulai 1 halaman sebelum current
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1); // Maksimal 4 halaman ke depan

        // Jika ada ruang kosong di awal, geser rentang halaman
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        // Halaman Nomor
        for (let i = startPage; i <= endPage; i++) {
            const isActive = i === currentPage ? 'active' : '';
            paginationContainer.innerHTML += `<li class="page-item ${isActive}">
                                              <a class="page-link" href="#">${i}</a>
                                          </li>`;
        }

        // Tombol Next
        paginationContainer.innerHTML += `<li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                                          <a class="page-link" href="#">&#x203A;</a>
                                      </li>`;

        attachPaginationEvents(); // Tambahkan event listener untuk tombol pagination
    }

    // Fungsi untuk menambahkan event listener ke tombol-tombol pagination
    function attachPaginationEvents() {
        const pageItems = document.querySelectorAll(".page-item");
        const prevButton = pageItems[0];
        const nextButton = pageItems[pageItems.length - 1];

        prevButton.addEventListener("click", function() {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                renderPagination();
            }
        });

        nextButton.addEventListener("click", function() {
            if (currentPage < Math.min(totalPages, 4)) { // Batasi hingga halaman ke-4
                currentPage++;
                showPage(currentPage);
                renderPagination();
            }
        });

        pageItems.forEach((item) => {
            if (item.classList.contains("page-item") && !item.classList.contains("disabled")) {
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

    // Menampilkan halaman pertama dan merender paginasi
    showPage(currentPage);
    renderPagination();
});


document.addEventListener("DOMContentLoaded", function() {
    // Select all approve buttons (checkmark buttons)
    const approveButtons = document.querySelectorAll(".action-btn.approve");
    const modal = document.getElementById("topUpModal");
    const modalCloseBtn = document.getElementById("modalCloseBtn");

    // Function to show the modal
    function showModal() {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Attach event listeners to each approve button
    approveButtons.forEach(button => {
        button.addEventListener("click", showModal);
    });

    // Close the modal when the OK button is clicked
    modalCloseBtn.addEventListener("click", closeModal);
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

        // Filter baris berdasarkan input pencarian (awalan username)
        const filteredRows = originalRows.filter((row) => {
            const username = row.querySelector(".username").textContent
                .toLowerCase(); // Ambil username di baris
            return username.includes(searchQuery); // Cek apakah username diawali oleh input
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
    searchInput.addEventListener("input", debounce(performSearch, 300));
});
</script>

</html>