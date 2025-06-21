<?php
// Establish connection to the database
$conn = new mysqli("localhost", "root", "", "siera-pinru");  // Adjust username, password, and database if necessary

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $peminjam = $_POST['peminjam'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $name = $_POST['name'];  // Room name
    $hari_tanggal = $_POST['hari_tanggal'];
    $capacity = $_POST['capacity'];  // Number of participants
    $jam_penggunaan = $_POST['jam_penggunaan'];
    $jam_selesai = $_POST['jam_selesai']; // Add finish time
    $keterangan = $_POST['keterangan'];

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the user_id based on the provided email
    $user_query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param('s', $email); // Binding the email parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user_id from the result
        $user = $result->fetch_assoc();
        $user_id = $user['id']; // Get the user_id

        // Insert data into the 'peminjaman' table (assuming proper fields)
        $query = "INSERT INTO peminjaman (user_id, nama_peminjam, nama_ruangan, ruangan, tanggal_peminjaman, jam_mulai, jam_selesai, kapasitas, no_telepon, email, keterangan, status) 
                  VALUES ('$user_id', '$peminjam', '$name', '$name', '$hari_tanggal', '$jam_penggunaan', '$jam_selesai', '$capacity', '$no_telepon', '$email', '$keterangan', 'pengajuan')";

        if ($conn->query($query) === TRUE) {
            echo "Peminjaman berhasil dilakukan!";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Email tidak ditemukan!";  // If the email does not exist in the users table
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Peminjaman Ruangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/formpeminjaman.css" />
</head>
<body>
    <header>
        <div class="header-left">
            <h2>Form Peminjaman Ruangan</h2>
            <p><?php echo date("l, d F Y"); ?></p>
        </div>
    </header>

    <div class="container">
        <section class="greeting-box">
            <h2>Hallo, Zarakilla</h2>
            <p>Mau pinjam ruangan di Filkom? Tinggal isi saja form di bawah ini yaa</p>
        </section>

        <section class="form-container">
            <h2>Formulir Peminjaman Ruangan</h2>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="peminjam">Nama Peminjam :</label>
                    <input type="text" id="peminjam" name="peminjam" placeholder="Masukkan Nama" required />
                </div>

                <div class="form-group">
                    <label for="email">Email Peminjam :</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" required />
                </div>

                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon Peminjam :</label>
                    <input type="tel" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Peminjam" required />
                </div>

                <div class="form-group">
                    <label for="name">Ruangan Yang Ingin Dipinjam :</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan Ruangan Yang Ingin Dipinjam" required />
                </div>

                <div class="double-row">
                    <div class="form-group">
                        <label for="hari_tanggal">Tanggal Pinjam :</label>
                        <input type="date" id="hari_tanggal" name="hari_tanggal" required />
                    </div>
                    <div class="form-group">
                        <label for="capacity">Jumlah Partisipan :</label>
                        <input type="number" id="capacity" name="capacity" placeholder="Masukkan Partisipan" required />
                    </div>
                </div>

                <div class="double-row">
                    <div class="form-group">
                        <label for="jam_penggunaan">Jam Pakai Ruangan :</label>
                        <input type="time" id="jam_penggunaan" name="jam_penggunaan" required />
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai :</label>
                        <input type="time" id="jam_selesai" name="jam_selesai" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan Penggunaan Ruangan :</label>
                    <textarea id="keterangan" name="keterangan" placeholder="Tuliskan Keterangan Peminjaman Ruangan Anda di Sini ..." required></textarea>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-submit">Submit</button>
                    <button type="reset" class="btn btn-cancel">Batal</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
