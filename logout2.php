<?php
session_start(); // Mulai sesi

// Fungsi untuk logout user
function logoutUser() {
    unset($_SESSION['user_id']);
    session_destroy();
    header("Location: login_user.php"); // Ubah 'login.php' dengan halaman login Anda
    exit();
}

// Panggil fungsi logout jika ada permintaan logout
if(isset($_GET['logout'])) {
    logoutUser();
}
?>
