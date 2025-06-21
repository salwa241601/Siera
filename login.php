<?php
session_start();
include('database.php'); // Menyertakan file koneksi ke database

if (isset($_POST['submit'])) {
    // Mendapatkan nilai input dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengecek apakah email dan password tidak kosong
    if (!empty($email) && !empty($password)) {
        // Mencocokkan email di database
        $query = "SELECT * FROM users WHERE email = ?";  // Query untuk mencari user berdasarkan email
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email); // Mengikat parameter email
        $stmt->execute();
        $result = $stmt->get_result();

        // Mengecek apakah ada hasilnya
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verifikasi password yang dimasukkan dengan yang ada di database
            if (password_verify($password, $user['password'])) {
                // Menyimpan data user dalam session
                $_SESSION['user'] = $user['id'];
                $_SESSION['role'] = $user['role'];  // Menyimpan role user (admin atau user)
                
                // Redirect berdasarkan role
                if ($_SESSION['role'] === 'admin') {
                    // Redirect ke dashboard admin jika role adalah admin
                    header("Location: dashboard_adm.php");
                } else {
                    // Redirect ke dashboard user biasa jika role adalah user
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                $error_message = "Email atau Password salah!";
            }
        } else {
            $error_message = "Email tidak terdaftar!";
        }
    } else {
        $error_message = "Harap isi semua kolom!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link rel="stylesheet" href="assets/css/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <!-- Login form di sebelah kiri -->
    <div class="right-panel">
      <h2>Sign In to Your Account</h2>

      <!-- Menampilkan pesan error jika ada -->
      <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message; ?></p>
      <?php endif; ?>

      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-google"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>

      <div class="login-line"><span>Or use your email and password:</span></div>

      <form class="form" action="login.php" method="post">
        <div class="input-box">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required />
        </div>

        <div class="input-box">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>

        <div class="checkbox">
          <input type="checkbox" id="remember" />
          <label for="remember">Remember me</label>
        </div>

        <button type="submit" name="submit" class="btn submit">SIGN IN</button>

        <div class="forgot-password">
          <a href="forgot-password.html">Forgot your password?</a>
        </div>
      </form>
    </div>

    <!-- Ajakan dan tombol sign up di sebelah kanan -->
    <div class="left-panel">
      <h2>Hello, Friend!</h2>
      <p>Enter your personal details and start your journey with us</p>
      <a href="register.php"><button class="btn">SIGN UP</button></a>
    </div>

  </div>
</body>
</html>
