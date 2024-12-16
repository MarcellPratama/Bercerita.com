<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('/css/dbpsikolog.css') ?>">
  <title>Psikolog Dashboard</title>
</head>
<body>
  <div class="main-container">
    <div class="sidebar">
      <div class="top">
        <div class="logo">
          <img src="images/Logo_Bercerita.com2.png" alt="Logo" />
        </div>
        <i class="bi bi-list" id="btn"></i>
      </div>
      <div class="user">
      <img id="profile-img" src="<?= base_url(($psikolog['foto'])) ?>" alt="Profile Picture" loading="lazy">
        <div class="halo">
          <p class="bold">Halo</p>
          <p><?= esc($psikolog['username']) ?></p>
        </div>
        </div>
      <ul>
        <li><a href="?Views=profilePsikolog"><i class="bi bi-person-circle"></i><span>Profil</span></a></li>
        <li><a href="?Views=jadwalPsikolog"><i class="bi bi-calendar2-heart"></i><span>Jadwal Konsultasi</span></a></li>
        <li><a href="?Views=layananPsikolog"><i class="bi bi-house-heart"></i><span>Layanan</span></a></li>
        <li><a href="/logout"><i class="bi bi-box-arrow-in-left"></i><span>Logout</span></a></li>
      </ul>
    </div>

    <div class="content">
      <?php 
        // Secure dynamic file inclusion with a default fallback
        $allowed_pages = ['profilePsikolog', 'jadwalPsikolog', 'layananPsikolog']; // Allowable pages
        $page = isset($_GET['Views']) ? basename($_GET['Views']) : 'profilePsikolog'; // Default to profilePsikolog

        if (in_array($page, $allowed_pages)) {
          include("$page.php");
        } else {
          echo "Page not found.";
        }
      ?>
    </div>
  </div>
</body>
<script src="<?= base_url('js/dbpsikolog.js'); ?>" defer></script>
<script src="<?= base_url('js/jquery.min.js'); ?>" defer></script>
</html>
