<?php
// Database connection
$host = '127.0.0.1';
$username = 'root';
$password = '';  // Update with your database password
$dbname = 'siera';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch rooms with status 'disetujui' or 'available'
$sql = "SELECT * FROM ruangan WHERE status IN ('disetujui', 'available')";
$result = $conn->query($sql);

// Get current date
$currentDate = date("l, d F Y");

// Admin name (hardcoded in this example)
$adminName = "Admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="statusadmin.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <h1>Dashboard</h1>
            <p><?php echo $currentDate; ?></p>
        </header>

        <!-- Greeting Section -->
        <section class="greeting">
            <h2>Hallo, <?php echo $adminName; ?></h2>
            <p>Selamat datang di administrator ruang peminjaman!</p>
        </section>

        <!-- Reservation Cards -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <section class="card">
                    <div class="image">
                        <img src="<?php echo $row['image_url']; ?>" alt="Room Image">
                    </div>
                    <div class="details">
                        <p><strong>Nama Peminjam :</strong> <?php echo $row['peminjam'] ?: 'TBA'; ?></p>
                        <p><strong>Ruangan :</strong> <?php echo $row['name']; ?></p>
                        <p><strong>Hari dan Tanggal :</strong> <?php echo $row['hari_tanggal']; ?></p>
                        <p><strong>Jam Penggunaan :</strong> <?php echo $row['jam_penggunaan']; ?> - <?php echo $row['jam_selesai']; ?></p>
                        <p><strong>No Telepon :</strong> <?php echo $row['no_telepon']; ?></p>
                        <p><strong>Email :</strong> <?php echo $row['email']; ?></p>
                        <p><strong>Keterangan :</strong> <?php echo $row['keterangan'] ?: 'No additional info.'; ?></p>
                    </div>
                    <div class="buttons">
                        <button class="btn detail">Detail</button>
                        <button class="btn approve">Setujui</button>
                        <button class="btn cancel">Batalkan</button>
                    </div>
                </section>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No rooms found or available.</p>
        <?php endif; ?>
    </div>
    
    <?php $conn->close(); ?>
</body>
</html>
