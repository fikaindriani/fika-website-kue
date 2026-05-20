<?php
$conn = mysqli_connect("localhost","root","","db_kue");

$id_produk = $_POST['id_produk'];
$qty = $_POST['qty'];

$query = mysqli_query($conn,
"SELECT * FROM produk WHERE id='$id_produk'");

$produk = mysqli_fetch_assoc($query);

$stok = $produk['stok'];

if($stok < $qty){

    echo "
    <script>
    alert('Stok tidak cukup!');
    window.location='produk.php';
    </script>
    ";

}else{

    mysqli_query($conn,
    "UPDATE produk
    SET stok = stok - $qty
    WHERE id='$id_produk'");

    echo "
    <script>
    alert('Checkout berhasil!');
    window.location='produk.php';
    </script>
    ";
}
?>