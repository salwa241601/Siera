<?php
include('database.php'); // Memanggil file konfigurasi database

// Query untuk mengambil data ruangan yang statusnya 'booked'
$query = "SELECT * FROM ruangan WHERE status = 'booked'";
$result = mysqli_query($conn, $query);

// Mengecek apakah ada data
if ($result->num_rows > 0) {
    $ruangan = [];
    while ($row = $result->fetch_assoc()) {
        $ruangan[] = $row;
    }
} else {
    $ruangan = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard – Peminjaman Ruangan</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-+0sVnZ6E9GfsPShwRor1C3psBz/9xENnABQpR1x+YzFXeV1+3eQNZZlwOR0+jF+qkE/sDdZfPGvUy5eE0ZQ3yg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>

  <header>
    <div class="header-left">
      <h1>Dashboard</h1>
      <div class="date"><?php echo date('l, d F Y'); ?></div>
    </div>
    <div class="header-right">
      <i class="fas fa-bars"></i>
      <i class="fas fa-envelope"></i>
      <i class="fas fa-bell"></i>
      <span class="username">Zarakilla</span>
      <div class="avatar">ZR</div>
      <i class="fas fa-chevron-down"></i>
      <li><a href="logout.php">logout</a></li>

      <!-- Link Tambah Ruangan -->
      <a href="tambahruangan.php" class="btn btn-add-room">Tambah Ruangan</a>
    </div>
  </header>

  <div class="container">
    <section class="greeting-box">
      <h2>Hallo, Admin</h2>
      <p>Selamat datang di administrator ruang peminjaman!</p>
    </section>

    <section class="cards-grid">
      <?php foreach ($ruangan as $ruang): ?>
        <div class="card">
          <img src="<?php echo $ruang['image_url']; ?>" alt="Foto Ruangan <?php echo $ruang['name']; ?>" />
          <div class="card-body">
            <div>
              <h3><?php echo $ruang['name']; ?></h3>
              <div class="info">
                <!-- Menampilkan Nama Peminjam -->
                <p>Pesanan : <?php echo $ruang['peminjam']; ?></p> 

                <!-- Menampilkan Hari dan Tanggal -->
                <p>Tanggal : <?php echo date('l, d F Y', strtotime($ruang['hari_tanggal'])); ?></p>

                <!-- Menampilkan Jam Penggunaan -->
                <p>Waktu  : <?php echo date('H:i', strtotime($ruang['jam_penggunaan'])); ?> - <?php echo date('H:i', strtotime($ruang['jam_penggunaan'] . ' + 1 hour')); ?></p>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-booked">Terpesan</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  </div> 

  <footer class="dark-footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>Kontak</h3>
        <div class="footer-contact-item">
          <i class="fas fa-phone"></i>
          <span>+62 8123456789</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-envelope"></i>
          <span>siera@ub.ac.id</span>
        </div>
      </div>

      <div class="footer-section">
        <h3>Sosial Media</h3>
        <div class="footer-contact-item">
          <i class="fab fa-instagram"></i>
          <span>@siera.siruangan</span>
        </div>
      </div>
    </div>
  </footer>

  <div class="footer-copy-bar">
    <div class="footer-copy">
      © Copyright (c) Siera Teams 2025. All rights reserved.
    </div>
  </div>

</body>
</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>
