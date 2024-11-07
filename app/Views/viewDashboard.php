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

    /* .menu li {
        margin: 15px 0;
    } */

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

    .menu a:hover,
    .menu a.active {
        background-color: #03b5c1;
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
        font-weight: 600;
        color: #333;
    }

    .logo {
        height: 40px;
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
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        padding: 12px;
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

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        gap: 10px;
    }

    .pagination .page-item {
        color: #333;
    }

    .pagination .page-item.active .page-link {
        background-color: #ff3f34;
        color: #fff;
        border: none;
    }

    .pagination .page-link {
        color: #333;
        border: none;
    }

    .keterangan-tampilan {
        text-align: left;
        font-size: 14px;
        color: #666;
        margin-top: 10px;
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
            <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="#" class="active"><i class="fas fa-check-circle"></i> Verifikasi</a></li>
            <li>
                <a href="#" class="dropdown-toggle" onclick="toggleSubmenu(this)">
                    <i class="fas fa-users"></i> Pengguna
                    <!-- <span class="toggle-submenu">&#9662;</span> -->
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="fas fa-user"></i> Psikolog</a></li>
                    <li><a href="#"><i class="fas fa-user-graduate"></i> Mahasiswa Psikologi</a></li>
                </ul>
            </li>
            <li><a href="/login"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Verifikasi Pengguna</h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>

        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Putri Ala Syakari</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lisa Akalia Mali</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Budiman Setiadi</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Rio Martin Rendi</td>
                        <td>Psikolog</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Amelia Sanjaya</td>
                        <td>Psikolog</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Rina Andira</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Joko Mardika</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Adi Surya</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Desi Rachmawati</td>
                        <td>Mahasiswa Psikologi</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Farhan Irawan</td>
                        <td>Psikolog</td>
                        <td>
                            <span class="action-btn reject"><i class="fas fa-times"></i></span>
                            <span class="action-btn approve"><i class="fas fa-check"></i></span>
                            <span class="action-btn view"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">&#x2039;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">&#x203A;</a></li>
                    </ul>
                </nav>
            </div>

            <p class="keterangan-tampilan">Tampilan 1 ke 10 dari 50</p>
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
</script>

</html>