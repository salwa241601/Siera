<?php
// Sertakan koneksi ke database
include('db_connect.php');

// Query untuk mendapatkan daftar ruangan yang sedang dipinjam
$query = "SELECT name, image_url, peminjam, hari_tanggal, jam_penggunaan FROM ruangan WHERE status = 'booked'";
$result = mysqli_query($conn, $query);

// Cek jika query berhasil dijalankan
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Dipinjam</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="daftarruangandipinjam.css">
</head>
<body>
    
    <header class="main-header">
        <div class="left-header">
            <div class="header-title">
                <h2>Daftar Ruangan Dipinjam</h2>
                <p>Monday, 19 May 2025</p>
            </div>
        </div>
        <div class="right-header">
            <img src="/gambar/gambargaris3.png" alt="Mail" />
            <img src="/gambar/gambarsurat.png" alt="Mail" />
            <img src="/gambar/gambarlonceng.png" alt="Bell" />
            <span class="username">Zarakilla</span>
            <div class="avatar-circle">ZR</div>
            <a href="profil.html" class="dropdown-link"><span class="dropdown-icon">▾</span></a>
        </div>
    </header>

    <div class="container">
        <div class="title">
            <h2>Daftar Ruangan<br>Yang Sedang Dipinjam</h2>
        </div>

            <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <div class="thumbnail">
                    <img src="<?php echo $row['image_url']; ?>" alt="Gambar Ruangan">
                </div>
                <div class="info">
                    <p>Nama Peminjam : <?php echo $row['peminjam']; ?></p>
                    <p>Ruangan Yang Dipinjam : <?php echo $row['name']; ?></p>
                    <p>Hari, Tanggal : <?php echo date('l, d F Y', strtotime($row['hari_tanggal'])); ?></p> <!-- Tanggal dinamis -->
                    <p>Jam Penggunaan Ruangan : <?php echo date('H:i', strtotime($row['jam_penggunaan'])); ?> - <?php echo date('H:i', strtotime($row['jam_penggunaan'] . ' + 1 hour')); ?></p> <!-- Jam dinamis (dengan estimasi durasi 1 jam) -->
                    <div class="buttons">
                        <button class="btn status" onclick="window.location.href='status.html'">Status</button>
                        <button class="btn reschedule">Reschedule</button>
                        <button class="btn batalkan">Batalkan</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada ruangan yang dipinjam.</p>
    <?php endif; ?>
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

    <?php
    // Menutup koneksi database
    mysqli_close($conn);
    ?>

</body>
</html>
