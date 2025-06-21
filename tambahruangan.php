<?php
// Proses pengiriman form (di bagian ini, bisa dihubungkan dengan database atau email)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];  // Nama ruangan
    $capacity = $_POST['capacity'];  // Kapasitas ruangan
    $lokasi = $_POST['lokasi'];  // Lokasi ruangan
    $status = $_POST['status'];  // Status ruangan
    $image_url = '';  // Inisialisasi gambar

    // Menangani upload gambar
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_dir = 'uploads/';  // Pastikan folder ini ada di server Anda

        // Periksa apakah folder uploads ada, jika tidak, buat folder
        if (!file_exists($image_dir)) {
            mkdir($image_dir, 0777, true);  // Membuat folder jika belum ada
        }

        // Menyimpan gambar ke folder 'uploads'
        $image_url = $image_dir . basename($image_name);
        move_uploaded_file($image_tmp, $image_url);
    }

    // Asumsi: Anda sudah memiliki user_id yang valid (misalnya dari session atau input lainnya)
    $user_id = 1;  // Gantilah dengan ID yang valid (misalnya, dari session atau form)

    // Lakukan proses penyimpanan ke database
    include 'database.php';  // Menghubungkan ke database

    // Query untuk insert data (termasuk status dan image_url)
    $query = "INSERT INTO peminjaman (user_id, nama_ruangan, kapasitas, lokasi, status, foto) 
              VALUES ('$user_id', '$name', '$capacity', '$lokasi', '$status', '$image_url')";

    if ($conn->query($query) === TRUE) {
        // Jika data berhasil disimpan, arahkan ke daftar ruangan
        header("Location: daftarruangan.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Tambah Ruangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tambahruangan.css" />
</head>
<body>
    <header>
        <div class="header-left">
            <h2>Tambah Ruangan</h2>
            <p><?php echo date("l, d F Y"); ?></p>
        </div>
    </header>

    <div class="container">
        <section class="greeting-box">
            <h2>Hallo, Admin</h2>
            <p>Silakan isi form di bawah ini untuk menambahkan ruangan baru</p>
        </section>

        <section class="form-container">
            <h2>Formulir Tambah Ruangan</h2>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nama Ruangan :</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan Nama Ruangan" required />
                </div>

                <div class="form-group">
                    <label for="capacity">Kapasitas Ruangan :</label>
                    <input type="number" id="capacity" name="capacity" placeholder="Masukkan Kapasitas" required />
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi Ruangan :</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi Ruangan" required />
                </div>

                <div class="form-group">
                    <label for="status">Status Ruangan :</label>
                    <select id="status" name="status" required>
                        <option value="available">Tersedia</option>
                        <option value="booked">Terkunci</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Gambar Ruangan :</label>
                    <input type="file" id="image" name="image" accept="image/*" />
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-submit">Tambah Ruangan</button>
                    <button type="reset" class="btn btn-cancel">Batal</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
