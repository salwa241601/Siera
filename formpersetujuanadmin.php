<?php
include('db_connect.php');

// Mendapatkan data peminjaman ruangan yang statusnya 'booked'
$sql = "SELECT * FROM ruangan WHERE status = 'booked'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setujui'])) {
        // Jika disetujui
        $id = $_POST['id'];
        $sql_update = "UPDATE ruangan SET status = 'Disetujui' WHERE id = $id";
        if ($conn->query($sql_update) === TRUE) {
            // Setelah berhasil disetujui, arahkan ke halaman invoice
            header("Location: invoice.php?id=$id");
            exit();
        }
    } elseif (isset($_POST['batalkan'])) {
        // Jika dibatalkan
        $id = $_POST['id'];
        $sql_update = "UPDATE ruangan SET status = 'Dibatalkan' WHERE id = $id";
        $conn->query($sql_update);
    }
    header("Location: formpersetujuanadmin.php"); // Refresh halaman setelah aksi
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Persetujuan Admin</title>
    <link rel="stylesheet" href="formpersetujuanadmin.css">
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
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<div class='thumbnail'><img src='/gambar/gambarcontohruangan1.png' alt='Gambar Ruangan'></div>";
                echo "<div class='info'>";
                echo "<p>Nama Peminjam : " . $row["peminjam"] . "</p>";
                echo "<p>Ruangan Yang Dipinjam : " . $row["name"] . "</p>";
                echo "<p>Hari, Tanggal : " . $row["hari_tanggal"] . "</p>";
                echo "<p>Jam Penggunaan Ruangan : " . $row["jam_penggunaan"] . "</p>";
                echo "<p>No Telepon Peminjam : " . $row["no_telepon"] . "</p>";
                echo "<p>Email Peminjam : " . $row["email"] . "</p>";
                echo "<p>Keterangan Penggunaan Ruangan : " . $row["keterangan"] . "</p>";
                echo "<div class='buttons'>";
                echo "<form method='POST' action=''>"; 
                echo "<input type='hidden' name='id' value='" . $row['id'] . "' />";
                echo "<button type='submit' name='setujui' class='btn reschedule'>Setujui</button>";
                echo "<button type='submit' name='batalkan' class='btn batalkan'>Batalkan</button>";
                echo "</form>";
                
                // Setelah disetujui, link untuk melihat invoice
                if ($row['status'] == 'Disetujui') {
                    echo "<a href='invoice.php?id=" . $row['id'] . "' class='view-invoice'>Lihat Invoice</a>";
                }
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
