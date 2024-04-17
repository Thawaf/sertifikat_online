<?php
session_start();

// Periksa apakah admin telah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login_user.php");
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

// Proses penambahan event baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Membuat koneksi ke database
    $conn = connectDB();

    // Ambil data dari formulir
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $organizer = $_POST['organizer'];

    // Tambahkan event baru ke database
    $sql = "INSERT INTO events (event_name, event_date, location, organizer) VALUES ('$event_name', '$event_date', '$location', '$organizer')";

    if ($conn->query($sql) === TRUE) {
        echo "Event berhasil ditambahkan!";
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
    <title>Create Event - Sertifikat Online</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="create-event-container">
        <h2>Create Event</h2>
        <form action="" method="POST">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required><br><br>
            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required><br><br>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br><br>
            <label for="organizer">Organizer:</label>
            <input type="text" id="organizer" name="organizer" required><br><br>
            <button type="submit">Create Event</button>
        </form>
    </div>
</body>
</html>
