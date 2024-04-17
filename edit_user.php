<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="user_id">User ID:</label><br>
    <input type="text" id="user_id" name="user_id"><br>
    
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    
    <label for="full_name">Full Name:</label><br>
    <input type="text" id="full_name" name="full_name"><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    
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
    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];

    // Membuat koneksi baru
    $conn = new mysqli('localhost', 'root', '', 'sertifikat_online');
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
        // Menyiapkan dan mengeksekusi statement SQL untuk mengupdate data pengguna
        $sql = "UPDATE users SET username='$username', full_name='$full_name', email='$email' WHERE user_id=$user_id";
        if ($conn->query($sql) === TRUE) {
            echo "Data pengguna berhasil diperbarui";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

</body>
</html>
