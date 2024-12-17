<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('css/transaksi.css') ?>">
    <title>Pemesanan</title>
</head>

<body>
    <div class="container mt-3">
        <h2 class="fw-bold">Pilih Tanggal dan Waktu</h2>
        <div class="row mt-4">
            <!-- Kalender -->
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button id="prevMonth" class="btn btn-sm btn-outline-dark">&lt;</button>
                            <h5 id="monthYear"></h5>
                            <button id="nextMonth" class="btn btn-sm btn-outline-dark">&gt;</button>
                        </div>

                        <!-- Kalender Grid -->
                        <div class="calendar">
                            <div class="row text-center fw-bold">
                                <div class="col">M</div>
                                <div class="col">S</div>
                                <div class="col">S</div>
                                <div class="col">R</div>
                                <div class="col">K</div>
                                <div class="col">J</div>
                                <div class="col">S</div>
                            </div>
                            <!-- Grid Hari Dinamis -->
                            <div id="calendarGrid"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6 class="mt-4 fw-bold">Pilih Tanggal dan Waktu</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const monthYear = document.getElementById("monthYear");
        const calendarGrid = document.getElementById("calendarGrid");
        const prevMonthBtn = document.getElementById("prevMonth");
        const nextMonthBtn = document.getElementById("nextMonth");
        const selectedDateDisplay = document.getElementById("selectedDate");

        let currentDate = new Date();

        // Fungsi untuk merender kalender
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // Menampilkan nama bulan dan tahun
            monthYear.textContent = new Intl.DateTimeFormat("id-ID", {
                month: "long",
                year: "numeric",
            }).format(currentDate);

            // Menghitung jumlah hari dalam bulan
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Reset kalender
            calendarGrid.innerHTML = "";

            let dayCount = 1;
            for (let i = 0; i < 6; i++) {
                const row = document.createElement("div");
                row.className = "row text-center mt-1";

                for (let j = 0; j < 7; j++) {
                    const col = document.createElement("div");
                    col.className = "col";
                    const dayDiv = document.createElement("div");

                    if (i === 0 && j < firstDay) {
                        dayDiv.textContent = "";
                    } else if (dayCount > daysInMonth) {
                        dayDiv.textContent = "";
                    } else {
                        dayDiv.textContent = dayCount;
                        dayDiv.className = "day available";

                        // Tambahkan event klik pada hari
                        dayDiv.addEventListener("click", () => {
                            selectDate(year, month, dayCount, dayDiv);
                        });

                        dayCount++;
                    }

                    col.appendChild(dayDiv);
                    row.appendChild(col);
                }
                calendarGrid.appendChild(row);
            }
        }

        function selectDate(year, month, day, element) {
            // Reset class 'selected' dari semua hari
            document.querySelectorAll(".day").forEach((day) => {
                day.classList.remove("selected");
            });

            // Tandai elemen yang diklik
            element.classList.add("selected");

            // Tampilkan tanggal yang dipilih
            const selectedDate = new Date(year, month, day);
            selectedDateDisplay.textContent = `Tanggal Terpilih: ${selectedDate.toLocaleDateString("id-ID")}`;
        }

        // Navigasi Bulan
        prevMonthBtn.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        // Inisialisasi Kalender
        renderCalendar();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>