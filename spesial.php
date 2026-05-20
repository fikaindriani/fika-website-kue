<?php
session_start();
include "koneksi.php";

if(!$conn){
  die("Koneksi database gagal: " . mysqli_connect_error());
}

$data = mysqli_query($conn,"
SELECT produk.*, kategori.nama_kategori
FROM produk
LEFT JOIN kategori
ON produk.id_kategori = kategori.id_kategori
WHERE produk.id_kategori = 6
ORDER BY produk.id_produk DESC
");

if(!$data){
  die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Spesial Kue Kering Premium</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  font-family:'Poppins', sans-serif;
  background:#f8dfe3;
  overflow-x:hidden;
}

.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:18px 45px;
  background:rgba(181,124,131,0.95);
  backdrop-filter:blur(10px);
  position:sticky;
  top:0;
  z-index:999;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.logo{
  background:white;
  color:#b57c83;
  padding:10px 20px;
  border-radius:50px;
  font-weight:700;
  font-size:18px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.menu{
  display:flex;
  gap:35px;
  flex-wrap:wrap;
}

.menu a{
  text-decoration:none;
  color:white;
  font-weight:500;
  position:relative;
  transition:0.3s;
}

.menu a::after{
  content:'';
  position:absolute;
  left:0;
  bottom:-6px;
  width:0%;
  height:3px;
  background:white;
  border-radius:10px;
  transition:0.3s;
}

.menu a:hover::after{
  width:100%;
}

.hero{
  text-align:center;
  padding:70px 20px 50px;
}

.hero h1{
  font-size:55px;
  color:#6d4348;
  margin-bottom:15px;
}

.hero p{
  color:#7d5a5f;
  font-size:18px;
}

.container{
  padding:20px 50px 70px;
}

.grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:40px;
}

.card{
  background:white;
  border-radius:28px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  transition:0.4s;
}

.card:hover{
  transform:translateY(-10px);
  box-shadow:0 18px 40px rgba(0,0,0,0.12);
}

.card img{
  width:100%;
  height:320px;
  object-fit:cover;
  transition:0.4s;
}

.card:hover img{
  transform:scale(1.05);
}

.card-content{
  padding:25px;
}

.card h3{
  color:#6d4348;
  margin-bottom:12px;
  font-size:24px;
}

.price{
  color:#b57c83;
  font-weight:700;
  margin-bottom:22px;
  font-size:22px;
}

.btn-group{
  display:flex;
  gap:12px;
}

.btn{
  flex:1;
  padding:14px;
  border:none;
  border-radius:16px;
  cursor:pointer;
  font-weight:600;
  font-size:15px;
  transition:0.3s;
}

.cart-btn{
  background:#b57c83;
  color:white;
}

.cart-btn:hover{
  background:#5a3e2b;
}

.detail-btn{
  background:white;
  color:#b57c83;
  border:2px solid #b57c83;
}

.detail-btn:hover{
  background:#b57c83;
  color:white;
}

.empty{
  text-align:center;
  font-size:22px;
  color:#6d4348;
  margin-top:50px;
}

@media(max-width:1100px){

  .grid{
    grid-template-columns:repeat(2,1fr);
  }

}

@media(max-width:700px){

  .navbar{
    flex-direction:column;
    gap:15px;
    padding:20px;
  }

  .menu{
    justify-content:center;
    gap:20px;
  }

  .hero h1{
    font-size:38px;
  }

  .container{
    padding:20px;
  }

  .grid{
    grid-template-columns:1fr;
  }

  .btn-group{
    flex-direction:column;
  }

}

</style>
</head>

<body>

<div class="navbar">

  <div class="logo">🎁 Zeya's Bakery</div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

</div>

<div class="hero">
  <h1>Spesial Kue Kering Premium</h1>
  <p>Koleksi kue lebaran homemade, manis, dan premium ✨</p>
</div>

<div class="container">

<div class="grid">

<?php
if(mysqli_num_rows($data) > 0){
  while($d = mysqli_fetch_assoc($data)){
?>

<div class="card">

<img src="img/<?= $d['foto']; ?>">

<div class="card-content">

<h3><?= htmlspecialchars($d['nama_kue']); ?></h3>

<div class="price">
Rp<?= number_format($d['harga']); ?>
</div>

<div class="btn-group">

<button
class="btn cart-btn"
onclick='addToCart("<?= htmlspecialchars($d['nama_kue']); ?>", <?= $d['harga']; ?>, "img/<?= $d['foto']; ?>")'>
Add To Cart
</button>

<button
class="btn detail-btn"
onclick='showDetail("<?= htmlspecialchars($d['nama_kue']); ?>", <?= $d['harga']; ?>, "img/<?= $d['foto']; ?>")'>
Detail
</button>

</div>
</div>
</div>

<?php
  }
}else{
?>

<div class="empty">
🎁 Belum ada produk spesial. Yuk tambah produk baru!
</div>

<?php } ?>

</div>
</div>

<script>

function getCart(){
  let cart = localStorage.getItem("zeyaCart");
  if(cart){
    return JSON.parse(cart);
  }
  return [];
}

function saveCart(cart){
  localStorage.setItem("zeyaCart", JSON.stringify(cart));
}

function addToCart(name, price, image){
  let cart = getCart();
  let existing = cart.find(item => item.name === name);
  
  if(existing){
    existing.quantity += 1;
  }else{
    cart.push({
      name: name,
      image: image,
      price: price,
      quantity: 1
    });
  }
  
  saveCart(cart);
  updateCartCount();
  alert(name + " berhasil ditambahkan ke cart 🛒");
}

function showDetail(name, price, image){
  let url = "cart-spesial.php?name=" + encodeURIComponent(name) + "&price=" + price + "&image=" + encodeURIComponent(image);
  window.location.href = url;
}

function updateCartCount(){
  let cart = getCart();
  let count = 0;
  for(let i = 0; i < cart.length; i++){
    count += cart[i].quantity;
  }
  let cartCountElem = document.getElementById("cartCount");
  if(cartCountElem){
    cartCountElem.innerText = count;
  }
}

function goToCart(){
  window.location.href = "cart.php";
}

updateCartCount();

</script>

</body>
</html>
