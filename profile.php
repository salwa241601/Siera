<?php
session_start();
include('database.php'); // Pastikan koneksi ke database sudah benar

// Cek apakah pengguna sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['user'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Pengguna tidak ditemukan.");
}

// Proses upload foto profil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    // Cek apakah file yang diupload adalah gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek ukuran gambar
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $error_message = "Sorry, your file is too large.";
    }

    // Cek apakah file adalah gambar
    if (getimagesize($_FILES["profile_picture"]["tmp_name"]) === false) {
        $error_message = "Sorry, your file is not an image.";
    }

    // Jika tidak ada error, upload gambar
    if (!isset($error_message)) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Update path gambar pada database
            $update_query = "UPDATE users SET profile_picture = '$target_file' WHERE id = '$user_id'";
            if (mysqli_query($conn, $update_query)) {
                header("Location: profile.php");
                exit();
            } else {
                $error_message = "Error updating profile picture in database.";
            }
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    }
}

// Jika form di-submit, lakukan update data pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_FILES["profile_picture"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Update data pengguna ke database
    $update_query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', gender = '$gender', address = '$address' WHERE id = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?= $user['name']; ?></title>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body>
    <header class="header">
        <span class="title">Profile</span>
        <span class="date"><?= date('l, d F Y'); ?></span>
        <div class="top-bar">
            <div class="icons">
                <span>📧</span>
                <span>🔔</span>
                <span>🔔</span>
                <span class="user-info">
                    <strong><?= $user['name']; ?></strong>
                    <div class="user-icon"><?= strtoupper(substr($user['name'], 0, 2)); ?> ▼</div>
                </span>
            </div>
        </div>
    </header>

    <main class="container">
        <section class="profile-section">
            <div class="profile-image">
                <img src="<?= $user['profile_picture'] ? $user['profile_picture'] : 'default-avatar.png'; ?>" alt="Profile">
                <div class="edit-icon">
                    <a href="#edit-picture-form">✏️</a> <!-- Tautan untuk mengedit foto -->
                </div>
            </div>

            <!-- Form untuk upload foto profil -->
            <form action="profile.php" method="post" enctype="multipart/form-data" id="edit-picture-form">
                <label for="profile_picture">Upload Foto Profil:</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" />
                <button type="submit" class="btn">Upload Foto Profil</button>
            </form>

            <button class="message-btn">💬 Message</button>
            <button class="reset-btn">Reset Password</button>
            <button class="logout-btn"><a href="logout.php">Log Out</a></button>
        </section>

        <section class="info-section">
            <h2><?= $user['name']; ?></h2>
            <div class="info-grid">
                <form method="POST">
                    <div class="info-item">
                        <label>Nama Lengkap :</label>
                        <input type="text" name="name" value="<?= $user['name']; ?>">
                    </div>
                    <div class="info-item">
                        <label>Status :</label>
                        <input type="text" name="status" value="Mahasiswa" readonly>
                    </div>
                    <div class="info-item">
                        <label>Nomor Telepon :</label>
                        <input type="text" name="phone" value="<?= $user['phone']; ?>">
                    </div>
                    <div class="info-item">
                        <label>Email :</label>
                        <input type="email" name="email" value="<?= $user['email']; ?>">
                    </div>
                    <div class="info-item">
                        <label>Jenis Kelamin :</label>
                        <input type="text" name="gender" value="<?= $user['gender']; ?>">
                    </div>
                    <div class="info-item">
                        <label>Alamat :</label>
                        <input type="text" name="address" value="<?= $user['address']; ?>">
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="save-btn">Simpan Perubahan</button>
                        <button type="button" class="cancel-btn" onclick="window.location.reload()">Batal</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div>
                <p><strong>Kontak</strong></p>
                <p>📞 +62 8123456789</p>
                <p>📧 siera@ub.ac.id</p>
            </div>
            <div>
                <p><strong>Sosial Media</strong></p>
                <p>@siera.siruangan</p>
            </div>
        </div>
        <p class="copyright">Copyright (c) Siera Teams 2025. All rights reserved.</p>
    </footer>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>
