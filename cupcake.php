<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sweet Cup Cake Collection</title>

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

  <div class="logo">🧁 Zeya's Bakery</div>

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
  <h1>Sweet Cup Cake Collection</h1>
  <p>Soft, creamy & colorful cupcakes made for sweet moments ✨</p>
</div>

<div class="container">

<div class="grid">

<div class="card">
<img src="img/strawberry.jpg">

<div class="card-content">
<h3>Strawberry Bliss</h3>
<div class="price">Rp30.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Strawberry Bliss','img/strawberry-cupcake.jpg',30000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Strawberry Bliss','img/strawberry-cupcake.jpg',30000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/blueberry-cupcake.jpg">

<div class="card-content">
<h3>Blueberry Dream</h3>
<div class="price">Rp32.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Blueberry Dream','img/blueberry-cupcake.jpg',32000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Blueberry Dream','img/blueberry-cupcake.jpg',32000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/mango-cupcake.jpg">

<div class="card-content">
<h3>Mango Sunshine</h3>
<div class="price">Rp30.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Mango Sunshine','img/mango-cupcake.jpg',30000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Mango Sunshine','img/mango-cupcake.jpg',30000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/choco-cupcake.jpg">

<div class="card-content">
<h3>Choco Heaven</h3>
<div class="price">Rp35.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Choco Heaven','img/choco-cupcake.jpg',35000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Choco Heaven','img/choco-cupcake.jpg',35000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/lava-cupcake.jpg">

<div class="card-content">
<h3>Choco Lava Cupcake</h3>
<div class="price">Rp35.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Choco Lava Cupcake','img/lava-cupcake.jpg',35000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Choco Lava Cupcake','img/lava-cupcake.jpg',35000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/dark-choco.jpg">

<div class="card-content">
<h3>Dark Choco Fantasy</h3>
<div class="price">Rp35.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Dark Choco Fantasy','img/dark-choco.jpg',35000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Dark Choco Fantasy','img/dark-choco.jpg',35000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/choco-creamy.jpg">

<div class="card-content">
<h3>Choco Creamy</h3>
<div class="price">Rp34.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Choco Creamy','img/choco-creamy.jpg',34000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Choco Creamy','img/choco-creamy.jpg',34000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/vanilla-cupcake.jpg">

<div class="card-content">
<h3>Vanilla Cream Cake</h3>
<div class="price">Rp30.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Vanilla Cream Cake','img/vanilla-cupcake.jpg',30000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Vanilla Cream Cake','img/vanilla-cupcake.jpg',30000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/pinky-cupcake.jpg">

<div class="card-content">
<h3>Pinky Sweet Cupcake</h3>
<div class="price">Rp32.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Pinky Sweet Cupcake','img/pinky-cupcake.jpg',32000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Pinky Sweet Cupcake','img/pinky-cupcake.jpg',32000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/velvet-cupcake.jpg">

<div class="card-content">
<h3>Velvet Bloom</h3>
<div class="price">Rp33.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Velvet Bloom','img/velvet-cupcake.jpg',33000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Velvet Bloom','img/velvet-cupcake.jpg',33000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/golden-cupcake.jpg">

<div class="card-content">
<h3>Golden Crumble</h3>
<div class="price">Rp34.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Golden Crumble','img/golden-cupcake.jpg',34000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Golden Crumble','img/golden-cupcake.jpg',34000)">
Detail
</button>
</div>
</div>
</div>

<div class="card">
<img src="img/butter-cupcake.jpg">

<div class="card-content">
<h3>Soft Butter Bliss</h3>
<div class="price">Rp30.000</div>

<div class="btn-group">
<button class="btn cart-btn"
onclick="addToCart('Soft Butter Bliss','img/butter-cupcake.jpg',30000)">
Add To Cart
</button>

<button class="btn detail-btn"
onclick="showDetail('Soft Butter Bliss','img/butter-cupcake.jpg',30000)">
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

function addToCart(name, image, price){

  let cart = getCart();

  let existing = cart.find(item => item.name === name && item.size === "Small");

  if(existing){
    existing.quantity += 1;
  }else{
    cart.push({
      name:name,
      image:image,
      price:price,
      quantity:1,
      size:"Small"
    });
  }

  saveCart(cart);

  let url = "cart-cake.php?name=" + encodeURIComponent(name)
          + "&image=" + encodeURIComponent(image)
          + "&price=" + price;

  window.location.href = url;

}

function showDetail(name, image, price){

  let url = "cart-cake.php?name=" + encodeURIComponent(name)
          + "&image=" + encodeURIComponent(image)
          + "&price=" + price;

  window.location.href = url;

}

function updateCartCount(){

  let cart = getCart();

  let count = cart.reduce((sum, item) => sum + item.quantity, 0);

  let el = document.getElementById("cartCount");

  if(el){
    el.innerText = count;
  }

}

function goToCart(){

  window.location.href = "cart.php";

}

document.addEventListener("DOMContentLoaded", function(){

  updateCartCount();

});

</script>

</body>
</html>