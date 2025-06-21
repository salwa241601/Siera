<?php
// Include the database connection
include 'database.php'; // Make sure the path to database.php is correct

// If a search term is provided, filter the rooms based on the search
$search_query = '';
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search_term = $_POST['search'];
    $search_query = " WHERE nama_peminjam LIKE '%$search_term%' OR nama_ruangan LIKE '%$search_term%' OR keperluan LIKE '%$search_term%'";
}

// Use prepared statement for secure query
$query = $conn->prepare("SELECT * FROM peminjaman" . $search_query . " ORDER BY tanggal_peminjaman ASC");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status</title>
  <link rel="stylesheet" href="assets/css/status.css">
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
    <!-- Search Box -->
    <div class="search-box">
      <form method="POST">
        <input type="text" name="search" placeholder="Cari Ruangan" value="<?= isset($search_term) ? $search_term : '' ?>">
        <button type="submit" class="search-button">🔍</button>
      </form>
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
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($row = $result->fetch_assoc()) {
            // Menentukan status dan badge berdasarkan status dari database
            $status_raw = strtolower(trim($row['status']));
            $status = '';
            $badgeClass = '';

            switch ($status_raw) {
                case 'disetujui':
                    $status = 'Disetujui';
                    $badgeClass = 'approved';
                    break;
                case 'ditolak':
                    $status = 'Ditolak';
                    $badgeClass = 'rejected';
                    break;
                case 'pengajuan':
                    $status = 'Pengajuan';
                    $badgeClass = 'pending';
                    break;
                default:
                    $status = 'Diproses';
                    $badgeClass = 'pending';
                    break;
            }

            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . date('d M Y', strtotime($row['tanggal_peminjaman'])) . "</td>";
            echo "<td>{$row['jam_mulai']} - {$row['jam_selesai']}</td>";
            echo "<td>{$row['nama_ruangan']}</td>";
            echo "<td>{$row['keperluan']}</td>";
            echo "<td><span class='badge {$badgeClass}'>{$status}</span></td>";

            // Kolom Invoice hanya menampilkan link jika statusnya 'Disetujui'
            echo "<td>";
            if ($status_raw == 'disetujui') {
                echo "<a href='invoice.php?id={$row['id']}'>Lihat/Download</a>";
            } else {
                echo "-";
            }
            echo "</td>";

            echo "<td>{$row['keterangan']}</td>";
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
