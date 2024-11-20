<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="<?= base_url('/css/dbpsikolog.css') ?>">
    
    <title>Document</title>
  </head>
  <body>
    <div class="main-container">
    <div class="sidebar">
      <div class="top">
        <div class="logo">
          <img src="\images\Logo Bercerita.com2.png" alt="" />
        </div>
        <i class="bi bi-list" id="btn"></i>
      </div>
      <div class="user">
        <img src="\images\psikolog2.jpg" alt="me" class="user-img" />
        <div class="halo">
          <p class="bold">Halo</p>
          <p>Psikolog</p>
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
    <div class="content">
      <div class="profile-card" id="profile-content">
        <div class="profile-image">
          <img src="\images\psikolog2.jpg" alt="Profile Picture" />
        </div>
        <div class="profile-name">Nayara Krista M.Psi</div>
        <br />
        <i class="bi bi-person-bounding-box" style="font-size: 1.5rem"></i>
        <div class="section-title">Tentang saya</div>
        <div class="section-content">
          Halo, Salam kenal, saya Nayara Krista, seorang
          <a href="#">psikolog</a> klinis dewasa yang lulus dari Program
          Magister Profesi Psikologi Klinis Dewasa
          <a href="#">Universitas Padjadjaran</a>. Bagi saya, memberikan bantuan
          dan perubahan signifikan ke arah yang positif kepada kehidupan
          individu merupakan hal yang utama.
        </div>
        <i class="bi bi-chat-heart" style="font-size: 1.5rem"></i>
        <div class="section-title">Pendekatan Klinis</div>
        <div class="section-content">
          Pendekatan Cognitive Behavior Therapy, Acceptance and Commitment
          Therapy, Client-Centered Therapy, Behavior Modification, Brief
          Solution Focused Therapy.
        </div>
        <i class="bi bi-geo-alt" style="font-size: 1.5rem"></i>
        <div class="section-title">Domisili</div>
        <div class="section-content">Yogyakarta</div>
        <a href="#" class="edit-button">Edit Profile</a>
      </div>
      <div class="jadwal-content" id="jadwal-content" style="display: none">
        <div class="section-name">Jadwal Konsultasi</div>
        <div class="section-button">
          <!-- <a href="#" class="btn" role="button" aria-pressed="true">Primary link</a> -->
        </div>
        <div class="calendar-container">
          <div class="calendar-header">
            <span id="prev-month" class="calendar-nav">&lt;</span>
            <span id="month-year" class="month"></span>
            <span id="next-month" class="calendar-nav">&gt;</span>
          </div>
          <div class="calendar-grid" id="calendar-grid"></div>
        </div>
      </div>
      <div class="layanan" id="layanan" style="display: none">
        <div class="section-name-layanan">Layanan</div><br><br>
        <div class="layanan-content" id="layanan-content"><br><br><br><br>
          <label for="cases">Kasus Yang ditangani (Max. 4)</label>
          <form action="#" method="post">
              <div class="checkbox-group">
                <label for="kecemasan">
                  <input type="checkbox" id="kecemasan" name="kasus[]" value="Kecemasan">
                  Kecemasan
                </label>
                
                <label for="depresi">
                  <input type="checkbox" id="depresi" name="kasus[]" value="Depresi">
                  Depresi
                </label>
                
                <label for="kepercayaan_diri">
                  <input type="checkbox" id="kepercayaan_diri" name="kasus[]" value="Kepercayaan diri">
                  Kepercayaan diri
                </label>
                  
                  <label for="masalah_keluarga">
                    <input type="checkbox" id="masalah_keluarga" name="kasus[]" value="Masalah Keluarga">
                    Masalah Keluarga</label>

                  
                  <label for="gangguan_kepribadian">
                    <input type="checkbox" id="gangguan_kepribaadian" name="kasus[]" value="Gangguan Kepradian">
                    Gangguan Kepribadian</label>

                  
                  <label for="kedukaan">
                    <input type="checkbox" id="kedukaan" name="kasus[]" value="Keduakaan">
                    Keduakaan</label>

                  
                  <label for="relasi_romantis"><input type="checkbox" id="relasi_romantis" name="kasus[]" value="Relasi Romantis">
                    Relasi Romantis</label>

                  
                  <label for="burnout"><input type="checkbox" id="burnout" name="kasus[]" value="Burn out">
                    Burn out</label>

                  
                  <label for="trauma_psikologis">
                    <input type="checkbox" id="trauma_psikologis" name="kasus[]" value="Trauma Psikologis">Trauma Psikologis</label>
              </div>

              <div class="other-case">
                  <label for="lainnya">Lainnya...</label>
                  <input type="text" id="lainnya" name="lainnya">
              </div>
              <button type="submit" class="submit-btn">Simpan</button>
            </div>
        </form>
      </div>
    </div>
    </div>
  </body>
  <script>
let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let profileBtn = document.getElementById("profile-btn");
    let jadwalBtn = document.getElementById("jadwal-btn");
    let profileContent = document.getElementById("profile-content");
    let jadwalContent = document.getElementById("jadwal-content");
    let submenu = document.getElementById("submenu");
    let konsultasiOnline = document.getElementById("konsultasi-online");
    let konsultasiTatapMuka = document.getElementById("konsultasi-offline");
    let layananBtn = document.getElementById("layanan-btn");
    let layanancnt = document.getElementById("layanan");

    btn.onclick = function () {
      sidebar.classList.toggle("active");
    };

    jadwalBtn.onclick = function (e) {
      e.preventDefault();
      if (submenu.style.maxHeight) {
        submenu.style.maxHeight = null;
      } else {
        submenu.style.maxHeight = submenu.scrollHeight + "px";
      }
    };

    profileBtn.addEventListener("click", function (e) {
      e.preventDefault();
      profileContent.style.display = "block";
      jadwalContent.style.display = "none";
      layanancnt.style.display = "none";
    });

    layananBtn.addEventListener("click", function (e) {
      e.preventDefault();
      layanancnt.style.display = "flex";
      jadwalContent.style.display = "none";
      profileContent.style.display = "none";
    });

    konsultasiOnline.addEventListener("click", function (e) {
      e.preventDefault();
      profileContent.style.display = "none";
      jadwalContent.style.display = "flex";
    });

    konsultasiTatapMuka.addEventListener("click", function (e) {
      e.preventDefault();
      profileContent.style.display = "none";
      jadwalContent.style.display = "flex";
    });

    const monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];

    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function generateCalendar(month, year) {
      const calendarGrid = document.getElementById("calendar-grid");
      calendarGrid.innerHTML = "";
      document.getElementById("month-year").textContent =
        monthNames[month] + " " + year;
      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("calendar-day");
        calendarGrid.appendChild(emptyCell);
      }

      for (let day = 1; day <= daysInMonth; day++) {
        const dayCell = document.createElement("div");
        dayCell.classList.add("calendar-day");
        dayCell.textContent = day;
        calendarGrid.appendChild(dayCell);
      }
    }

    document.getElementById("prev-month").addEventListener("click", () => {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      generateCalendar(currentMonth, currentYear);
    });

    document.getElementById("next-month").addEventListener("click", () => {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      generateCalendar(currentMonth, currentYear);
    });

    generateCalendar(currentMonth, currentYear);
  </script>
</html>