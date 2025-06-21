<?php
// Masukkan file database.php untuk koneksi
include('database.php');

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password
    if ($password === $confirm_password) {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "Email sudah terdaftar!";
        } else {
            // Menyimpan data pengguna ke database
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                // Arahkan pengguna ke halaman dashboard setelah pendaftaran berhasil
                header("Location: dashboard.php");
                exit(); // Pastikan tidak ada kode lain yang dijalankan setelah redirect
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Password dan konfirmasi password tidak cocok!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>
  <link rel="stylesheet" href="assets/css/register.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <h2>Welcome Back!</h2>
      <p>To Keep Connected With Us<br />Please Login With Your Personal Info</p>
      <a href="login.php"><button class="btn">SIGN IN</button></a>
    </div>

    <div class="right-panel">
      <h2>Create an Account</h2>

      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-google"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>

      <div class="register-line">
        <span>Or use your email for registration :</span>
      </div>

      <form class="form" action="register.php" method="POST">
        <div class="input-box">
          <i class="fas fa-user"></i>
          <input type="text" name="name" placeholder="Name" required />
        </div>
        <div class="input-box">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required />
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="input-box">
          <input type="password" name="confirm_password" placeholder="Confirm Password" required />
        </div>
        <div class="checkbox">
          <input type="checkbox" id="terms" />
          <label for="terms">
            By registering your details, you agree with our
            <a href="#">Terms & Conditions, Privacy and Cookie Policy</a>
          </label>
        </div>
        <button type="submit" class="btn submit">SIGN UP</button>
      </form>
    </div>
  </div>
</body>
</html>
