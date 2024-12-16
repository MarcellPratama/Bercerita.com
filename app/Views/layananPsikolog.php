<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Psikolog</title>
</head>
<body>
<div class="layanan" id="layanan">
  <div class="section-name-layanan">Layanan</div>
  <div class="layanan-content" id="layanan-content">
    <label for="cases">Kasus Yang ditangani (Max. 4)</label>
    <form action="/psikolog/simpanLayanan" method="post">
      <div class="checkbox-group">
        <label for="kecemasan"><input type="checkbox" id="kecemasan" name="kasus[]" value="Kecemasan"> Kecemasan</label>
        <label for="depresi"><input type="checkbox" id="depresi" name="kasus[]" value="Depresi"> Depresi</label>
        <label for="kepercayaan_diri"><input type="checkbox" id="kepercayaan_diri" name="kasus[]" value="Kepercayaan diri"> Kepercayaan diri</label>
        <label for="masalah_keluarga"><input type="checkbox" id="masalah_keluarga" name="kasus[]" value="Masalah Keluarga"> Masalah Keluarga</label>
        <!-- Additional cases here -->
      </div>
      <div class="other-case">
        <label for="lainnya">Lainnya...</label>
        <input type="text" id="lainnya" name="lainnya">
      </div>
      <button type="submit" class="submit-btn">Simpan</button>
    </form>
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

    // Enable editing for profile
  document.getElementById("edit-profile-btn").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("tentang-saya-text").contentEditable = true;
    document.getElementById("pendekatan-klinis-text").contentEditable = true;
    document.getElementById("save-profile-btn").style.display = "inline-block"; // Show save button
    document.getElementById("foto").style.display = "inline-block"; // Show file input
    document.getElementById("edit-photo-icon").style.display = "block"; // Show edit photo icon
    document.getElementById("tentang-saya-text").style.border = "1px solid #ccc"; // Add border
    document.getElementById("pendekatan-klinis-text").style.border = "1px solid #ccc"; // Add border
  });

  // Handle photo icon click
  document.getElementById("edit-photo-icon").addEventListener("click", function () {
    document.getElementById("foto").click(); // Trigger file input when edit photo icon is clicked
  });

  // Handle photo preview when a file is selected
  document.getElementById("foto").addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("profile-img").src = e.target.result; // Update profile image preview
      };
      reader.readAsDataURL(file); // Read file as data URL
    }
  });

  // Save profile changes
  document.getElementById("save-profile-btn").addEventListener("click", function (e) {
    e.preventDefault();

    // Retrieve values
    const tentangSaya = document.getElementById("tentang-saya-text").innerText;
    const pendekatanKlinis = document.getElementById("pendekatan-klinis-text").innerText;
    const foto = document.getElementById("foto").files[0];

    // Validate data
    if (!tentangSaya || !pendekatanKlinis) {
      alert("Harap lengkapi semua field sebelum menyimpan.");
      return;
    }

    // Prepare FormData
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
          alert("Profil berhasil diperbarui.");
          location.reload(); // Reload page to see updated changes
        } else {
          alert(data.message || "Terjadi kesalahan saat menyimpan profil.");
        }
      })
      .catch(error => {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat menyimpan profil.");
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