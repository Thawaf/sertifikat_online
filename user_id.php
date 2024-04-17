<?php
// File: handle_user_id.php

// Periksa apakah parameter user_id telah diberikan dalam URL
if (!isset($_GET['user_id'])) {
    // Jika user_id tidak disediakan dalam URL, Anda dapat mengambil tindakan yang sesuai di sini
    // Misalnya, Anda dapat mengarahkan pengguna kembali ke halaman sebelumnya atau menampilkan pesan kesalahan
    header("Location: admin_dashboard.php"); // Ganti 'index.php' dengan halaman tujuan Anda
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan pengguna
}
?>
