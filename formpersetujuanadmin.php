<?php
include('database.php'); // Ensure this includes your database connection

// Mendapatkan data peminjaman yang statusnya 'pengajuan'
$sql = "SELECT * FROM peminjaman WHERE status = 'pengajuan'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setujui']) || isset($_POST['batalkan'])) {
        $id = $_POST['id'];
        $newStatus = isset($_POST['setujui']) ? 'disetujui' : 'ditolak';

        // Use prepared statement to prevent SQL injection
        $sql_update = $conn->prepare("UPDATE peminjaman SET status = ? WHERE id = ?");
        $sql_update->bind_param("si", $newStatus, $id); // 's' for string, 'i' for integer

        if ($sql_update->execute()) {
            // After successful update, redirect to the same page
            header("Location: formpersetujuanadmin.php");
            exit();
        } else {
            echo "Error: " . $sql_update->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Persetujuan Admin</title>
    <link rel="stylesheet" href="assets/css/formpersetujuanadmin.css">
</head>
<body>
    <header class="main-header">
        <div class="left-header">
            <div class="header-title">
                <h2>Form Persetujuan Admin</h2>
                <p>Persetujuan peminjaman ruangan</p>
            </div>
        </div>
    </header>

    <div class="container">
        <?php
        // Menampilkan data peminjaman
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<div class='thumbnail'><img src='/gambar/gambarcontohruangan1.png' alt='Gambar Ruangan'></div>";
                echo "<div class='info'>";
                echo "<p>Nama Peminjam : " . $row["nama_peminjam"] . "</p>";
                echo "<p>Nama Ruangan : " . $row["nama_ruangan"] . "</p>";
                echo "<p>Ruangan : " . $row["ruangan"] . "</p>";
                echo "<p>Tanggal Peminjaman : " . $row["tanggal_peminjaman"] . "</p>";
                echo "<p>Jam Mulai : " . $row["jam_mulai"] . "</p>";
                echo "<p>Jam Selesai : " . $row["jam_selesai"] . "</p>";
                echo "<p>No Telepon Peminjam : " . $row["no_telepon"] . "</p>";
                echo "<p>Email Peminjam : " . $row["email"] . "</p>";
                echo "<p>Keterangan : " . $row["keterangan"] . "</p>";
                echo "<div class='buttons'>";
                echo "<form method='POST' action=''>"; 
                echo "<input type='hidden' name='id' value='" . $row['id'] . "' />";
                echo "<button type='submit' name='setujui' class='btn reschedule'>Setujui</button>";
                echo "<button type='submit' name='batalkan' class='btn batalkan'>Batalkan</button>";
                echo "</form>";
                echo "</div>";
                echo "</div></div>";
            }
        } else {
            echo "<p>Belum ada peminjaman ruangan yang menunggu persetujuan.</p>";
        }

        $conn->close();
        ?>
    </div>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About</h3>
                <p>Persetujuan peminjaman ruangan untuk kegiatan yang akan dilakukan di Gedung.</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Sistem Informasi Ruangan</p>
        </div>
    </footer>

</body>
</html>
