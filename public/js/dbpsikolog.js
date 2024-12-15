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
