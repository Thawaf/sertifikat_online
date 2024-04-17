<?php
session_start();

// Periksa apakah admin telah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Ambil informasi admin dari session jika diperlukan
$username = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; // Ganti 'Admin' dengan nilai default jika username tidak ditemukan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sertifikat Online</title>
    <link rel="stylesheet" href="sas12.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <h1 class="logo">Admin Dashboard</h1>
                <ul class="nav-links">
                    <li><a href="create_certificate.php">Create certificate</a></li>
                    <li><a href="view_certificate.php">View certificate</a></li>
                    <li><a href="generate_certificate_assignment.php">generate</a></li>
                    <li><a href="edit_event.php">update data</a></li>
                    <li><a href="create_certificate_assignment.php">create certificate assignment</a></li>
                    <li><a href="user.php">user</a></li>
                    <li><a href="view_event.php">event</a></li>
                    <li><a href="delete_certificate_assignment.php">delete</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h2>Welcome</h2>
        <p>This is your admin dashboard. You can add more content according to your application needs.</p>
        <li><a href="logout.php">Logout</a></li>
    </main>
    <footer>
        <p>&copy; 2024 Sertifikat Online</p>
    </footer>
</body>
</html>
