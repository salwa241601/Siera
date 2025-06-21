<?php
include 'database.php';  // Memastikan file database.php di-include dengan benar

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Ambil bulan dan tahun sekarang
$bulan = date('m');
$tahun = date('Y');

// Hari pertama bulan ini
$first_day = mktime(0, 0, 0, $bulan, 1, $tahun);

// Total hari dalam bulan ini
$total_days = date('t', $first_day);

// Hari dalam minggu (0 = Minggu, 1 = Senin, ...)
$start_day = date('N', $first_day); // 1 = Senin

// Ambil semua peminjaman di bulan ini
$sql = "SELECT * FROM peminjaman WHERE MONTH(tanggal_peminjaman) = $bulan AND YEAR(tanggal_peminjaman) = $tahun";
$result = $conn->query($sql);  // Gunakan $conn untuk menjalankan query

$peminjaman = [];
while ($row = $result->fetch_assoc()) {  // Gunakan fetch_assoc() untuk mengambil data
    $tanggal = date('j', strtotime($row['tanggal_peminjaman']));
    $peminjaman[$tanggal][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Kalender Peminjaman Ruangan</title>
  <link rel="stylesheet" href="assets/css/kalender.css" />
</head>
<body>
<section class="calendar-wrapper">
  <div class="calendar-header">
    <div class="nav-left">
      <h2>Kalender Peminjaman Ruangan</h2>
      <p><?= date('l, d F Y') ?></p>
    </div>
    <div class="nav-right">
      <i class="fas fa-bars"></i>
      <i class="fas fa-bell"></i>
      <div class="profile">
        <span class="name">Zaraakila</span>
        <div class="avatar">ZR</div>
        <i class="fas fa-chevron-down"></i>
      </div>
    </div>
  </div>

  <div class="bulan-nav">
    <span><?= date('F', $first_day) ?></span>
  </div>

  <table class="calendar-table">
    <thead>
      <tr>
        <th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jum'at</th><th>Sabtu</th><th>Minggu</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $day = 1;
      $current_cell = 1;
      echo "<tr>";

      // Kosongkan cell sebelum hari pertama
      for ($i = 1; $i < $start_day; $i++) {
          echo "<td class='disable'></td>";
          $current_cell++;
      }

      while ($day <= $total_days) {
          echo "<td";
          if (isset($peminjaman[$day])) echo " class='schedule'";
          echo ">$day";

          if (isset($peminjaman[$day])) {
              foreach ($peminjaman[$day] as $pinjam) {
                  echo "<div class='info'>{$pinjam['nama_ruangan']}<br>" . htmlspecialchars($pinjam['keperluan']) . "</div>";
              }
          }

          echo "</td>";
          if ($current_cell % 7 == 0) echo "</tr><tr>";
          $day++;
          $current_cell++;
      }

      // Kosongkan sisa sel terakhir
      while ($current_cell % 7 != 1) {
          echo "<td class='disable'></td>";
          $current_cell++;
      }

      echo "</tr>";
      ?>
    </tbody>
  </table>

  <footer class="footer">
    <div class="footer-content">
      <div class="footer-column">
        <p class="footer-title">Kontak</p>
        <p><i class="fas fa-phone"></i> +62 8123456789</p>
        <p><i class="fas fa-envelope"></i> siera@ub.ac.id</p>
      </div>
      <div class="footer-column">
        <p class="footer-title">Sosial Media</p>
        <p><i class="fab fa-instagram"></i> @siera.siruangan</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; Siera Teams 2025. All rights reserved.</p>
    </div>
  </footer>
</section>
</body>
</html>
