<?php
$conn = mysqli_connect("localhost","root","","db_kue");
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];
mysqli_query($conn,"INSERT INTO produk (nama,kategori) VALUES ('$nama','$kategori')");
?>