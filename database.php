<?php
$servername = "localhost";  // Server MySQL
$username = "root";         // Username MySQL (umumnya 'root' untuk XAMPP)
$password = "";             // Password MySQL (biasanya kosong di XAMPP)
$dbname = "siera-pinru";    // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
