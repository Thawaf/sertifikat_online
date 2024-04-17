<?php
session_start();

// Periksa apakah pengguna telah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login_user.php");
    exit();
}

// Ambil informasi pengguna dari session jika diperlukan
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Sertifikat Online</title>
    <link rel="stylesheet" href="dashboard_user.css">
</head>
<body>
    <header>
        <h2>Selamat datang, <?php echo $username; ?>!</h2>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="view_event.php">View Events</a></li>
                    <li><a href="generate_certificate_2.php">generate</a></li>
                    <li><a href="logout.php">logout</a></li>
                    <li><a href="create_certificate_assignment_user.php">create certificate assignment</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h3>Dashboard Pengguna</h3>
        <p>Ini adalah dashboard pengguna Anda. Anda dapat menambahkan konten sesuai kebutuhan aplikasi Anda.</p>
    </main>
    <footer>
        <p>&copy; 2024 Sertifikat Online</p>
        <a href="logout.php">Logout</a> <!-- Tautan untuk logout -->
    </footer>
</body>
</html>
