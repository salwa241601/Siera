<?php
// Sertakan file koneksi ke database
include('database.php');

// Query untuk mengambil daftar ruangan dari database
$query = "SELECT * FROM peminjaman"; // Ganti dengan tabel yang benar jika diperlukan
$result = mysqli_query($conn, $query);

// Cek apakah ada data ruangan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan</title>
    <link rel="stylesheet" href="assets/css/daftarruangan.css">
</head>
<body>
    <header class="main-header">
        <div class="left-header">
            <div class="header-title">
                <h2>Daftar Ruangan</h2>
                <p><?php echo date("l, d F Y"); ?></p>
            </div>
        </div>
        <div class="right-header">
            <a href="dashboard.php">Dashboard</a>
            <span class="username"><?= $username; ?></span>
        </div>
    </header>

    <div class="room-listing-section">
        <h2 class="section-title-new">Daftar Ruangan</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="room-rows-container">
                <!-- Loop untuk menampilkan semua ruangan -->
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="room-item-card">
                        <img src="<?php echo $row['foto']; ?>" alt="<?php echo $row['nama_ruangan']; ?>" class="room-item-image">
                        <div class="room-item-details">
                            <p class="room-item-name"><?php echo $row['nama_ruangan']; ?></p>
                            <p class="room-item-capacity">Kapasitas: <?php echo $row['kapasitas']; ?> orang</p>
                            <p class="room-item-location">Lokasi: <?php echo $row['lokasi']; ?></p>
                            <p class="room-item-status <?php echo ($row['status'] == 'available' ? 'available' : 'booked'); ?>">
                                Status: <?php echo ucfirst($row['status']); ?>
                            </p>

                            <!-- Tombol pesan hanya akan tampil jika statusnya 'available' -->
                            <?php if ($row['status'] == 'available'): ?>
                                <button class="pesan-button available-button" onclick="window.location.href='form_pjm.php'">Pesan</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Data ruangan tidak ditemukan.</p>
        <?php endif; ?>

    </div>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section contact">
                <h3>Kontak</h3>
                <p>📞 +62 8123456789</p>
                <p>✉️ siera@ub.ac.id</p>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright (c) Siera Teams 2025. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>
