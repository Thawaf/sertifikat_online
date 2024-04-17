<?php
session_start();

// Periksa apakah admin telah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Fungsi koneksi ke database
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sertifikat_online";
    return new mysqli($servername, $username, $password, $dbname);
}

// Proses penghapusan sertifikat
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['certificate_id'])) {
    // Membuat koneksi ke database
    $conn = connectDB();

    // Ambil ID sertifikat dari formulir
    $certificate_id = $_POST['certificate_id'];

    // Hapus sertifikat dari database
    $sql = "DELETE FROM certificates WHERE certificate_id=$certificate_id";

    if ($conn->query($sql) === TRUE) {
        echo "Sertifikat berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Certificate - Sertifikat Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="delete-certificate-container">
        <h2>Delete Certificate</h2>
        <form action="" method="POST">
            <label for="certificate_id">Certificate ID:</label>
            <input type="number" id="certificate_id" name="certificate_id" required><br><br>
            <button type="submit">Delete Certificate</button>
        </form>
    </div>
</body>
</html>
