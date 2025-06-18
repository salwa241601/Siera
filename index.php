<!-- <?php
// Sertakan file koneksi ke database
include('db_connect.php');

// Query untuk mengambil daftar ruangan dari database
$query = "SELECT * FROM ruangan";
$result = mysqli_query($conn, $query);

// Cek apakah ada data ruangan
if (mysqli_num_rows($result) > 0) {
    // Data ditemukan, tampilkan dalam bentuk tabel/HTML
    echo '<div class="room-listing-section">';
    echo '<h2 class="section-title-new">Daftar Ruangan <br>Fakultas Ilmu Komputer</h2>';
    echo '<div class="room-rows-container">';
    
    // Loop untuk menampilkan semua ruangan
    while ($row = mysqli_fetch_assoc($result)) {
        $room_name = $row['name'];
        $capacity = $row['capacity'];
        $location = $row['location'];
        $status = $row['status'];
        $image_url = $row['image_url']; // Misalnya kolom image_url berisi path gambar ruangan

        // Tampilkan data ruangan dalam format HTML
        echo '<div class="room-item-card">';
        echo '<img src="' . $image_url . '" alt="' . $room_name . '" class="room-item-image">';
        echo '<div class="room-item-details">';
        echo '<p class="room-item-name">' . $room_name . '</p>';
        echo '<p class="room-item-capacity">Kapasitas: ' . $capacity . ' orang</p>';
        echo '<p class="room-item-location">Lokasi: ' . $location . '</p>';
        echo '<p class="room-item-status ' . ($status == 'available' ? 'available' : 'booked') . '">Status: ' . ucfirst($status) . '</p>';
        
        // Tombol pesan hanya akan tampil jika statusnya 'available'
        if ($status == 'available') {
            echo '<button class="pesan-button available-button" onclick="window.location.href=\'form_pjm.php\'">Pesan</button>';
        }
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    echo '<p>Data ruangan tidak ditemukan.</p>';
}

// Menutup koneksi database
mysqli_close($conn);
?> -->
