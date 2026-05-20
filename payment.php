<?php
include "koneksi.php";

session_start();

$id_user = 0;

if(isset($_SESSION['user_id'])){
  $id_user = $_SESSION['user_id'];
}

if(isset($_POST['kirim'])){

  $nama     = $_POST['nama'];
  $alamat   = $_POST['alamat'];
  $telepon  = $_POST['telepon'];
  $email    = $_POST['email'];
  $catatan  = $_POST['catatan'];
  $produk   = $_POST['produk'];
  $harga    = $_POST['harga'];
  $qty      = $_POST['qty'];
  $total    = $_POST['total'];
  $metode   = $_POST['metode'];

  $bukti = $_FILES['bukti']['name'];
  $tmp   = $_FILES['bukti']['tmp_name'];

  if(!is_dir("uploads")){
    mkdir("uploads");
  }

  $ext = strtolower(pathinfo($bukti, PATHINFO_EXTENSION));

  $allowed = ['jpg','jpeg','png'];

  if(!in_array($ext, $allowed)){
    echo "<script>alert('Format file harus JPG/JPEG/PNG');</script>";
    exit;
  }

  $namaBaru = time() . "_" . rand(100,999) . "." . $ext;

  $path = "uploads/" . $namaBaru;

  if(!move_uploaded_file($tmp, $path)){
    echo "<script>alert('Upload gagal');</script>";
    exit;
  }

  $query = "INSERT INTO pesanan
  (
    id_user,
    nama,
    alamat,
    telepon,
    email,
    catatan,
    produk,
    harga,
    qty,
    total_bayar,
    metode,
    bukti,
    status
  )

  VALUES
  (
    $id_user,
    '$nama',
    '$alamat',
    '$telepon',
    '$email',
    '$catatan',
    '$produk',
    '$harga',
    '$qty',
    '$total',
    '$metode',
    '$namaBaru',
    'Di Proses'
  )";

  if(!$conn->query($query)){
    echo "Error: " . $conn->error;
    exit;
  }

  $dataCart = json_decode($_POST['cart_data'], true);

  foreach($dataCart as $item){

    $namaProduk = $item['name'];
    $qtyProduk  = $item['quantity'];

    mysqli_query($conn,
    "UPDATE produk
    SET stok = stok - $qtyProduk
    WHERE nama_kue = '$namaProduk'");
  }

  echo "<script>

    alert('Pesanan berhasil dikirim');

    localStorage.removeItem('checkoutCart');

    window.location='pesanan-user.php';

  </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Payment</title>

<style>
body{
  font-family:Georgia, serif;
  background:#e7bcbc;
  padding:40px;
  margin:0;
}

.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  background:#d89c9c;
  padding:15px 20px;
  border-radius:15px;
  margin-bottom:25px;
  flex-wrap:wrap;
}

.logo{
  font-weight:bold;
  color:#4a2c2c;
  font-size:18px;
}

.menu{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}

.menu a{
  padding:8px 14px;
  background:#f3c5c5;
  border-radius:20px;
  text-decoration:none;
  color:#4a2c2c;
  transition:0.3s;
  font-size:14px;
}

.menu a:hover{
  background:#c47d7d;
  color:white;
}

.container{
  display:flex;
  justify-content:space-between;
  gap:60px;
}

.form-left{
  width:60%;
}

.input-group{
  margin-bottom:20px;
}

input,
textarea{
  width:100%;
  padding:14px 20px;
  border-radius:30px;
  border:2px solid #c47d7d;
  box-sizing:border-box;
}

textarea{
  resize:none;
  height:90px;
}

.payment-option{
  display:flex;
  justify-content:space-between;
  align-items:center;
  background:#e3a8a8;
  border-radius:40px;
  padding:14px 20px;
  margin-bottom:10px;
  cursor:pointer;
}

.pay-left{
  display:flex;
  align-items:center;
  gap:15px;
}

.pay-img{
  width:50px;
  height:50px;
  object-fit:contain;
}

.order-box{
  width:320px;
  background:#e3a8a8;
  border-radius:35px;
  padding:25px;
  height:fit-content;
}

.summary-btn{
  margin-top:20px;
  background:#c47d7d;
  padding:14px;
  border-radius:25px;
  border:none;
  width:100%;
  cursor:pointer;
  font-size:16px;
}
</style>
</head>

<body>

<div class="navbar">

  <div class="logo">
    🍪 Zeya Bakery
  </div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

</div>

<form method="POST" enctype="multipart/form-data">

<div class="container">

  <div class="form-left">

    <h2>DETAIL PEMESANAN</h2>

    <div class="input-group">
      <input name="nama" placeholder="Nama" required>
    </div>

    <div class="input-group">
      <input name="alamat" placeholder="Alamat" required>
    </div>

    <div class="input-group">
      <input name="telepon" placeholder="No HP" required>
    </div>

    <div class="input-group">
      <input name="email" placeholder="Email" required>
    </div>

    <div class="input-group">
      <textarea name="catatan" placeholder="Catatan"></textarea>
    </div>

    <input name="produk" id="produk" hidden>
    <input name="harga" id="harga" hidden>
    <input name="qty" id="qty" hidden>
    <input name="total" id="total" hidden>

    <input type="hidden" name="cart_data" id="cart_data">

    <h3>Pilih Metode Pembayaran</h3>

    <label class="payment-option">
      <div class="pay-left">
        <img src="img/dana.png" class="pay-img">

        <div>
          <b>DANA</b><br>
          081234567890
        </div>
      </div>

      <input type="radio" name="metode" value="DANA" required>
    </label>

    <label class="payment-option">
      <div class="pay-left">
        <img src="img/bca.png" class="pay-img">

        <div>
          <b>BCA</b><br>
          1234567890
        </div>
      </div>

      <input type="radio" name="metode" value="BCA">
    </label>

    <label class="payment-option">
      <div class="pay-left">
        <img src="img/bni.png" class="pay-img">

        <div>
          <b>BNI</b><br>
          9876543210
        </div>
      </div>

      <input type="radio" name="metode" value="BNI">
    </label>

    <label class="payment-option">
      <div class="pay-left">
        <img src="img/mandiri.png" class="pay-img">

        <div>
          <b>MANDIRI</b><br>
          1122334455
        </div>
      </div>

      <input type="radio" name="metode" value="MANDIRI">
    </label>

    <br>

    Upload Bukti Transfer:

    <input type="file" name="bukti" required>

  </div>

  <div class="order-box">

    <h2>ORDER SUMMARY</h2>

    <p id="produkText"></p>

    <p>
      Qty:
      <span id="qtyText"></span>
    </p>

    <p>
      Harga:
      <span id="hargaText"></span>
    </p>

    <p>
      Total:
      <span id="totalText"></span>
    </p>

    <button class="summary-btn" name="kirim">
      Bayar Sekarang
    </button>

  </div>

</div>
</form>

<script>

function formatRupiah(num){
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

let data =
JSON.parse(localStorage.getItem("checkoutCart")) || [];

if(data.length > 0){

  let namaList = [];
  let totalQty = 0;
  let totalHarga = 0;

  data.forEach(item => {

    namaList.push(item.name);

    totalQty += item.quantity;

    totalHarga += item.price * item.quantity;

  });

  document.getElementById("produk").value =
  namaList.join(", ");

  document.getElementById("harga").value =
  totalHarga;

  document.getElementById("qty").value =
  totalQty;

  document.getElementById("total").value =
  totalHarga;

  document.getElementById("cart_data").value =
  JSON.stringify(data);

  document.getElementById("produkText").innerText =
  namaList.join(", ");

  document.getElementById("qtyText").innerText =
  totalQty;

  document.getElementById("hargaText").innerText =
  "Rp " + formatRupiah(totalHarga);

  document.getElementById("totalText").innerText =
  "Rp " + formatRupiah(totalHarga);
}

</script>

</body>
</html>