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
        background-color: #00c2cb;
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
                    <li><a href="#" class="active"><i class="fas fa-user-graduate"></i> Mahasiswa Psikologi</a></li>
                </ul>
            </li>
            <li><a href="kelolaMading"><i class="fas fa-file-alt"></i> Kelola Mading</a></li>
            <li><a href="/login"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2><span class="bold-text">Tampilan</span> <span class="regular-text">Mahasiswa Psikologi</span></h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>
        <div class="container-table">
            <div class="search-container mb-3">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari" />
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">



                    <?php foreach ($pengguna as $key => $mhs): ?>
                    <tr class="mahasiswaRow">
                        <td><?= $startNo + $key; ?></td>
                        <td class="username"><?= esc($mhs['username']); ?></td>
                        <td><?= esc($mhs['kategori']); ?></td>
                        <td><?= esc($mhs['tanggal_verifikasi']); ?></td>
                        <td>
                            <a href="/adminLihatDetailMhs/<?= $mhs['id']; ?>" class="action-btn view"
                                title="Lihat Detail Mahasiswa Psikologi">
                                <i class="fas fa-eye"></i>
                            </a>
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
        </div>
    </div>
</body>
<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";

    // Mengubah panah untuk menunjukkan apakah submenu terbuka atau tertutup
    const arrow = element.querySelector('.toggle-submenu');
    arrow.innerHTML = submenu.style.display === "block" ? "&#9652;" : "&#9662;";
}

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
    let currentPage = 1;
    const rowsPerPage = 10; // Jumlah baris per halaman

    // Fungsi untuk merender tabel berdasarkan halaman
    function renderTable(filteredRows, page) {
        const start = (page - 1) * rowsPerPage; // Hitung indeks awal berdasarkan halaman
        const end = start + rowsPerPage; // Hitung indeks akhir berdasarkan halaman

        tableBody.innerHTML = ""; // Kosongkan tabel sebelum dirender ulang

        const rowsToShow = filteredRows.slice(start, end); // Ambil data yang akan ditampilkan
        rowsToShow.forEach((row, index) => {
            const rowCopy = row.cloneNode(true);
            // Nomor urut global
            rowCopy.querySelector("td:first-child").textContent = start + index + 1;
            tableBody.appendChild(rowCopy);
        });

        // Jika tidak ada data yang ditemukan
        if (rowsToShow.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                </tr>`;
        }

        renderPagination(filteredRows); // Perbarui pagination
    }

    // Fungsi untuk merender tombol pagination
    function renderPagination(filteredRows) {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage); // Total halaman
        paginationContainer.innerHTML = ""; // Kosongkan pagination sebelum dirender ulang

        // Tombol "Previous"
        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                <a class="page-link" href="#" data-page="${currentPage - 1}">&#x2039;</a>
            </li>`;

        // Tombol Halaman
        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.innerHTML += `
                <li class="page-item ${i === currentPage ? "active" : ""}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
        }

        // Tombol "Next"
        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
                <a class="page-link" href="#" data-page="${currentPage + 1}">&#x203A;</a>
            </li>`;

        attachPaginationEvents(filteredRows); // Tambahkan event listener ke pagination
    }

    // Fungsi untuk menambahkan event listener ke tombol pagination
    function attachPaginationEvents(filteredRows) {
        const pageLinks = paginationContainer.querySelectorAll(".page-link");

        pageLinks.forEach((link) => {
            link.addEventListener("click", function(e) {
                e.preventDefault();
                const page = parseInt(this.getAttribute("data-page"));

                if (page > 0 && page <= Math.ceil(filteredRows.length / rowsPerPage)) {
                    currentPage = page; // Atur halaman saat ini
                    renderTable(filteredRows, currentPage); // Render tabel untuk halaman baru
                }
            });
        });
    }

    // Fungsi pencarian global
    function performSearch() {
        const query = searchInput.value.trim().toLowerCase();
        filteredRows = originalRows.filter((row) => {
            const username = row.querySelector(".username").textContent.toLowerCase();
            return username.includes(query); // Filter data berdasarkan input pencarian
        });

        currentPage = 1; // Reset ke halaman pertama
        renderTable(filteredRows, currentPage); // Render tabel berdasarkan hasil pencarian
    }

    // Fungsi debounce untuk pencarian (mengurangi frekuensi eksekusi)
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    searchInput.addEventListener("input", debounce(performSearch, 300)); // Event pencarian dengan debounce

    // Inisialisasi tampilan awal
    renderTable(filteredRows, currentPage);
});
</script>

</html>