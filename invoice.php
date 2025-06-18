<?php
include('db_connect.php');

// Mendapatkan ID dari parameter URL
$id = $_GET['id']; // Mengambil ID yang dikirimkan melalui URL

// Mengambil data peminjaman berdasarkan ID
$sql_invoice = "SELECT * FROM ruangan WHERE id = $id AND status = 'Disetujui'"; // Pastikan hanya menampilkan yang sudah disetujui
$result = $conn->query($sql_invoice);

// Jika data tidak ditemukan
if ($result->num_rows == 0) {
    $no_invoice = true; // Menandakan bahwa tidak ada invoice yang ditemukan
} else {
    $row = $result->fetch_assoc();
    $no_invoice = false; // Ada invoice yang ditemukan
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="invoice.css">
</head>
<body>
    <div class="invoice-wrapper">
        <!-- Header Section -->
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
            <!-- If no invoice is found, display this message -->
            <div class="no-invoice">
                <h3>Belum ada invoice yang disetujui</h3>
                <p>Belum ada peminjaman ruangan yang disetujui oleh admin.</p>
            </div>
        <?php else: ?>
            <!-- Greeting Box -->
            <div class="greeting-box">
                <h3>Terima kasih telah melakukan peminjaman ruangan!</h3>
                <p>Berikut adalah detail dari peminjaman yang telah Anda buat:</p>
            </div>

            <!-- Customer Information Section -->
            <div class="info-box">
                <h3>Informasi Peminjam</h3>
                <div class="info-group">
                    <p><strong>Nama:</strong> <?php echo $row['peminjam']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <p><strong>Telepon:</strong> <?php echo $row['no_telepon']; ?></p>
                </div>
            </div>

            <!-- Booking Information Section -->
            <div class="info-box">
                <h3>Detail Pemesanan Ruangan</h3>
                <div class="info-group">
                    <p><strong>Ruangan:</strong> <?php echo $row['name']; ?></p>
                    <p><strong>Tanggal:</strong> <?php echo $row['hari_tanggal']; ?></p>
                    <p><strong>Jam Penggunaan:</strong> <?php echo $row['jam_penggunaan']; ?></p>
                </div>
            </div>

            <!-- Status Box -->
            <div class="status-box">
                <p>Status Peminjaman: <strong>Disetujui</strong></p>
            </div>
        <?php endif; ?>

        <!-- Footer Section -->
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
