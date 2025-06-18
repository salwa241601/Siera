<?php
include 'db_connect.php';

// Menggunakan koneksi yang benar ($conn) untuk query
$query = mysqli_query($conn, "SELECT * FROM ruangan ORDER BY hari_tanggal ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status</title>
  <link rel="stylesheet" href="status.css">
</head>
<body>
  <header class="header">
    <div class="status-date">
      <h1>Status</h1>
      <p><?= date('l, d F Y') ?></p>
    </div>
    <div class="nav-icons">
      <div class="icons">
        <span class="menu">&#9776;</span>
        <span class="email">&#9993;</span>
        <span class="bell">&#128276;</span>
      </div>
      <div class="user-profile">
        <span class="username">Zarakilla</span>
        <div class="avatar">ZR</div>
        <span class="dropdown">&#9662;</span>
      </div>
    </div>
  </header>

  <main>
    <h2 class="title">Status</h2>
    <div class="search-box">
      <input type="text" placeholder="Cari Ruangan">
      <button class="search-button">🔍</button>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pinjam</th>
            <th>Waktu</th>
            <th>Ruangan</th>
            <th>Keperluan</th>
            <th>Status</th>
            <th>Invoice</th>
            <th>Catatan Admin</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($query)) {
            $tanggal = isset($row['tanggal_peminjaman']) ? date('d M Y', strtotime($row['tanggal_peminjaman'])) : '-';
            $jam_mulai = $row['jam_mulai'] ?? '-';
            $jam_selesai = $row['jam_selesai'] ?? '-';
            $ruangan = $row['nama_ruangan'] ?? '-';
            $keperluan = $row['keperluan'] ?? '-';
            $status = isset($row['status']) ? ucfirst(strtolower(trim($row['status']))) : 'Diproses';
            $invoice = $row['invoice'] ?? null;
            $catatan = $row['catatan_admin'] ?? '-';

            // Penentuan class badge berdasarkan status
            switch (strtolower($status)) {
              case 'disetujui':
                $badgeClass = 'approved';
                break;
              case 'ditolak':
                $badgeClass = 'rejected';
                break;
              default:
                $badgeClass = 'pending';
                break;
            }

            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$tanggal}</td>";
            echo "<td>{$jam_mulai} - {$jam_selesai}</td>";
            echo "<td>{$ruangan}</td>";
            echo "<td>{$keperluan}</td>";
            echo "<td><span class='badge {$badgeClass}'>{$status}</span></td>";
            echo "<td>" . ($invoice ? "<a href='invoices/{$invoice}'>Lihat/Download</a>" : "-") . "</td>";
            echo "<td>{$catatan}</td>";
            echo "</tr>";
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer>
    <div class="footer-content">
      <div class="kontak">
        <p>📞 +62 8123456789</p>
        <p>✉ siera@ub.ac.id</p>
      </div>
      <div class="sosial">
        <p>📷 siera.siruangan</p>
      </div>
    </div>
    <div class="copyright">
      <p>Copyright (c) Siera Teams 2025. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>