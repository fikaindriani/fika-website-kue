<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: user-login.php");
    exit;
}
?>

<h2>Halo, <?php echo $_SESSION['user']; ?> 👋</h2>
<p>Selamat datang di Zeya’s Bakery</p>

<a href="logout.php">Logout</a>