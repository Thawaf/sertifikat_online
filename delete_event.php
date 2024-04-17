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

// Proses penghapusan event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    // Membuat koneksi ke database
    $conn = connectDB();

    // Ambil id event dari formulir
    $event_id = $_POST['event_id'];

    // Hapus event dari database
    $sql = "DELETE FROM events WHERE event_id=$event_id";

    if ($conn->query($sql) === TRUE) {
        echo "Event berhasil dihapus!";
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
    <title>Delete Event - Sertifikat Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="delete-event-container">
        <h2>Delete Event</h2>
        <form action="" method="POST">
            <label for="event_id">Event ID:</label>
            <input type="number" id="event_id" name="event_id" required><br><br>
            <button type="submit">Delete Event</button>
        </form>
    </div>
</body>
</html>
