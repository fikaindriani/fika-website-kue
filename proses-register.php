<?php
$conn = mysqli_connect("localhost", "root", "", "db_kue");

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
mysqli_query($conn, $query);

if(mysqli_affected_rows($conn) > 0){
    echo "<script>
        alert('Registrasi berhasil!');
        window.location='user-login.php';
    </script>";
} else {
    echo "<script>
        alert('Registrasi gagal!');
        window.location='register.php';
    </script>";
}
?>