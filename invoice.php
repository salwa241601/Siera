<?php
include('database.php');

// Mengecek apakah parameter 'id' ada dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; // Mengambil ID dari URL

    // Mengambil data peminjaman berdasarkan ID, hanya yang statusnya 'Disetujui'
    $stmt = $conn->prepare("SELECT * FROM peminjaman WHERE id = ? AND status = 'disetujui'");
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data tidak ditemukan
    if ($result->num_rows == 0) {
        $no_invoice = true; // Menandakan bahwa tidak ada invoice yang ditemukan
    } else {
        $row = $result->fetch_assoc();
        $no_invoice = false; // Ada invoice yang ditemukan
    }
} else {
    // Jika 'id' tidak ada dalam URL
    $no_invoice = true; // Menandakan bahwa ID tidak ditemukan
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="assets/css/invoice.css">
</head>
<body>
    <div class="invoice-wrapper">
        <header class="header">
            <div class="nav-left">
                <h2>Invoice Peminjaman Ruangan</h2>
                <p>Tanggal: <?php echo date('d F Y'); ?></p>
            </div>
            <div class="nav-right">
                <div class="profile">
                    <div class="avatar">A</div>
                    <p>Admin</p>
                </div>
            </div>
        </header>

        <?php if ($no_invoice): ?>
            <div class="no-invoice">
                <h3>Belum ada invoice yang disetujui</h3>
                <p>Belum ada peminjaman ruangan yang disetujui oleh admin.</p>
            </div>
        <?php else: ?>
            <div class="greeting-box">
                <h3>Terima kasih telah melakukan peminjaman ruangan!</h3>
                <p>Berikut adalah detail dari peminjaman yang telah Anda buat:</p>
            </div>

            <div class="info-box">
                <h3>Informasi Peminjam</h3>
                <div class="info-group">
                    <p><strong>Nama:</strong> <?php echo $row['nama_peminjam']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <p><strong>Telepon:</strong> <?php echo $row['no_telepon']; ?></p>
                </div>
            </div>

            <div class="info-box">
                <h3>Detail Pemesanan Ruangan</h3>
                <div class="info-group">
                    <p><strong>Ruangan:</strong> <?php echo $row['nama_ruangan']; ?></p>
                    <p><strong>Tanggal:</strong> <?php echo $row['tanggal_peminjaman']; ?></p>
                    <p><strong>Jam Penggunaan:</strong> <?php echo $row['jam_mulai']; ?></p>
                </div>
            </div>

            <div class="status-box">
                <p>Status Peminjaman: <strong>Disetujui</strong></p>
            </div>
        <?php endif; ?>

        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2025 Sistem Informasi Peminjaman Ruangan</p>
            </div>
            <div class="copyright">
                <p>All Rights Reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
