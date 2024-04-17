<?php
session_start();

// Jika ada pengiriman data form
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

    // Lakukan autentikasi admin
    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin ditemukan, bandingkan password yang dihash
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password cocok, admin berhasil login
            $_SESSION['admin_logged_in'] = true;
            $conn->close();
            header("Location: admin_dashboard.php"); // Redirect ke dashboard admin
            exit;
        }
    }

    // Admin gagal login
    $login_error = "Login gagal. Silakan coba lagi.";

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sertifikat Online</title>
    <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <?php if(isset($login_error)) { ?>
            <p><?php echo $login_error; ?></p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
