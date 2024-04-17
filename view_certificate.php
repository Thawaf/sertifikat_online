<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sertifikat_online";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data sertifikat
$sql = "SELECT * FROM certificates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificates</title>
    <link rel="stylesheet" href="styles111.css"> <!-- Menggunakan CSS yang telah Anda definisikan -->
</head>
<body>
    <header>
        <h1>View Certificates</h1>
    </header>

    <div class="content">
        <table class="event-table">
            <thead>
                <tr>
                    <th>Participant Name</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Certificate Text</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["participant_name"] . "</td>";
                        echo "<td>" . $row["event_name"] . "</td>";
                        echo "<td>" . $row["event_date"] . "</td>";
                        echo "<td>" . $row["certificate_text"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No certificates found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <li><a href="edit_certificate.php">edit</a></li>
        <li><a href="delete_certificate.php">delete</a></li>
        <li><a href="generate_certificate_assignment.php">generate</a></li>
    </div>
</body>
</html>

<?php
// Tutup koneksi database
$conn->close();
?>
