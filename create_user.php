<?php
session_start();

// Proses registrasi user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sertifikat_online";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Periksa apakah username sudah digunakan
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "berhasil";
    } else {
        // Tambahkan user baru ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Enkripsi kata sandi
        $sql = "INSERT INTO users (username, password, full_name, email) VALUES ('$username', '$hashed_password', '$fullname', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Registrasi berhasil!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Register User - Sertifikat Online</title>
</head>
<body>
    <h2>create User</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
