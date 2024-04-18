<?php
session_start();

// Fungsi koneksi ke database
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sertifikat_online";
    return new mysqli($servername, $username, $password, $dbname);
}

// Fungsi untuk memeriksa apakah pengguna adalah user biasa
function isUser($conn, $username, $password) {
    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        // Memeriksa apakah password yang dimasukkan cocok dengan hash yang disimpan
        return password_verify($password, $stored_password);
    } else {
        return false;
    }
}

// Fungsi untuk logout pengguna sebelumnya jika ada
function logoutPreviousUser() {
    // Jika sesi pengguna sebelumnya masih aktif, logout pengguna tersebut
    if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        $_SESSION = array(); // Hapus semua data sesi
        session_destroy(); // Hapus sesi
    }
}  

// Proses login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isUser($conn, $username, $password)) {
        // Logout pengguna sebelumnya jika ada
        logoutPreviousUser();
        // Set session user_logged_in dan username
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: user_dashboard.php"); // Redirect ke dashboard user
        exit();
    } else {
        $error_message = "Login gagal. Silakan coba lagi.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - Sertifikat Online</title>
    <link rel="stylesheet" href="user_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login User</h2>
        <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>