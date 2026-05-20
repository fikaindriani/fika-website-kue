<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sweet Cake Collection</title>

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

.cart-box{
  position:relative;
  cursor:pointer;
  background:white;
  padding:10px;
  border-radius:50%;
  transition:0.3s;
}

.cart-box:hover{
  transform:scale(1.08);
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
  width:20px;
  height:20px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:bold;
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
  font-size:25px;
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

  <div class="logo">🍰 Zeya's Bakery</div>

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
  <h1>Sweet Cake Collection</h1>
  <p>Freshly baked cakes made with love & sweetness ✨</p>
</div>

<div class="container">

<div class="grid">

<div class="card">
<img src="img/strawberry-shortcake.jpg">

<div class="card-content">
<h3>Strawberry Shortcake</h3>
<div class="price">Rp120.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Strawberry Shortcake',120000,'img/strawberry-shortcake.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Strawberry Shortcake',120000,'img/strawberry-shortcake.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/mango-cake.jpg">

<div class="card-content">
<h3>Mango Delight Cake</h3>
<div class="price">Rp125.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Mango Delight Cake',125000,'img/mango-cake.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Mango Delight Cake',125000,'img/mango-cake.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/mixed-fruit-cake.jpg">

<div class="card-content">
<h3>Mixed Fruit Cake</h3>
<div class="price">Rp130.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Mixed Fruit Cake',130000,'img/mixed-fruit-cake.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Mixed Fruit Cake',130000,'img/mixed-fruit-cake.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/choco-fudge.jpg">

<div class="card-content">
<h3>Chocolate Fudge Cake</h3>
<div class="price">Rp135.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Chocolate Fudge Cake',135000,'img/choco-fudge.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Chocolate Fudge Cake',135000,'img/choco-fudge.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/dark-choco.jpg">

<div class="card-content">
<h3>Dark Chocolate Cake</h3>
<div class="price">Rp140.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Dark Chocolate Cake',140000,'img/dark-choco.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Dark Chocolate Cake',140000,'img/dark-choco.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/lava-cake.jpg">

<div class="card-content">
<h3>Choco Lava Cake</h3>
<div class="price">Rp130.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Choco Lava Cake',130000,'img/lava-cake.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Choco Lava Cake',130000,'img/lava-cake.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/vanilla-cake.jpg">

<div class="card-content">
<h3>Vanilla Cream Cake</h3>
<div class="price">Rp120.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Vanilla Cream Cake',120000,'img/vanilla-cake.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Vanilla Cream Cake',120000,'img/vanilla-cake.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/black-forest.jpg">

<div class="card-content">
<h3>Black Forest Cake</h3>
<div class="price">Rp135.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Black Forest Cake',135000,'img/black-forest.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Black Forest Cake',135000,'img/black-forest.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/red-velvet.jpg">

<div class="card-content">
<h3>Red Velvet Cake</h3>
<div class="price">Rp140.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Red Velvet Cake',140000,'img/red-velvet.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Red Velvet Cake',140000,'img/red-velvet.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/classic-cheese.jpg">

<div class="card-content">
<h3>Classic Cheesecake</h3>
<div class="price">Rp130.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Classic Cheesecake',130000,'img/classic-cheese.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Classic Cheesecake',130000,'img/classic-cheese.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/matcha-cheese.jpg">

<div class="card-content">
<h3>Matcha Cheesecake</h3>
<div class="price">Rp135.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Matcha Cheesecake',135000,'img/matcha-cheese.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Matcha Cheesecake',135000,'img/matcha-cheese.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/biscoff-cheese.jpg">

<div class="card-content">
<h3>Lotus Biscoff Cheesecake</h3>
<div class="price">Rp140.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Lotus Biscoff Cheesecake',140000,'img/biscoff-cheese.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Lotus Biscoff Cheesecake',140000,'img/biscoff-cheese.jpg')">
Detail
</button>
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
  }else{
    cart.push({
      name:name,
      image:image,
      price:price,
      quantity:1
    });
  }

  saveCart(cart);

  updateCartCount();

  alert(name + " berhasil ditambahkan ke cart 🛒");

}

function showDetail(name, price, image){

  let url = "cart-cake.php?name="
          + encodeURIComponent(name)
          + "&price=" + price
          + "&image=" + encodeURIComponent(image);

  window.location.href = url;

}

function updateCartCount(){

  let cart = getCart();

  let count = cart.reduce((sum,item)=> sum + item.quantity,0);

  document.getElementById("cartCount").innerText = count;

}

function goToCart(){

  window.location.href = "cart.php";

}

updateCartCount();

</script>

</body>
</html>