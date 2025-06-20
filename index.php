<?php
session_start();

/* Jika user sudah login, langsung dashboard */
if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <div class="navbar">
    <div class="logo-area">
      <a href="#home" class="logo-circle">
        <img src="assets/img/logo.png" alt="Logo" class="logo-img">
      </a>
      <div class="logo-text">
        <h1>SIERA</h1>
        <p>Sistem Peminjaman Ruangan</p>
      </div>
    </div>

  <div class="menu-auth">
    <nav class="menu">
      <a href="home.html">Home</a>
      <a href="#facility">Fasilitas</a>
      <a href="#team">Tim</a>
      <a href="#tentang">Tentang</a>
    </nav>

    <div class="auth-buttons">
      <button class="signup" onclick="window.location.href='register.php'">SIGN UP</button>
      <button class="signin" onclick="window.location.href='login.php'">SIGN IN</button>
    </div>

  </div>
</div>

<div class="landing-container">
  <div class="landing-image">
    <img src="assets/img/bg.png" alt="Ilustrasi">
  </div>
  <div class="landing-content">
    <p class="landing-description">
      SIERA adalah sebuah sistem digital yang dirancang untuk memudahkan proses peminjaman dan manajemen ruangan di lingkungan Fakultas Ilmu Komputer. Sistem ini memungkinkan dosen, mahasiswa, dan staf untuk melakukan reservasi ruang kelas, laboratorium, auditorium, atau ruang rapat secara efisien, transparan, dan terintegrasi.
    </p>
    <div class="landing-stats">
      <div class="landing-card"><b>3</b><span>Gedung</span></div>
      <div class="landing-card"><b>10</b><span>Laboratorium</span></div>
      <div class="landing-card"><b>54</b><span>Ruangan</span></div>
    </div>
    <div class="landing-stats-2">
      <div class="landing-card"><b>5</b><span>Aula</span></div>
      <div class="landing-card"><b>10</b><span>Fasilitas Lainnya</span></div>
    </div>
    <a href="#" class="landing-btn">Pelajari Selengkapnya</a>
  </div>
</div>

<div class="why-section">
  <h2 class="why-title">Mengapa Harus Siera?</h2>
  <div class="why-cards">
    <div class="why-card">
      <div class="why-header">Mudah & Praktis</div>
      <p>Peminjaman ruangan kini cukup dilakukan secara online tanpa perlu datang langsung ke bagian administrasi.</p>
    </div>
    <div class="why-card">
      <div class="why-header">Real-Time & Transparan</div>
      <p>Cek ketersediaan ruangan secara langsung dan pantau status peminjaman dengan sistem yang terbuka dan jelas.</p>
    </div>
    <div class="why-card">
      <div class="why-header">Interaktif & User-Friendly</div>
      <p>Desain sistem yang simpel, responsif, dan mudah digunakan oleh mahasiswa, dosen, maupun admin.</p>
    </div>
    <div class="why-card">
      <div class="why-header">Mendukung Digitalisasi Kampus</div>
      <p>SIERA menjadi bagian dari transformasi digital kampus yang efisien, modern, dan mendukung kegiatan akademik secara tertib.</p>
    </div>
  </div>
</div>

<div class="facility-section">
  <h2 class="facility-title">Fasilitas</h2>
  <p class="facility-subtitle">Apa yang sedang kamu butuhkan?</p>
  
  <div class="facility-grid">
    <div class="facility-card">Ruang Kelas<br>Gedung F</div>
    <div class="facility-card">Laboratorium</div>
    <div class="facility-card">Aula<br>Algoritma</div>
    <div class="facility-card">Aula<br>GKM</div>
    <div class="facility-card">Theater<br>Heuristic</div>
    <div class="facility-card">Ruang Kerja<br>Bersama</div>
    <div class="facility-card">Lapangan<br>Basket</div>
    <div class="facility-card">Sport Center<br>Lt 12</div>
  </div>
</div>

<div class="team-section">
  <p class="team-intro">Kenalan dulu yuk dengan</p>
  <h2 class="team-title">Tim Kami</h2>

  <div class="team-card left">
    <img src="assets/img/Zara.png" alt="Foto Faza">
    <div class="team-text">
      <h3>Faza Rachmah Akilah</h3>
      <p class="position">UI/UX dan Fullstack Developer</p>
      <p>Faza bertugas sebagai UI/UX Designer dan Fullstack Developer dalam pengembangan sistem. Dengan keahliannya dalam mendesain antarmuka dan membangun aplikasi web, Faza memastikan bahwa sistem SIERA memiliki tampilan yang menarik, responsif, dan fungsional sesuai kebutuhan pengguna.</p>
    </div>
  </div>

  <div class="team-card right">
    <img src="assets/img/Salwa.png" alt="Foto Salwa">
    <div class="team-text">
      <h3>Salwa Rahmadhani Angi</h3>
      <p class="position">Project Manager</p>
      <p>Salwa bertugas sebagai Project Manager dalam pengembangan sistem SIERA. Ia mengatur alur kerja tim, memastikan semua tugas berjalan sesuai rencana, serta mengkoordinasikan seluruh anggota tim agar pengembangan sistem berjalan efektif dan efisien. Salwa juga aktif dalam membuat dokumentasi dan presentasi proyek.</p>
    </div>
  </div>

  <div class="team-card left">
    <img src="assets/img/Erlin.png" alt="Foto Zahra">
    <div class="team-text">
      <h3>Zahra Kuvita Aberlin</h3>
      <p class="position">Quality Assurance (QA)</p>
      <p>Zahra berperan sebagai Quality Assurance (QA) yaitu, tester dalam proyek pengembangan sistem SIERA. Dengan ketelitian dan kemampuannya dalam menganalisis aplikasi, Dandy memastikan sistem berjalan dengan baik tanpa bug, serta melakukan pengujian fungsionalitas agar kualitas produk tetap terjaga.</p>
    </div>
  </div>

  <div class="team-card right">
    <img src="assets/img/Jihan.png" alt="Foto Jihan">
    <div class="team-text">
      <h3>Jihan Nurlitha Sari</h3>
      <p class="position">Database Administrator (DBA)</p>
      <p>Jihan berfungsi sebagai Database Administrator (DBA) dalam sistem pengembangan SIERA. Ia merancang dan mengelola struktur basis data yang efisien, memastikan data tersimpan dengan aman, serta mendukung integrasi sistem dan aksesibilitas data yang optimal.</p>
    </div>
  </div>

  <div class="team-card left">
    <img src="assets/img/Cindi.png" alt="Foto Cindi">
    <div class="team-text">
      <h3>Cindi Jingga Febrianti</h3>
      <p class="position">Database Administrator (DBA)</p>
      <p>Cindi bertugas sebagai Database Administrator (DBA) dalam tim pengembangan sistem SIERA. Ia memastikan bahwa sistem basis data berjalan dengan baik dan mampu menangani kebutuhan penyimpanan data secara efektif, serta menjaga konsistensi dan keamanan data.</p>
    </div>
  </div>

  <div class="team-card right">
    <img src="assets/img/Dandy.png" alt="Foto Dandy">
    <div class="team-text">
      <h3>Dandy Al-Farisi Natanegara</h3>
      <p class="position">Content Writer / Copywriter</p>
      <p>Dandy bertugas sebagai Content Writer/Copywriter dalam tim pengembangan aplikasi SIERA. Ia menyusun konten teks pada aplikasi, membuat deskripsi, dokumentasi, dan naskah komunikasi yang jelas, menarik, dan informatif sehingga mendukung pemahaman pengguna terhadap aplikasi.</p>
    </div>
  </div>
</div>

<section class="siera-section">
  <div class="siera-container">
    <h2 class="siera-title">Apasih Siera Itu?</h2>
    <p class="siera-subtitle">Cari Tau yuk Tentang Siera</p>
    <p class="siera-description">
      SIERA, merupakan singkatan dari Sistem Peminjaman Ruangan. Siera merupakan platform digital yang dikembangkan
      khusus untuk memfasilitasi proses peminjaman ruangan di lingkungan Fakultas Ilmu Komputer. Sistem ini hadir
      sebagai solusi modern atas kebutuhan manajemen ruang yang semakin kompleks seiring dengan meningkatnya kegiatan
      akademik, penelitian, maupun organisasi kemahasiswaan. Melalui SIERA, pengguna seperti mahasiswa, dosen, dan
      tenaga kependidikan dapat dengan mudah melakukan peminjaman ruangan secara online tanpa perlu datang langsung ke
      bagian administrasi, sehingga proses menjadi lebih efisien, cepat, dan transparan. SIERA dilengkapi dengan
      berbagai fitur unggulan seperti pengecekan ketersediaan ruangan secara real-time, sistem notifikasi otomatis,
      riwayat peminjaman, serta proses validasi yang jelas dan terstruktur. Sistem ini juga dirancang dengan antarmuka
      yang intuitif dan responsif, sehingga dapat diakses dengan nyaman melalui berbagai perangkat, baik komputer
      maupun ponsel. Dengan mengedepankan prinsip user-friendly dan efisiensi, SIERA mendukung program digitalisasi
      layanan kampus serta menciptakan ekosistem akademik yang tertib dan terorganisir.
    </p>
  </div>
</section>

<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section contact">
            <h3>Kontak</h3>
            <p><img src="/gambar/gambartelpon.png" alt="Phone Icon" class="footer-icon"> +62 8123456789</p>
            <p><img src="/gambar/gambaremail.png" alt="Mail Icon" class="footer-icon"> siera@ub.ac.id</p>
        </div>
        <div class="footer-section social-media">
            <h3>Sosial Media</h3>
            <p><img src="/gambar/gambarig.png" alt="Instagram Icon" class="footer-icon"> siera.siruangan</p>
        </div>
    </div>
   
</footer>
 <div class="copyright">
        <p>Copyright (c) Siera Teams 2025. All rights reserved.</p>
    </div>


</body>
</html>
