<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Certificate</title>
</head>
<body>
    <h1>Create New Certificate</h1>
    <?php
    // Memeriksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Memeriksa apakah semua field telah diisi
        if (!empty($_POST['participant_name']) && !empty($_POST['event_name']) && !empty($_POST['event_date']) && !empty($_POST['certificate_text'])) {
            // Mendapatkan nilai dari form
            $participant_name = $_POST['participant_name'];
            $event_name = $_POST['event_name'];
            $event_date = $_POST['event_date'];
            $certificate_text = $_POST['certificate_text'];

            // Koneksi ke database
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'sertifikat_online';

            $conn = new mysqli($host, $username, $password, $database);

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Membuat kueri untuk menyimpan data sertifikat ke dalam tabel "certificates"
            $sql = "INSERT INTO certificates (participant_name, event_name, event_date, certificate_text) 
                    VALUES ('$participant_name', '$event_name', '$event_date', '$certificate_text')";

            if ($conn->query($sql) === TRUE) {
                echo "Sertifikat berhasil dibuat dan disimpan ke dalam database.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Menutup koneksi
            $conn->close();
        } else {
            echo "Silakan lengkapi semua field.";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="participant_name">Participant Name:</label><br>
        <input type="text" id="participant_name" name="participant_name" required><br>
        
        <label for="event_name">Event Name:</label><br>
        <input type="text" id="event_name" name="event_name" required><br>
        
        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" required><br>
        
        <label for="certificate_text">Certificate Text:</label><br>
        <textarea id="certificate_text" name="certificate_text" rows="4" cols="50" required></textarea><br>
        
        <input type="submit" value="Create Certificate">
    </form>
</body>
</html>
