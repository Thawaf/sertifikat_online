<!DOCTYPE html>
<html>
<head>
    <title>View All Events</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>View All Events</h2>
    

    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "sertifikat_online";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mendapatkan semua data acara
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    // Cek jika ada hasil
    if ($result->num_rows > 0) {
        // Output data dalam tabel
        echo "<table>";
        echo "<tr><th>ID Acara</th><th>Nama Acara</th><th>Tanggal Acara</th><th>Lokasi</th><th>Penyelenggara</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>"; 
            echo "<td>" . $row["event_id"]. "</td>";
            echo "<td>" . $row["event_name"]. "</td>";
            echo "<td>" . $row["event_date"]. "</td>";
            echo "<td>" . $row["location"]. "</td>";
            echo "<td>" . $row["organizer"]. "</td>";
            echo "</tr>"; 
        }
        echo "</table>";
    } else {
        echo "Tidak ada acara yang tersedia.";
    }
    

    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>
