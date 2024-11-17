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
    }

    table {
        width: 80%;
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }

    .keterangan-tampilan {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .pagination .page-item {
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        padding: 3px 4px; /* Kurangi padding untuk ukuran kotak lebih kecil */
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
                    <li><a href="#"class="active"><i class="fas fa-user-graduate"></i> Mahasiswa Psikologi</a></li>
                </ul>
            </li>
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
                <input type="text" id="searchInput" class="form-control" placeholder="Search" />
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Putri Ala Syakari</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lisa Akalia Mali</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Budiman Setiadi</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Rio Martin Rendi</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Amelia Sanjaya</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Rina Andira</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Joko Mardika</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Adi Surya</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Desi Rachmawati</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Farhan Irawan</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <p class="keterangan-tampilan">Tampilan 1 ke 10 dari 50</p>
                <div class="pagination">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">&#x203A;</a></li>
                        </ul>
                    </nav>
                </div>
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
document.getElementById("searchInput").addEventListener("input", function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        const name = row.cells[1].textContent.toLowerCase();
        const category = row.cells[2].textContent.toLowerCase();
        if (name.includes(searchValue) || category.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const paginationContainer = document.querySelector(".pagination ul");
    const prevButton = document.querySelector(".page-item:first-child");
    const nextButton = document.querySelector(".page-item:last-child");
    let currentPage = 1;
    let totalPages = 4; // Number of pages shown at once

    // Function to render the pagination items
    function renderPagination() {
        paginationContainer.innerHTML = `
                <li class="page-item"><a class="page-link" href="#">&#x2039;</a></li>
            `;

        for (let i = currentPage; i < currentPage + totalPages; i++) {
            const isActive = i === currentPage ? "active" : "";
            paginationContainer.innerHTML += `
                    <li class="page-item ${isActive}"><a class="page-link" href="#">${i}</a></li>
                `;
        }

        paginationContainer.innerHTML += `
                <li class="page-item"><a class="page-link" href="#">&#x203A;</a></li>
            `;

        // Re-attach event listeners after re-rendering
        attachEventListeners();
    }

    // Function to attach event listeners to page items
    function attachEventListeners() {
        const pageItems = document.querySelectorAll(".page-item");
        const prevButton = pageItems[0];
        const nextButton = pageItems[pageItems.length - 1];

        // Click event for the previous button
        prevButton.addEventListener("click", function() {
            if (currentPage > 1) {
                currentPage--;
                renderPagination();
            }
        });

        // Click event for the next button
        nextButton.addEventListener("click", function() {
            currentPage++;
            renderPagination();
        });

        // Click events for individual page numbers
        pageItems.forEach((item, index) => {
            if (index > 0 && index < pageItems.length - 1) {
                item.addEventListener("click", function() {
                    // Set the clicked page number as active without shifting
                    const clickedPageNumber = parseInt(item.textContent);
                    pageItems.forEach((page) => page.classList.remove("active"));
                    item.classList.add("active");
                });
            }
        });
    }

    // Initial rendering of the pagination
    renderPagination();
});
</script>

</html>