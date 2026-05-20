<?php
$conn = mysqli_connect("localhost","root","","db_kue");

if(isset($_POST['tambah_produk'])){

  $nama_kue   = $_POST['nama_kue'];
  $harga      = $_POST['harga'];
  $stok       = $_POST['stok'];
  $deskripsi  = $_POST['deskripsi'];
  $id_kategori= $_POST['id_kategori'];

  $foto = $_FILES['foto']['name'];
  $tmp  = $_FILES['foto']['tmp_name'];

  if($foto != ""){

    $namaFoto = time()."_".$foto;

    move_uploaded_file(
      $tmp,
      "img/".$namaFoto
    );

  }else{

    $namaFoto = "";

  }

  mysqli_query($conn,"
  INSERT INTO produk
  (
    nama_kue,
    harga,
    stok,
    foto,
    deskripsi,
    id_kategori
  )
  VALUES
  (
    '$nama_kue',
    '$harga',
    '$stok',
    '$namaFoto',
    '$deskripsi',
    '$id_kategori'
  )
  ");

  header("Location: produk.php");
}

if(isset($_POST['update_stok'])){

  $id_produk = $_POST['id_produk'];
  $stok = $_POST['stok'];

  mysqli_query($conn,"
  UPDATE produk
  SET stok='$stok'
  WHERE id_produk='$id_produk'
  ");
}

if(isset($_GET['hapus'])){

  $id = $_GET['hapus'];

  mysqli_query($conn,"
  DELETE FROM produk
  WHERE id_produk='$id'
  ");

  header("Location: produk.php");
}

if(isset($_POST['edit_produk'])){

  $id_produk   = $_POST['id_produk'];
  $nama_kue    = $_POST['nama_kue'];
  $harga       = $_POST['harga'];
  $id_kategori = $_POST['id_kategori'];

  mysqli_query($conn,"
  UPDATE produk
  SET
    nama_kue='$nama_kue',
    harga='$harga',
    id_kategori='$id_kategori'
  WHERE id_produk='$id_produk'
  ");

  header("Location: produk.php");
}

$data = mysqli_query($conn,"
SELECT produk.*, kategori.nama_kategori
FROM produk
LEFT JOIN kategori
ON produk.id_kategori = kategori.id_kategori
");

$kategori = mysqli_query($conn,"
SELECT * FROM kategori
");

$editData = null;

if(isset($_GET['edit'])){

  $id = $_GET['edit'];

  $edit = mysqli_query($conn,"
  SELECT * FROM produk
  WHERE id_produk='$id'
  ");

  $editData = mysqli_fetch_assoc($edit);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Produk</title>

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
}

.nav-left a:hover{
  background:#c97d7d;
  color:white;
}

.nav-left a.active{
  background:#c97d7d;
  color:white;
}

.container{
  padding:30px;
}

.top-bar{
  margin-bottom:20px;
}

.add-btn{
  background:#c97d7d;
  color:white;
  padding:12px 20px;
  border:none;
  border-radius:20px;
  cursor:pointer;
  text-decoration:none;
}

table{
  width:100%;
  border-collapse:collapse;
}

th,td{
  border:2px solid #8B5A2B;
  padding:12px;
  text-align:center;
}

th{
  background:#c97d7d;
  color:white;
}

td{
  background:#f3cfcf;
}

.action-btn{
  padding:6px 14px;
  border:none;
  border-radius:20px;
  cursor:pointer;
  text-decoration:none;
  display:inline-block;
  margin:2px;
}

.edit-btn{
  background:#f4f6d2;
  color:black;
}

.delete-btn{
  background:#ffc5c9;
  color:black;
}

.save-btn{
  background:#c97d7d;
  color:white;
}

.stok-input{
  width:70px;
  padding:6px;
  border-radius:10px;
  border:1px solid #999;
  text-align:center;
}

.habis{
  color:red;
  font-weight:bold;
}

.tersedia{
  color:green;
  font-weight:bold;
}

.modal{
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.5);
  display:flex;
  justify-content:center;
  align-items:center;
}

.modal-box{
  background:white;
  padding:25px;
  border-radius:20px;
  width:350px;
}

.modal-box h2{
  margin-top:0;
}

.modal-box input,
.modal-box textarea,
.modal-box select{
  width:100%;
  padding:10px;
  margin-bottom:12px;
  border-radius:10px;
  border:1px solid #999;
  box-sizing:border-box;
}

.modal-box button{
  padding:10px 18px;
  border:none;
  border-radius:20px;
  cursor:pointer;
}

img{
  width:80px;
  border-radius:10px;
}

</style>
</head>

<body>

<div class="navbar">

  <div class="nav-left">

    <a href="dashboard-admin.php">
      DASHBOARD
    </a>

    <a href="produk.php" class="active">
      MANAJEMEN PRODUK
    </a>

    <a href="pesanan.php">
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

</div>

<div class="container">

<div class="top-bar">

<a href="produk.php?tambah=1" class="add-btn">
+ Tambah Produk
</a>

</div>

<table>

<thead>

<tr>
<th>Gambar</th>
<th>Nama Produk</th>
<th>Kategori</th>
<th>Harga</th>
<th>Stok</th>
<th>Status</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

<?php while($d = mysqli_fetch_assoc($data)) { ?>

<tr>

<td>

<?php if($d['foto'] != ""){ ?>

<img src="img/<?= $d['foto']; ?>">

<?php } ?>

</td>

<td>
<?= $d['nama_kue']; ?>
</td>

<td>
<?= $d['nama_kategori']; ?>
</td>

<td>
Rp <?= number_format($d['harga']); ?>
</td>

<td>

<form method="POST">

<input
type="hidden"
name="id_produk"
value="<?= $d['id_produk']; ?>"
>

<input
type="number"
name="stok"
value="<?= $d['stok']; ?>"
class="stok-input"
min="0"
>

<button
type="submit"
name="update_stok"
class="action-btn save-btn">
Simpan
</button>

</form>

</td>

<td>

<?php if($d['stok'] <= 0){ ?>

<span class="habis">
HABIS
</span>

<?php } else { ?>

<span class="tersedia">
TERSEDIA
</span>

<?php } ?>

</td>

<td>

<a
href="produk.php?edit=<?= $d['id_produk']; ?>"
class="action-btn edit-btn">
Edit
</a>

<a
href="produk.php?hapus=<?= $d['id_produk']; ?>"
class="action-btn delete-btn"
onclick="return confirm('Yakin ingin hapus produk?')">
Hapus
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php if(isset($_GET['tambah'])) { ?>

<div class="modal">

<div class="modal-box">

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="nama_kue"
placeholder="Nama Produk"
required
>

<input
type="number"
name="harga"
placeholder="Harga"
required
>

<input
type="number"
name="stok"
placeholder="Stok"
required
>

<textarea
name="deskripsi"
placeholder="Deskripsi Produk">
</textarea>

<select name="id_kategori" required>

<option value="">
Pilih Kategori
</option>

<?php
$kat = mysqli_query($conn,"
SELECT * FROM kategori
");

while($k = mysqli_fetch_assoc($kat)){
?>

<option value="<?= $k['id_kategori']; ?>">
<?= $k['nama_kategori']; ?>
</option>

<?php } ?>

</select>

<input
type="file"
name="foto"
required
>

<button
type="submit"
name="tambah_produk"
class="save-btn">
Tambah Produk
</button>

<a
href="produk.php"
class="action-btn delete-btn">
Batal
</a>

</form>

</div>

</div>

<?php } ?>

<?php if($editData) { ?>

<div class="modal">

<div class="modal-box">

<h2>Edit Produk</h2>

<form method="POST">

<input
type="hidden"
name="id_produk"
value="<?= $editData['id_produk']; ?>"
>

<input
type="text"
name="nama_kue"
value="<?= $editData['nama_kue']; ?>"
required
>

<input
type="number"
name="harga"
value="<?= $editData['harga']; ?>"
required
>

<select name="id_kategori" required>

<?php
$kat2 = mysqli_query($conn,"
SELECT * FROM kategori
");

while($k2 = mysqli_fetch_assoc($kat2)){
?>

<option
value="<?= $k2['id_kategori']; ?>"
<?= $k2['id_kategori'] == $editData['id_kategori'] ? "selected" : ""; ?>
>
<?= $k2['nama_kategori']; ?>
</option>

<?php } ?>

</select>

<button
type="submit"
name="edit_produk"
class="save-btn">
Simpan Perubahan
</button>

<a
href="produk.php"
class="action-btn delete-btn">
Batal
</a>

</form>

</div>

</div>

<?php } ?>

</body>
</html>