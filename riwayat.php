<?php
// Include the database connection file
include 'database.php';

// Fetch data from the database using object-oriented approach
$query = $conn->query("SELECT * FROM peminjaman ORDER BY tanggal_peminjaman DESC");

// Check if the query was successful
if (!$query) {
    die("Query failed: " . $conn->error); // Show the error if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman Ruangan</title>
  <link rel="stylesheet" href="assets/css/riwayat.css">
</head>
<body>

<header class="main-header">
  <div class="left-header">
    <div class="header-title">
      <h2>Riwayat Peminjaman Ruangan</h2>
      <p><?php echo date('l, d F Y'); ?></p>
    </div>
  </div>
  <div class="right-header">
    <img src="/gambar/gambargaris3.png" alt="Menu" />
    <img src="/gambar/gambarsurat.png" alt="Mail" />
    <img src="/gambar/gambarlonceng.png" alt="Bell" />
    <span class="username">Zarakilla</span>
    <div class="avatar-circle">ZR</div>
    <a href="profil.html" class="dropdown-link"><span class="dropdown-icon">▾</span></a>
  </div>
</header>

<div class="container">
  <div class="title">
    <h2>Riwayat Ruangan <br> Yang Pernah Dipinjam</h2>
  </div>

  <?php
  // Check if there are any records in the query result
  if ($query->num_rows > 0) {
    // Loop through each record and display it
    while ($row = $query->fetch_assoc()) {
  ?>
    <div class="card">
      <div class="thumbnail">
        <!-- Sample image for room, can be dynamically changed -->
        <img src="/gambar/gambarcontohruangan1.png" alt="Gambar Ruangan">
      </div>
      <div class="info">
        <p>Nama Peminjam : <?= htmlspecialchars($row['nama_peminjam']); ?></p>
        <p>Ruangan Yang Dipinjam : <?= htmlspecialchars($row['nama_ruangan']); ?></p>
        <p>Hari, Tanggal : <?= date('l, d F Y', strtotime($row['tanggal_peminjaman'])); ?></p>
        <p>Jam Penggunaan Ruangan : <?= htmlspecialchars($row['jam_mulai']); ?> - <?= htmlspecialchars($row['jam_selesai']); ?></p>
        <div class="buttons">
          <button class="btn reschedule" onclick="window.location.href='form_pjm.html'">Pinjam Lagi</button>
          <button class="btn status" onclick="window.location.href='status.html'">Status</button>
        </div>
      </div>
    </div>
  <?php
    }
  } else {
    // Display a message if no records are found
    echo "<p>Tidak ada data peminjaman.</p>";
  }
  ?>
</div>

<footer class="main-footer">
  <div class="footer-content">
    <div class="footer-section contact">
      <h3>Kontak</h3>
      <p><img src="/gambar/gambartelpon.png" class="footer-icon"> +62 8123456789</p>
      <p><img src="/gambar/gambaremail.png" class="footer-icon"> siera@ub.ac.id</p>
    </div>
    <div class="footer-section social-media">
      <h3>Sosial Media</h3>
      <p><img src="/gambar/gambarig.png" class="footer-icon"> siera.siruangan</p>
    </div>
  </div>
</footer>

<div class="copyright">
  <p>Copyright (c) Siera Teams 2025. All rights reserved.</p>
</div>

</body>
</html>
