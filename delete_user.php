<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<body>

<h2>Delete User</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="user_id">User ID:</label><br>
    <input type="text" id="user_id" name="user_id"><br>
    <input type="submit" value="Delete">
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
    $user_id = $_POST["user_id"];

    // Membuat koneksi baru
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah ID pengguna ditemukan dalam database
    $check_sql = "SELECT * FROM users WHERE user_id = $user_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        echo "Gagal: ID pengguna tidak ditemukan dalam database";
    } else {
        // Menyiapkan dan mengeksekusi statement SQL untuk menghapus pengguna
        $delete_sql = "DELETE FROM users WHERE user_id=$user_id";
        if ($conn->query($delete_sql) === TRUE) {
            echo "Pengguna berhasil dihapus";
        } else {
            echo "Error: " . $delete_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

</body>
</html>
