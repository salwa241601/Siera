<?php
session_start();
include('database.php');

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data user dari session
$user_id = $_SESSION['user'];

// Mengambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();

// Menyimpan nama pengguna untuk ditampilkan di halaman
$username = $user['name'];

// Ambil data statistik peminjaman ruangan dari database
$pengajuan_query = "SELECT COUNT(*) AS pengajuan FROM peminjaman WHERE status = 'pengajuan'";
$pengajuan_result = $conn->query($pengajuan_query);
$pengajuan = $pengajuan_result->fetch_assoc()['pengajuan'];

$proses_query = "SELECT COUNT(*) AS dalam_proses FROM peminjaman WHERE status = 'dalam_proses'";
$proses_result = $conn->query($proses_query);
$proses = $proses_result->fetch_assoc()['dalam_proses'];

$disetujui_query = "SELECT COUNT(*) AS disetujui FROM peminjaman WHERE status = 'disetujui'";
$disetujui_result = $conn->query($disetujui_query);
$disetujui = $disetujui_result->fetch_assoc()['disetujui'];

$selesai_query = "SELECT COUNT(*) AS selesai FROM peminjaman WHERE status = 'selesai'";
$selesai_result = $conn->query($selesai_query);
$selesai = $selesai_result->fetch_assoc()['selesai'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SIERA Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
 <header class="main-header">
  <div class="left-header">
    <div class="logo-circle">
        <img src="assets/img/logo.png" alt="Logo" class="logo-img">
    </div>
    <div class="logo-text">
      <h1>SIERA</h1>
      <p>Sistem Peminjaman Ruangan</p>
    </div>
    <div class="header-title">
      <h2>Dashboard</h2>
      <p>
        <?php echo date('l, d F Y'); ?>
      </p>
    </div>
  </div>
  <div class="right-header">
    <span class="material-icons">💌</span>
    <span class="material-icons">🔔</span>
    <span class="username"><?= $username; ?></span>
    <div class="avatar-circle"><?= strtoupper(substr($username, 0, 2)); ?></div>
    <a href="profile.php" class="dropdown-link"><span class="dropdown-icon">▾</span></a>
  </div>
</header>

 <div class="layout">
  <aside class="sidebar">
    <div class="sidebar-top">
        <button class="ajukan-btn" onclick="window.location.href='formpeminjaman.php'">
            <span>Ajukan<br />Peminjaman<br />Ruangan</span>
            <div class="plus-circle">+</div>
        </button>
    </div>

   <nav class="sidebar-menu">
    <ul>
     <li><a href="home.php">Home</a></li>
     <li><a href="daftarruangan.php">Daftar<br />Ruangan</a></li>
     <li><a href="daftarruangandipinjam.php">Daftar<br />Ruangan Dipinjam</a></li>
     <li><a href="riwayat.php">Riwayat</a></li>
     <li><a href="kalender.php">Calendar</a></li>
     <li><a href="logout.php">logout</a></li>
    </ul>
   </nav>
  </aside>

  <main class="dashboard-content">
   <div class="content-card">
    <div class="welcome-box">
     <h2>Hi, <span class="username-highlight"><?= $username; ?></span></h2>
     <p>Selamat Datang di SIERA (Sistem Peminjaman Ruangan) Fakultas Ilmu Komputer</p>
    </div>

    <div class="overview">
     <p>Overview</p>
     <div class="status-cards">
      <div class="status-card">
       <p>Pengajuan</p>
       <h3><?= $pengajuan; ?></h3>
      </div>
      <div class="status-card">
       <p>Dalam Proses</p>
       <h3><?= $proses; ?></h3>
      </div>
      <div class="status-card">
       <p>Disetujui</p>
       <h3><?= $disetujui; ?></h3>
      </div>
      <div class="status-card">
       <p>Selesai</p>
       <h3><?= $selesai; ?></h3>
      </div>
     </div>
    </div>
   </div>

   <!-- Bagian pencarian -->
<div class="search-container">
  <div class="search-tabs-container">
    <div class="search-tabs-card">
      <div class="tab-item active">Kelas</div>
      <div class="separator"></div>
      <div class="tab-item">Aula</div>
      <div class="separator"></div>
      <div class="tab-item">Lapangan</div>
      <div class="separator"></div>
      <div class="tab-item">Lab</div>
      <div class="separator"></div>
      <div class="tab-item">Theater</div>
    </div>
  </div>

  <div class="search-box">
    <h3>Apa Yang Sedang Dicari?</h3>
    <form action="search_results.php" method="POST">
      <div class="search-fields">
        <div class="field">
          <label>Ruangan:</label>
          <input type="text" name="ruangan" placeholder="Masukkan ruangan" required />
        </div>
        <div class="field">
          <label>Tanggal Pinjam:</label>
          <input type="date" name="tanggal_pinjam" required />
        </div>
        <div class="field">
          <label>Jam Pinjam:</label>
          <input type="time" name="jam_pinjam" required />
        </div>
        <div class="field">
          <label>Kapasitas:</label>
          <input type="number" name="kapasitas" required />
        </div>
      </div>
      <button type="submit" class="search-button">Cari</button>
    </form>
  </div>
</div>

   <div class="room-section">
    <h2 class="section-title">Ruangan</h2>
    <div class="room-grid">
     <div class="room-card">
      <div class="room-image"></div>
      <p class="room-name">Gedung F</p>
     </div>
     <div class="room-card">
      <div class="room-image"></div>
      <p class="room-name">GKM<br><span class="subtext">(Gedung Kreativitas Mahasiswa)</span></p>
     </div>
     <div class="room-card">
      <div class="room-image"></div>
      <p class="room-name">Theater<br>Heuristic</p>
     </div>
    </div>
   </div>
  </main>
 </div>

 <footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section contact">
            <h3>Kontak</h3>
            <p><img src="/gambar/gambartelpon.png" alt="Phone Icon" class="footer-icon"> +62 8123456789</p>
            <p><img src="/gambar/gambaremail.png" alt="Mail Icon" class="footer-icon"> siera@ub.ac.id</p>
        </div>
        <div class="footer-section social-media">
            <h3>Sosial Media</h3>
            <p><img src="/gambar/gambarig.png" alt="Instagram Icon" class="footer-icon"> siera.siruangan</p>
        </div>
    </div>
</footer>

 <div class="copyright">
        <p>Copyright (c) Siera Teams 2025. All rights reserved.</p>
    </div>
</body>
</html>
