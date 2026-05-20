<?php
include "koneksi.php";

$id = $_GET['id'];

$cek = mysqli_query($conn,"
SELECT * FROM cart
WHERE id_produk='$id'
AND status='cart'
");

if(mysqli_num_rows($cek) > 0){

   mysqli_query($conn,"
   UPDATE cart
   SET qty = qty + 1
   WHERE id_produk='$id'
   ");

}else{

   mysqli_query($conn,"
   INSERT INTO cart(
   id_produk,
   qty,
   status
   )

   VALUES(
   '$id',
   '1',
   'cart'
   )
   ");

}

header("Location: cart.php");
?>