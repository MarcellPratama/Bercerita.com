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
        <img src="<?= base_url($psikolog['foto']) ?>" alt="me" class="user-img" />
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
     <!-- Content -->
     <div class="content">
            <div id="profile-content">
            <div class="profile-card">
            <div class="profile-image">
                <img id="profile-img" src="<?= base_url('uploads/' . $psikolog['foto']) ?>" alt="Profile Picture" />
                <i id="edit-photo-icon" class="bi bi-pencil-square" style="display:none; position:absolute; bottom:10px; right:10px; font-size: 2rem; color:white; cursor:pointer;"></i>
                <input type="file" id="foto" style="display:none" />
            </div>
              <div class="profile-name"><?= esc($psikolog['username']) ?></div>
              <br />
              
              <i class="bi bi-person-bounding-box" style="font-size: 1.5rem"></i>
              <div class="section-title">Tentang Saya</div>
              <!-- Menggunakan contenteditable untuk memungkinkan perubahan langsung -->
              <div id="tentang-saya-text" contenteditable="false"><?= empty($psikolog['tentang_saya']) ? '-' : esc($psikolog['tentang_saya']) ?></div>
              <br><br>
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
        </div>
      <div class="jadwal-content" id="jadwal-content" style="display: none">
        <div class="section-name">Jadwal Konsultasi</div>
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
                  <label for="relasi_romantis">
                    <input type="checkbox" id="relasi_romantis" name="kasus[]" value="Relasi Romantis">
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
    console.log('Button Layanan diklik'); // Debugging log
    layanancnt.style.display = "flex";
    jadwalContent.style.display = "none";
    profileContent.style.display = "none";
  });


    konsultasiOnline.addEventListener("click", function (e) {
      e.preventDefault();
      layanancnt.style.display = "none";
      profileContent.style.display = "none";
      jadwalContent.style.display = "flex";
    });

    konsultasiTatapMuka.addEventListener("click", function (e) {
      e.preventDefault();
      layanancnt.style.display = "none";
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

    document.getElementById("edit-profile-btn").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("tentang-saya-text").contentEditable = true;
        document.getElementById("pendekatan-klinis-text").contentEditable = true;
        document.getElementById("save-profile-btn").style.display = "inline-block";
        document.getElementById("foto").style.display = "inline-block";
        document.getElementById("edit-photo-icon").style.display = "block";
        document.getElementById("tentang-saya-text").style.border = "1px solid #ccc";
        document.getElementById("pendekatan-klinis-text").style.border = "1px solid #ccc";
      });

      // Handling the photo change
      document.getElementById("edit-photo-icon").addEventListener("click", function () {
        document.getElementById("foto").click(); // Trigger file input when pencil icon is clicked
      });

      document.getElementById("foto").addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            document.getElementById("profile-img").src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });

      // Save Profile (with image upload)
      document.getElementById("save-profile-btn").addEventListener("click", function (e) {
        e.preventDefault();
        const tentangSaya = document.getElementById("tentang-saya-text").innerText;
        const pendekatanKlinis = document.getElementById("pendekatan-klinis-text").innerText;
        const foto = document.getElementById("foto").files[0];

        const formData = new FormData();
        formData.append("tentang_saya", tentangSaya);
        formData.append("pendekatan_klinis", pendekatanKlinis);
        if (foto) {
          formData.append("foto", foto);
        }

        // Send data to server via Fetch API
        fetch("/update-profile", {
          method: "POST",
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Profil berhasil diperbarui');
            location.reload(); // Reload page to see changes
          } else {
            alert('Terjadi kesalahan');
          }
        })
        .catch(error => {
          alert('Terjadi kesalahan');
        });
      });

            // Select all checkboxes under the "Kasus Yang Ditangani" section
      const checkboxes = document.querySelectorAll('input[name="kasus[]"]');

      // Function to handle checkbox selection limit
      function handleCheckboxLimit() {
        const selectedCheckboxes = document.querySelectorAll('input[name="kasus[]"]:checked');
        if (selectedCheckboxes.length > 4) {
          alert('Anda hanya dapat memilih hingga 4 kasus.');
          // Deselect the last checked box
          selectedCheckboxes[selectedCheckboxes.length - 1].checked = false;
        }
      }

      // Add event listener to each checkbox
      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxLimit);
      });

  </script>
</html>
