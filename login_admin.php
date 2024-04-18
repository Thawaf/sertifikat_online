<?php
session_start();

//Fungsi koneksi ke database
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sertifikat_online";
    return new mysqli($servername, $username, $password, $dbname);
}


function isAdmin($conn, $username, $password) {
    $sql = "SELECT password FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        return password_verify($password, $stored_password);
    } else {
        return false;
    }
}

// Fungsi untuk logout admin sebelumnya jika ada
function logoutPreviousAdmin() {
    // Jika sesi admin sebelumnya masih aktif, logout admin tersebut
    if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        $_SESSION = array(); // Hapus semua data sesi
        session_destroy(); // Hapus sesi
    }
}

// Proses login admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isAdmin($conn, $username, $password)) {
        // Logout admin sebelumnya jika ada
        logoutPreviousAdmin();

        // Set session admin_logged_in dan username
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin_dashboard.php"); // Redirect ke dashboard admin
        exit();
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sertifikat Online</title>
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>