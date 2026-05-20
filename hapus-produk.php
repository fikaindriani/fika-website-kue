<?php
$conn = mysqli_connect("localhost","root","","db_kue");
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM produk WHERE id=$id");
?>