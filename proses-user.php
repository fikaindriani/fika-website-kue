<?php
session_start();
include "koneksi.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username !== '' && $password !== '') {
    
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = $conn->query($query);
    
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        
        if($password == $user['password']){
            
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            if($user['role'] == 'admin'){
                header("Location: pesanan.php");
            } else {
                header("Location: index.php");
            }
            exit;
            
        } else {
            echo "<script>alert('Password salah!'); window.location='user-login.php';</script>";
        }
    } else {
        echo "<script>alert('Username/Email tidak ditemukan!'); window.location='user-login.php';</script>";
    }
    
} else {
    echo "<script>alert('Isi dulu email & password!'); window.location='user-login.php';</script>";
}
?>