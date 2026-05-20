<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND role='admin'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {

        if ($password == $data['password']) {

            $_SESSION['admin'] = $data['username'];
            header("Location: dashboard-admin.php");
            exit;

        } else {
            echo "Password salah!";
        }

    } else {
        echo "Username tidak ditemukan!";
    }

} else {
    echo "Akses tidak diizinkan!";
}
?>