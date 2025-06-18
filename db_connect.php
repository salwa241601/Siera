<?php
$host = "localhost";   // Ganti dengan host database Anda
$user = "root";        // Ganti dengan username database Anda
$pass = "";            // Ganti dengan password database Anda
$dbname = "siera"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Mengecek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
