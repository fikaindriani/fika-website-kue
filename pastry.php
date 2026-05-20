<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sweet Pastry Collection</title>

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

  <div class="logo">🥐 Zeya's Bakery</div>

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
  <h1>Sweet Pastry Collection</h1>
  <p>Flaky, buttery & freshly baked pastry for your sweet cravings ✨</p>
</div>

<div class="container">

<div class="grid">

<div class="card">
<img src="img/croissant.jpg">

<div class="card-content">
<h3>Butter Croissant</h3>
<div class="price">Rp25.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Butter Croissant',25000,'img/croissant.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Butter Croissant',25000,'img/croissant.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/puff.jpg">

<div class="card-content">
<h3>Puff Pastry</h3>
<div class="price">Rp23.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Puff Pastry',23000,'img/puff.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Puff Pastry',23000,'img/puff.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/choco-croissant.jpg">

<div class="card-content">
<h3>Chocolate Croissant</h3>
<div class="price">Rp28.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Chocolate Croissant',28000,'img/choco-croissant.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Chocolate Croissant',28000,'img/choco-croissant.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/cheese.jpg">

<div class="card-content">
<h3>Cheese Puff</h3>
<div class="price">Rp24.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Cheese Puff',24000,'img/cheese.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Cheese Puff',24000,'img/cheese.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/chicken.jpg">

<div class="card-content">
<h3>Chicken Puff</h3>
<div class="price">Rp26.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Chicken Puff',26000,'img/chicken.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Chicken Puff',26000,'img/chicken.jpg')">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/blueberry.jpg">

<div class="card-content">
<h3>Blueberry Pastry</h3>
<div class="price">Rp27.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Blueberry Pastry',27000,'img/blueberry.jpg')">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Blueberry Pastry',27000,'img/blueberry.jpg')">
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

  let existing = cart.find(item =>
    item.name === name && item.size === "Small"
  );

  if(existing){
    existing.quantity += 1;
  } else {
    cart.push({
      name:name,
      image:image,
      price:price,
      quantity:1,
      size:"Small"
    });
  }

  saveCart(cart);

  let url = "cart-pastry.php?name="
          + encodeURIComponent(name)
          + "&price=" + price
          + "&image=" + encodeURIComponent(image);

  window.location.href = url;

}

function showDetail(name, price, image){

  let url = "cart-pastry.php?name="
          + encodeURIComponent(name)
          + "&price=" + price
          + "&image=" + encodeURIComponent(image);

  window.location.href = url;

}

function updateCartCount(){

  let cart = getCart();

  let count = cart.reduce((sum, item) => sum + item.quantity, 0);

  document.getElementById("cartCount").innerText = count;

}

function goToCart(){

  window.location.href = "cart.php";

}

updateCartCount();

</script>

</body>
</html>