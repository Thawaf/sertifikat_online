<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="event_id">Event ID:</label><br>
    <input type="text" id="event_id" name="event_id"><br>
    
    <label for="event_name">Nama Acara:</label><br>
    <input type="text" id="event_name" name="event_name"><br>
    
    <label for="event_date">Tanggal Acara:</label><br>
    <input type="date" id="event_date" name="event_date"><br>
    
    <label for="location">Lokasi:</label><br>
    <input type="text" id="location" name="location"><br>
    
    <label for="organizer">Penyelenggara:</label><br>
    <input type="text" id="organizer" name="organizer"><br>
    
    <input type="submit" value="Update">
</form>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sertifikat_online";

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai yang dikirimkan melalui form
    $event_id = $_POST["event_id"];
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $location = $_POST["location"];
    $organizer = $_POST["organizer"];

    // Membuat koneksi baru
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah ID acara ditemukan dalam database
    $check_sql = "SELECT * FROM events WHERE event_id = $event_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        echo "Gagal: ID acara tidak ditemukan dalam database";
    } else {
        // Menyiapkan dan mengeksekusi statement SQL untuk mengupdate data acara
        $sql = "UPDATE events SET event_name='$event_name', event_date='$event_date', location='$location', organizer='$organizer' WHERE event_id=$event_id";
        if ($conn->query($sql) === TRUE) {
            echo "Data acara berhasil diperbarui";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

</body>
</html>
