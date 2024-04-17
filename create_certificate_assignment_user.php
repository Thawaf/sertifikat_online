<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penugasan Sertifikat</title>
</head>
<body>
    <h2>Form Penugasan Sertifikat</h2>
    <form action="" method="post">
        <label for="certificate_id">ID Sertifikat:</label>
        <input type="text" id="certificate_id" name="certificate_id"><br><br>

        <label for="user_id">ID Pengguna:</label>
        <input type="text" id="user_id" name="user_id"><br><br>

        <label for="event_id">ID Acara:</label>
        <input type="text" id="event_id" name="event_id"><br><br>

        <input type="submit" name="submit" value="Buat Penugasan">
    </form>

    <?php
    if(isset($_POST['submit'])){
        // Koneksi ke database (sesuaikan dengan detail koneksi Anda)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "sertifikat_online";

        $conn = new mysqli($servername, $username, $password, $database);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Fungsi untuk membuat penugasan sertifikat baru
        function createCertificateAssignment($certificate_id, $user_id, $event_id) {
            global $conn;
            
            $sql = "INSERT INTO certificate_assignments2 (certificate_id, user_id, event_id)
                    VALUES ('$certificate_id', '$user_id', '$event_id')";

            if ($conn->query($sql) === TRUE) {
                echo "Penugasan sertifikat berhasil dibuat.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Tangkap data dari formulir
        $certificate_id = $_POST['certificate_id'];
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];

        // Buat penugasan sertifikat jika data telah diisi
        if (!empty($certificate_id) && !empty($user_id) && !empty($event_id)) {
            createCertificateAssignment($certificate_id, $user_id, $event_id);
        }

        // Tutup koneksi database
        $conn->close();
    }
    ?>
</body>
</html>
