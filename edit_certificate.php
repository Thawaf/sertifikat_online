<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Certificate</title>
</head>
<body>

<h2>Edit Certificate</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="certificate_id">Certificate ID:</label><br>
    <input type="text" id="certificate_id" name="certificate_id"><br>
    
    <label for="participant_name">Participant Name:</label><br>
    <input type="text" id="participant_name" name="participant_name"><br>
    
    <label for="event_name">Event Name:</label><br>
    <input type="text" id="event_name" name="event_name"><br>
    
    <label for="event_date">Event Date:</label><br>
    <input type="date" id="event_date" name="event_date"><br>
    
    <label for="certificate_text">Certificate Text:</label><br>
    <textarea id="certificate_text" name="certificate_text" rows="4" cols="50"></textarea><br>
    
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
    $certificate_id = $_POST["certificate_id"];
    $participant_name = $_POST["participant_name"];
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $certificate_text = $_POST["certificate_text"];

    // Membuat koneksi baru
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah ID sertifikat ditemukan dalam database sebelum melakukan pembaruan
    $check_sql = "SELECT * FROM certificates WHERE certificate_id = $certificate_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        echo "Gagal: ID sertifikat tidak ditemukan dalam database";
    } else {
        // Menyiapkan dan mengeksekusi statement SQL untuk mengupdate data sertifikat
        $sql = "UPDATE certificates SET participant_name='$participant_name', event_name='$event_name', event_date='$event_date', certificate_text='$certificate_text' WHERE certificate_id=$certificate_id";
        if ($conn->query($sql) === TRUE) {
            echo "Data sertifikat berhasil diperbarui";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

</body>
</html>
