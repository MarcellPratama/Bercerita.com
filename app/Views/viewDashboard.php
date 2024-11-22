<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bercerita Dashboard</title>

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
        height: 97vh;
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
        flex-grow: 1;
        padding: 20px;
        margin-right: 20px;
        /* Control right margin space */
        display: flex;
        flex-direction: column;
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

    /* Panah untuk indikator submenu */
    .toggle-submenu {
        margin-left: auto;
        font-size: 14px;
        cursor: pointer;
    }


    .grid-layout {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;

    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .card h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .card p {
        margin: 0;
        font-size: 14px;
        color: #888;
    }

    .card i {
        font-size: 30px;
        color: #333;
    }

    .status {
        font-size: 12px;
        color: #4caf50;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .grid-layout-2 {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }

    .chart-container {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    #myChart {
        max-width: 500px;
        margin: 0 auto;
    }

    .info-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        background-color: white;
    }

    .info-card h3 {
        margin: 0;
        font-weight: bold;
    }

    .info-card i {
        font-size: 25px;
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
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="user-profile">
            <img src="/profil.jpeg" alt="User Image" class="user-img" />
            <h5>Patrisia Cindy</h5>
        </div>

        <ul class="menu">
            <li><a href="adminDashboard" class="active"><i class="fas fa-home"></i> Beranda</a></li>
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

            <li><a href="/login"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2><span class="bold-text"></span> <span class="regular-text"></span></h2>
            <img src="/bercerita.png" alt="Bercerita Logo" class="logo" />
        </div>

        <div class="grid-layout">
            <div class="info-card">
                <div>
                    <p>Klien</p>
                    <h3>43.5k</h3>
                    <div class="status">
                        <i class="fas fa-arrow-up"></i> +10%
                    </div>
                </div>
                <i class="fas fa-user"></i>
            </div>

            <div class="info-card">
                <div>
                    <p>Psikolog</p>
                    <h3>43.5k</h3>
                    <div class="status">
                        <i class="fas fa-arrow-up"></i> +10%
                    </div>
                </div>
                <i class="fas fa-user-tie"></i>
            </div>

            <div class="info-card">
                <div>
                    <p>Mahasiswa Psikologi</p>
                    <h3>43.5k</h3>
                    <div class="status">
                        <i class="fas fa-arrow-up"></i> +10%
                    </div>
                </div>
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>

        <div class="grid-layout-2">
            <div class="chart-container">
                <h3>Peminat Forum</h3>
                <canvas id="myChart"></canvas>
            </div>

            <div>
                <div class="info-card">
                    <div>
                        <p>Belum Diverifikasi</p>
                        <h3>500</h3>
                        <div class="status">
                            <i class="fas fa-arrow-up"></i> +10%
                        </div>
                    </div>
                    <i class="fas fa-user-check"></i>
                </div>

                <div class="info-card" style="margin-top: 20px;">
                    <div>
                        <p>Total Sesi Konsultasi</p>
                        <h3>600</h3>
                        <div class="status">
                            <i class="fas fa-arrow-up"></i> +10%
                        </div>
                    </div>
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const data = {
        labels: ['Kecemasan', 'Trauma'],
        datasets: [{
            label: 'Forum Interest',
            data: [63, 25],
            backgroundColor: ['#00C2CB', '#7553F6'],
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                },
            },
        },
    };

    new Chart(document.getElementById('myChart'), config);
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    function toggleSubmenu(element) {
        const submenu = element.nextElementSibling;
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";

        // Mengubah panah untuk menunjukkan apakah submenu terbuka atau tertutup
        const arrow = element.querySelector('.toggle-submenu');
        arrow.innerHTML = submenu.style.display === "block" ? "&#9652;" : "&#9662;";
    }
    </script>
</body>

</html>