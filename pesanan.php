<?php include "koneksi.php"; ?>

<?php
if(isset($_GET['aksi'])){

  $id = $_GET['id'];
  $aksi = $_GET['aksi'];

  $cek = $conn->query("SELECT status FROM pesanan WHERE id_pesanan=$id");
  $dataStatus = $cek->fetch_assoc();

  // kalau status sudah ditolak tidak bisa diubah lagi
  if($dataStatus['status'] == "Ditolak"){
    echo "<script>
      alert('Pesanan yang sudah ditolak tidak bisa diubah lagi');
      window.location='pesanan.php';
    </script>";
    exit;
  }

  if($aksi == "terima"){

    $conn->query("UPDATE pesanan SET status='Di Proses' WHERE id_pesanan=$id");

    echo "<script>
      alert('Pesanan diterima dan diproses');
      window.location='pesanan.php';
    </script>";

    exit;

  }elseif($aksi == "tolak"){

    $conn->query("UPDATE pesanan SET status='Ditolak' WHERE id_pesanan=$id");

    echo "<script>
      alert('Pesanan ditolak');
      window.location='pesanan.php';
    </script>";

    exit;

  }elseif($aksi == "proses"){

    $conn->query("UPDATE pesanan SET status='Di Proses' WHERE id_pesanan=$id");

    echo "<script>
      alert('Status diubah ke Di Proses');
      window.location='pesanan.php';
    </script>";

    exit;

  }elseif($aksi == "kemas"){

    $conn->query("UPDATE pesanan SET status='Di Kemas' WHERE id_pesanan=$id");

    echo "<script>
      alert('Status diubah ke Di Kemas');
      window.location='pesanan.php';
    </script>";

    exit;

  }elseif($aksi == "antar"){

    $conn->query("UPDATE pesanan SET status='Di Antar' WHERE id_pesanan=$id");

    echo "<script>
      alert('Status diubah ke Di Antar');
      window.location='pesanan.php';
    </script>";

    exit;

  }elseif($aksi == "sampai"){

    $conn->query("UPDATE pesanan SET status='Sampai' WHERE id_pesanan=$id");

    echo "<script>
      alert('Pesanan telah sampai');
      window.location='pesanan.php';
    </script>";

    exit;

  }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Pesanan</title>

<style>

body{
  margin:0;
  font-family:Georgia, serif;
  background:#e8bcbc;
}

.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  background:#d69a9a;
  padding:15px 25px;
  border-radius:20px;
  margin:10px;
}

.nav-left{
  display:flex;
  gap:15px;
  flex-wrap:wrap;
}

.nav-left a{
  padding:10px 25px;
  border-radius:30px;
  background:#f3cfcf;
  text-decoration:none;
  color:black;
  transition:0.3s;
}

.nav-left a.active{
  background:#c97d7d;
  color:white;
}

.nav-right{
  display:flex;
  gap:10px;
  align-items:center;
}

.btn-top{
  background:#c97d7d;
  border:none;
  padding:10px 18px;
  border-radius:20px;
  color:white;
  cursor:pointer;
  font-size:14px;
}

.container{
  padding:30px;
}

table{
  width:100%;
  border-collapse:collapse;
  background:#d9a8a8;
}

th, td{
  border:3px solid black;
  text-align:center;
  padding:12px;
}

.bukti-img{
  width:70px;
  border-radius:10px;
}

/* DROPDOWN */

.dropdown{
  position:relative;
  display:inline-block;
}

.dropbtn{
  background:#f4f6d2;
  border:none;
  padding:8px 16px;
  border-radius:20px;
  cursor:pointer;
  min-width:130px;
  font-weight:bold;
}

.dropbtn::after{
  content:" ▼";
  font-size:11px;
}

.dropdown-content{
  display:none;
  position:absolute;
  background:white;
  min-width:150px;
  border-radius:12px;
  box-shadow:0 5px 10px rgba(0,0,0,0.2);
  z-index:999;
  top:45px;
  left:50%;
  transform:translateX(-50%);
  overflow:hidden;
}

.dropdown-content a{
  display:block;
  padding:10px;
  text-decoration:none;
  color:black;
  transition:0.3s;
}

.dropdown-content a:hover{
  background:#f0f0f0;
}

/* STATUS WARNA */

.status-ditolak{
  background:#ffb3b3;
}

.status-proses{
  background:#fff1b8;
}

.status-kemas{
  background:#d4f4ff;
}

.status-antar{
  background:#cde7ff;
}

.status-sampai{
  background:#c8ffd4;
}

</style>
</head>

<body>

<div class="navbar">

  <div class="nav-left">

    <a href="dashboard-admin.php">DASHBOARD</a>

    <a href="produk.php">MANAJEMEN PRODUK</a>

    <a href="pesanan.php" class="active">
      MANAJEMEN PESANAN
    </a>

    <a href="detail_pesanan.php">
      DETAIL PESANAN
    </a>

    <a href="kategori.php">
      KATEGORI
    </a>

    <a href="logout.php">
      LOGOUT
    </a>

  </div>

  <div class="nav-right">

    <button class="btn-top" onclick="window.print()">
      Cetak PDF
    </button>

  </div>

</div>

<div class="container">

<table>

<thead>

<tr>

  <th>ID</th>
  <th>Nama</th>
  <th>No HP</th>
  <th>Produk</th>
  <th>Total</th>
  <th>Bukti</th>
  <th>Status</th>
  <th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$data = $conn->query("
SELECT * FROM pesanan
ORDER BY id_pesanan DESC
");

while($row = $data->fetch_assoc()){

  $status = $row['status'] ?? 'Menunggu';

  $classStatus = "";

  if($status == "Ditolak"){
    $classStatus = "status-ditolak";
  }elseif($status == "Di Proses"){
    $classStatus = "status-proses";
  }elseif($status == "Di Kemas"){
    $classStatus = "status-kemas";
  }elseif($status == "Di Antar"){
    $classStatus = "status-antar";
  }elseif($status == "Sampai"){
    $classStatus = "status-sampai";
  }

  echo "

  <tr>

    <td>{$row['id_pesanan']}</td>

    <td>{$row['nama']}</td>

    <td>{$row['telepon']}</td>

    <td>{$row['produk']}</td>

    <td>
      Rp. ".number_format($row['total_bayar'])."
    </td>

    <td>
      <img
      src='uploads/{$row['bukti']}'
      class='bukti-img'>
    </td>

    <td>

      <div class='dropdown'>

        <button
        class='dropbtn $classStatus'
        onclick='toggleDropdown(this)'>

          $status

        </button>

        <div class='dropdown-content'>

          <a href='?aksi=proses&id={$row['id_pesanan']}'>
            Di Proses
          </a>

          <a href='?aksi=kemas&id={$row['id_pesanan']}'>
            Di Kemas
          </a>

          <a href='?aksi=antar&id={$row['id_pesanan']}'>
            Di Antar
          </a>

          <a href='?aksi=sampai&id={$row['id_pesanan']}'>
            Sampai
          </a>

        </div>

      </div>

    </td>

    <td>

      <div class='dropdown'>

        <button
        class='dropbtn'
        onclick='toggleDropdown(this)'>

          Pilih Aksi

        </button>

        <div class='dropdown-content'>

          <a href='?aksi=terima&id={$row['id_pesanan']}'>
            Terima
          </a>

          <a href='?aksi=tolak&id={$row['id_pesanan']}'>
            Tolak
          </a>

        </div>

      </div>

    </td>

  </tr>

  ";

}

?>

</tbody>

</table>

</div>

<script>

function toggleDropdown(btn){

  document
  .querySelectorAll(".dropdown-content")
  .forEach(el => {

    if(el !== btn.nextElementSibling){

      el.style.display = "none";

    }

  });

  let menu = btn.nextElementSibling;

  if(menu.style.display === "block"){

    menu.style.display = "none";

  }else{

    menu.style.display = "block";

  }

}

window.onclick = function(e){

  if(!e.target.matches('.dropbtn')){

    document
    .querySelectorAll(".dropdown-content")
    .forEach(el => {

      el.style.display = "none";

    });

  }

}

</script>

</body>
</html>