<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('/css/dbpsikolog.css') ?>">
    
    <title>Document</title>
  </head>
  <body>
    <div class="main-container">
    <div class="sidebar">
      <div class="top">
        <div class="logo">
          <img src="base_url('/images/Logo_Bercerita.com2.png')" alt="" />
        </div>
        <i class="bi bi-list" id="btn"></i>
      </div>
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
          <!-- <div class="submenu" id="submenu">
            <a href="#" id="konsultasi-online">Konsultasi Online</a>
            <a href="#" id="konsultasi-offline">Konsultasi Tatap Muka</a>
          </div> -->
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
        <form id="profile-form" method="post" enctype="multipart/form-data"
        action="<?= base_url('/psikolog/updateProfilePhoto') ?>">
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

                    <br><br>
                    <i class="bi bi-coin" style="font-size: 1.5rem;"></i>
                    <div class="section-title">Tarif Konsultasi</div>
                    <textarea id="tarif-text" name="tarif-text" style="display:none;"
                        rows="1"><?= empty($psikolog['tarif']) ? '' : esc($psikolog['tarif']) ?></textarea>
                    <div id="tarif-text-view" contenteditable="false">
                        <?= empty($psikolog['tarif']) ? '' : 'Rp'. number_format((float)$psikolog['tarif'], 2, ',', '.') ?>
                    </div>
                    

                    <a href="#" id="edit-profile-btn" class="edit-button">Edit Profile</a>
                    <button id="save-profile-btn" class="submit-btn" style="display:none;">Simpan</button>
                </div>
            </div>
    </form>
      <div class="jadwal-content" id="jadwal-content" style="display: none">
          <h1>Jadwal Konsultasi</h1>
          <div class="button-group">
              <button id="tm", class="active">Tatap muka</button>
              <button id="chat">Chat</button>
              <button id="kelola">Kelola Jadwal</button>
          </div>
          <div id="session-chat">
            <div class="session">
                <div class="session-title">Sesi Chat Hari ini</div>
                <?php if (!empty($todaySessions)): ?>
                    <?php foreach ($todaySessions as $session): ?>
                        <div class="session-item">
                            <div><?= $session['time'] ?><br><?= $session['name'] ?></div>
                            <div>
                                <button class="chat-button">Chat</button>
                                <button class="complete-button">Selesai</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No sessions available for today.</p>
                <?php endif; ?>
            </div>

            <div class="session">
                <div class="session-title">Sesi Chat Besok</div>
                <?php if (!empty($tomorrowSessions)): ?>
                    <?php foreach ($tomorrowSessions as $session): ?>
                        <div class="session-item">
                            <div><?= $session['time'] ?><br><?= $session['name'] ?></div>
                            <div>
                                <button class="chat-button">Chat</button>
                                <button class="complete-button">Selesai</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No sessions available for tomorrow.</p>
                <?php endif; ?>
            </div>
            </div>
            <div class="calendar-container" id="calendar-container" style="display: none;">
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
          <form action="/psikolog/simpanLayanan" method="post">
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
          </form>
        </div>
      </div>
      <div id="kelola-content" class="kelola-content" style="display: none;">
       <div class="container-content">
          <div class="schedule">
            <h3>Jadwal saat ini</h3>
            <ul>
              <?php if (!empty($jadwal)): ?>
                  <?php foreach ($jadwal as $row): ?>
                      <li>
                          <strong><?= esc($row['hari']) ?></strong> 
                          <span><?= esc($row['jam_buka']) . ' - ' . esc($row['jam_tutup']); ?></span>
                      </li>
                  <?php endforeach; ?>
              <?php else: ?>
                  <li>Jadwal belum tersedia.</li>
              <?php endif; ?>
            </ul>
        </div>
      <form action="/psikolog/simpanJadwal" method="post" >
      <?= csrf_field() ?>
        <div class="edit-jadwal">
            <h3>Edit Jadwal</h3>
            <label for="hari">Hari</label>
            <select name="hari" id="hari">
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
                <option>Sabtu</option>
                <option>Minggu</option>
            </select>
            <label for="jam_buka">Jam Buka</label>
            <input type="time" name="jam_buka" id="time-open" required>
            <br>

            <label for="jam_tutup">Jam Tutup</label>
            <input type="time" name="jam_tutup" id="time-close" required>
            <br>
            <button type="submit" id="simpan-jadwal">Simpan</button>
        </div>
        </form>

           <!-- Popup untuk Pesan -->
          <?php if (session()->getFlashdata('error')): ?>
          <div id="popup-error" class="popup-overlay">
              <div class="popup-box">
                  <p style="color: red;"><?= session()->getFlashdata('error'); ?></p>
                  <button onclick="closePopup('popup-error')">Tutup</button>
              </div>
          </div>
          <?php endif; ?>

          <?php if (session()->getFlashdata('success')): ?>
          <div id="popup-success" class="popup-overlay">
              <div class="popup-box">
                  <p style="color: green;"><?= session()->getFlashdata('success'); ?></p>
                  <button onclick="closePopup('popup-success')">Tutup</button>
              </div>
          </div>
          <?php endif; ?>

        </div>
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
    let layananBtn = document.getElementById("layanan-btn");
    let layanancnt = document.getElementById("layanan");
    const editOverlay = document.getElementById("edit-overlay");
    const profileImgSidebar = document.getElementById("profile-img-sidebar");
    const editProfileBtn = document.getElementById("edit-profile-btn");
    const saveProfileBtn = document.getElementById("save-profile-btn");
    const tentangSayaText = document.getElementById("tentang-saya-text");
    const pendekatanKlinisText = document.getElementById("pendekatan-klinis-text");
    const fotoInput = document.getElementById("foto");
    const profileImg = document.getElementById("profile-img");
    const tentangSayaTextView = document.getElementById("tentang-saya-text-view");
    const pendekatanKlinisTextView = document.getElementById("pendekatan-klinis-text-view");
    const kelolajadwal = document.getElementById("kelola-content");
    const tariftext = document.getElementById("tarif-text");
    const tariftextview = document.getElementById("tarif-text-view");
// Fungsi untuk masuk ke mode edit
function enableEditMode() {
    // Menampilkan textarea untuk edit
    tentangSayaText.style.display = "block";
    pendekatanKlinisText.style.display = "block";
    tariftext.style.display = "block";
    tentangSayaTextView.style.display = "none";
    pendekatanKlinisTextView.style.display = "none";
    tariftextview.style.display = "none";

    // Menampilkan tombol simpan dan input foto
    saveProfileBtn.style.display = "inline-block";
    editProfileBtn.style.display = "none"; // Sembunyikan tombol "Edit Profil"
    fotoInput.style.display = "inline-block";

    // Tambahkan border agar terlihat lebih jelas
    tentangSayaText.style.border = "1px solid #ccc";
    pendekatanKlinisText.style.border = "1px solid #ccc";
    tariftext.style.border = "1px solid #ccc";
}

// Fungsi untuk menyimpan perubahan
function disableEditMode() {
    // Mengembalikan tampilan ke mode tampilan
    tentangSayaText.style.display = "none";
    pendekatanKlinisText.style.display = "none";
    tariftext.style.display = "none";
    tentangSayaTextView.style.display = "block";
    pendekatanKlinisTextView.style.display = "block";
    tariftextview.style.display = "block";

    // Update konten tampilan dengan isi dari textarea
    tentangSayaTextView.innerText = tentangSayaText.value;
    pendekatanKlinisTextView.innerText = pendekatanKlinisText.value;
    tariftextview.innerText = tariftext.value;

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
    if (tariftext.value.trim() === "") {
      tariftextview.innerText = "-";
      tariftext.value = "";
    } else {
      tariftextview.innerText = tariftext.value;
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
    jadwalBtn.onclick = function (e) {
      e.preventDefault();
      profileContent.style.display = "none";
      jadwalContent.style.display = "block";
      layanancnt.style.display = "none";
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
    kelolajadwal.style.display = "none";
    });

    document.getElementById('chat').addEventListener('click', function() {
      document.getElementById('calendar-container').style.display = 'none';
      document.getElementById('session-chat').style.display = 'block';
      document.getElementById('kelola-content').style.display = 'none';
    });
    document.getElementById('tm').addEventListener('click', function() {
      document.getElementById('calendar-container').style.display = 'block';
      document.getElementById('session-chat').style.display = 'none';
      document.getElementById('kelola-content').style.display = 'none';
    });
    document.getElementById('kelola').addEventListener('click', function() {
      document.getElementById('calendar-container').style.display = 'none';
      document.getElementById('session-chat').style.display = 'none';
      document.getElementById('kelola-content').style.display = 'block';
    })

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

    function closePopup(id) {
        document.getElementById(id).style.display = 'none';
    }
    
</script>
</html>