<?php
// Sertakan koneksi ke database
include('database.php');

// Query untuk mendapatkan daftar peminjaman yang sedang diproses
$query = "SELECT p.nama_peminjam, p.tanggal_peminjaman, p.jam_mulai, p.jam_selesai 
          FROM peminjaman p
          WHERE p.status = 'dalam_proses' OR p.status = 'disetujui'";
$result = mysqli_query($conn, $query);

// Cek jika query berhasil dijalankan
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Cek apakah ada data yang ditemukan
if (mysqli_num_rows($result) == 0) {
    $noDataMessage = "Belum ada ruangan yang dipinjam.";
} else {
    $noDataMessage = ""; // Jika ada data, pesan ini tidak ditampilkan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Dipinjam</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/daftarruangandipinjam.css">
</head>
<body>
    
    <header class="main-header">
        <div class="left-header">
            <div class="header-title">
                <h2>Daftar Ruangan Dipinjam</h2>
                <p><?php echo date("l, d F Y"); ?></p>
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

        <?php if ($noDataMessage): ?>
            <p><?php echo $noDataMessage; ?></p>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <div class="info">
                        <p>Nama Peminjam : <?php echo $row['nama_peminjam']; ?></p>
                        <p>Hari, Tanggal : <?php echo date('l, d F Y', strtotime($row['tanggal_peminjaman'])); ?></p> 
                        <p>Jam Penggunaan Ruangan : <?php echo date('H:i', strtotime($row['jam_mulai'])); ?> - 
                            <?php echo date('H:i', strtotime($row['jam_selesai'])); ?>
                        </p> 
                        <div class="buttons">
                            <button class="btn status" onclick="window.location.href='status.php'">Status</button>
                            <button class="btn reschedule">Reschedule</button>
                            <button class="btn batalkan">Batalkan</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
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
