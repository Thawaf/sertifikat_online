<?php
// Informasi koneksi database
$servername = "localhost"; // Ganti sesuai dengan nama server database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "sertifikat_online"; // Ganti dengan nama database Anda

// Membuat koneksi ke database MySQL
$mysqli = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
