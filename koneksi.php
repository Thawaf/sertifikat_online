<?php
// Informasi koneksi ke database
$servername = "localhost"; // Server database (misalnya, localhost)
$username = "root"; // Nama pengguna database
$password = ""; // Kata sandi database
$dbname = "sertifikat_online"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
