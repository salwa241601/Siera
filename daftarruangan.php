<?php
// Sertakan file koneksi ke database
include('db_connect.php');

// Query untuk mengambil daftar ruangan dari database
$query = "SELECT * FROM ruangan";
$result = mysqli_query($conn, $query);

// Cek apakah ada data ruangan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan</title>
    <link rel="stylesheet" href="daftarruangan.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="left-header">
            <div class="header-title">
                <h2>Daftar Ruangan</h2>
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

    <div class="room-listing-section">
        <h2 class="section-title-new">Daftar Ruangan <br>Fakultas Ilmu Komputer</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="room-rows-container">
                <!-- Loop untuk menampilkan semua ruangan -->
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                        $room_name = $row['name'];
                        $capacity = $row['capacity'];
                        $location = $row['location'];
                        $status = $row['status'];
                        $image_url = $row['image_url']; // Misalnya kolom image_url berisi path gambar ruangan
                    ?>
                    <div class="room-item-card">
                        <img src="<?php echo $image_url; ?>" alt="<?php echo $room_name; ?>" class="room-item-image">
                        <div class="room-item-details">
                            <p class="room-item-name"><?php echo $room_name; ?></p>
                            <p class="room-item-capacity">Kapasitas: <?php echo $capacity; ?> orang</p>
                            <p class="room-item-location">Lokasi: <?php echo $location; ?></p>
                            <p class="room-item-status <?php echo ($status == 'available' ? 'available' : 'booked'); ?>">
                                Status: <?php echo ucfirst($status); ?>
                            </p>

                            <!-- Tombol pesan hanya akan tampil jika statusnya 'available' -->
                            <?php if ($status == 'available'): ?>
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
