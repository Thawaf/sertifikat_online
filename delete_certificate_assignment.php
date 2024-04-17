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

// Proses penghapusan penugasan sertifikat
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assignment_id'])) {
    // Membuat koneksi ke database
    $conn = connectDB();

    // Ambil ID penugasan dari formulir
    $assignment_id = $_POST['assignment_id'];

    // Hapus penugasan sertifikat dari database
    $sql = "DELETE FROM certificate_assignments WHERE assignment_id=$assignment_id";

    if ($conn->query($sql) === TRUE) {
        echo "Penugasan sertifikat berhasil dihapus!";
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
    <title>Delete Certificate Assignment - Sertifikat Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="delete-assignment-container">
        <h2>Delete Certificate Assignment</h2>
        <form action="" method="POST">
            <label for="assignment_id">Assignment ID:</label>
            <input type="number" id="assignment_id" name="assignment_id" required><br><br>
            <button type="submit">Delete Assignment</button>
        </form>
    </div>
</body>
</html>
