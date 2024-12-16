<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konsultasi</title>
</head>
<body>
<div class="jadwal-content" id="jadwal-content">
  <div class="section-name">Jadwal Konsultasi</div>
  <div class="button-container">
    <button id="tatap-muka-btn" class="consultation-btn">Tatap Muka</button>
    <button id="chat-btn" class="consultation-btn">Chat</button>
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
</body>
<script src="<?= base_url('js/dbpsikolog.js'); ?>" defer></script>

</html>