<?php session_start(); ?>
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
}

.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:18px 45px;
  background:rgba(181,124,131,0.95);
  position:sticky;
  top:0;
  z-index:999;
  backdrop-filter:blur(10px);
}

.logo{
  background:white;
  color:#b57c83;
  padding:10px 20px;
  border-radius:50px;
  font-weight:700;
}

.menu{
  display:flex;
  gap:30px;
  flex-wrap:wrap;
}

.menu a{
  text-decoration:none;
  color:white;
  font-weight:500;
}

.cart-box{
  position:relative;
  cursor:pointer;
  background:white;
  padding:10px;
  border-radius:50%;
}

.cart-box img{
  width:28px;
}

#cartCount{
  position:absolute;
  top:-5px;
  right:-5px;
  background:#5a3e2b;
  color:white;
  font-size:12px;
  width:18px;
  height:18px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
}

.hero{
  text-align:center;
  padding:60px 20px 40px;
}

.hero h1{
  font-size:40px;
  color:#6d4348;
}

.hero p{
  color:#7d5a5f;
  margin-top:10px;
}

.container{
  padding:20px 40px 60px;
}

.grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:30px;
}

.card{
  background:white;
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-8px);
}

.card img{
  width:100%;
  height:280px;
  object-fit:cover;
}

.card-content{
  padding:20px;
}

.card h3{
  color:#6d4348;
  margin-bottom:10px;
}

.price{
  color:#b57c83;
  font-weight:700;
  margin-bottom:15px;
}

.btn-group{
  display:flex;
  gap:10px;
}

.btn{
  flex:1;
  padding:10px;
  border:none;
  border-radius:12px;
  cursor:pointer;
  font-weight:600;
}

.cart-btn{
  background:#b57c83;
  color:white;
}

.detail-btn{
  background:white;
  border:2px solid #b57c83;
  color:#b57c83;
}

.cart-btn:hover{
  background:#5a3e2b;
}

.detail-btn:hover{
  background:#b57c83;
  color:white;
}

@media(max-width:900px){
  .grid{ grid-template-columns:repeat(2,1fr); }
}

@media(max-width:600px){
  .grid{ grid-template-columns:1fr; }
  .navbar{ flex-direction:column; gap:10px; }
}

</style>
</head>

<body>

<div class="navbar">

  <div class="logo">Zeya's Bakery</div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>

    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

  <div class="cart-box" onclick="goToCart()">
    <img src="img/cart.png">
    <span id="cartCount">0</span>
  </div>

</div>

<div class="hero">
  <h1>Spesial Kue Kering Premium</h1>
  <p>Koleksi kue lebaran homemade, manis, dan premium ✨</p>
</div>

<div class="container">

<div class="grid">

<div class="card">
<img src="img/nastar.jpg">
<div class="card-content">
<h3>Nastar Premium</h3>
<div class="price">Rp80.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Nastar Premium',80000,'img/nastar.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Nastar Premium',80000,'img/nastar.jpg')">Detail</button>
</div>
</div>
</div>

<div class="card">
<img src="img/kastengel.jpg">
<div class="card-content">
<h3>Kastengel Cheese</h3>
<div class="price">Rp90.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Kastengel Cheese',90000,'img/kastengel.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Kastengel Cheese',90000,'img/kastengel.jpg')">Detail</button>
</div>
</div>
</div>

<div class="card">
<img src="img/putri-salju.jpg">
<div class="card-content">
<h3>Putri Salju</h3>
<div class="price">Rp85.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Putri Salju',85000,'img/putri-salju.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Putri Salju',85000,'img/putri-salju.jpg')">Detail</button>
</div>
</div>
</div>

<div class="card">
<img src="img/lidah-kucing.jpg">
<div class="card-content">
<h3>Lidah Kucing</h3>
<div class="price">Rp75.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Lidah Kucing',75000,'img/lidah-kucing.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Lidah Kucing',75000,'img/lidah-kucing.jpg')">Detail</button>
</div>
</div>
</div>

<div class="card">
<img src="img/semprit.jpg">
<div class="card-content">
<h3>Kue Semprit</h3>
<div class="price">Rp70.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Kue Semprit',70000,'img/semprit.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Kue Semprit',70000,'img/semprit.jpg')">Detail</button>
</div>
</div>
</div>

<div class="card">
<img src="img/sagu.jpg">
<div class="card-content">
<h3>Kue Sagu Keju</h3>
<div class="price">Rp80.000</div>
<div class="btn-group">
<button class="btn cart-btn" onclick="addToCart('Kue Sagu Keju',80000,'img/sagu.jpg')">Add</button>
<button class="btn detail-btn" onclick="showDetail('Kue Sagu Keju',80000,'img/sagu.jpg')">Detail</button>
</div>
</div>
</div>

</div>
</div>

<script>

function getCart(){
  return JSON.parse(localStorage.getItem("zeyaCart")) || [];
}

function saveCart(cart){
  localStorage.setItem("zeyaCart", JSON.stringify(cart));
}

function addToCart(name, price, image){

  let cart = getCart();

  let existing = cart.find(item => item.name === name);

  if(existing){
    existing.quantity += 1;
  } else {
    cart.push({name, price, image, quantity:1});
  }

  saveCart(cart);
  updateCartCount();

  window.location.href =
    "cart-cake.php?name=" + encodeURIComponent(name) +
    "&price=" + price +
    "&image=" + encodeURIComponent(image);
}

function showDetail(name, price, image){
  window.location.href =
    "cart-cake.php?name=" + encodeURIComponent(name) +
    "&price=" + price +
    "&image=" + encodeURIComponent(image);
}

function updateCartCount(){
  let cart = getCart();
  let count = cart.reduce((a,b)=>a+b.quantity,0);
  document.getElementById("cartCount").innerText = count;
}

function goToCart(){
  window.location.href = "cart.php";
}

updateCartCount();

</script>

</body>
</html>