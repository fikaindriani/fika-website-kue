<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Produk - Zeya's Bakery</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

body{
  background:#f8dfe3;
  color:#4a2c2c;
}

/* NAVBAR */
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
}

.menu a{
  text-decoration:none;
  color:white;
  margin:0 15px;
  font-weight:500;
  position:relative;
}

.menu a::after{
  content:'';
  position:absolute;
  left:0;
  bottom:-6px;
  width:0%;
  height:3px;
  background:white;
  transition:0.3s;
}

.menu a:hover::after{
  width:100%;
}

/* CONTAINER */
.container{
  display:grid;
  grid-template-columns:1fr 1.2fr;
  gap:50px;
  padding:60px;
  align-items:start;
}

/* IMAGE */
.img-box{
  background:white;
  padding:15px;
  border-radius:25px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.img-box img{
  width:100%;
  height:420px;
  object-fit:cover;
  border-radius:20px;
}

/* DETAIL */
.detail{
  padding:10px;
}

.title{
  font-size:32px;
  font-weight:700;
  color:#6d4348;
  margin-bottom:10px;
}

.price{
  font-size:22px;
  color:#b57c83;
  font-weight:700;
  margin-bottom:20px;
}

.desc{
  line-height:1.8;
  margin-bottom:20px;
  color:#6b4a4a;
}

/* INFO BOX */
.info{
  background:white;
  padding:18px;
  border-radius:20px;
  margin-bottom:15px;
  box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

.info h4{
  color:#b57c83;
  margin-bottom:6px;
}

/* ADD TO CART BUTTON */
.cart-btn{
  margin-top:20px;
  background:#b57c83;
  color:white;
  border:none;
  padding:14px 22px;
  border-radius:25px;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
  display:inline-flex;
  align-items:center;
  gap:8px;
}

.cart-btn:hover{
  background:#6d4348;
  transform:translateY(-2px);
}

/* RESPONSIVE */
@media(max-width:900px){
  .container{
    grid-template-columns:1fr;
    padding:25px;
  }

  .img-box img{
    height:300px;
  }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
  <div class="logo">🍪 Zeya's Bakery</div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>
</div>

<!-- CONTENT -->
<div class="container">

  <!-- IMAGE -->
  <div class="img-box">
    <img id="img">
  </div>

  <!-- DETAIL -->
  <div class="detail">

    <div class="title" id="name">Produk</div>
    <div class="price" id="price">Rp 0</div>

    <div class="desc">
      Produk bakery premium homemade dengan bahan berkualitas tinggi,
      fresh setiap hari, tekstur lembut dan rasa seimbang.
    </div>

    <div class="info">
      <h4>Deskripsi</h4>
      Dibuat tanpa pengawet dan cocok untuk semua kalangan.
    </div>

    <div class="info">
      <h4>Keunggulan</h4>
      ✔ Fresh daily<br>
      ✔ Handmade<br>
      ✔ Premium ingredients
    </div>

    <!-- REPLACE BEST SELLER -->
    <button class="cart-btn" onclick="addToCart()">
      🛒 Add To Cart
    </button>

  </div>

</div>

<script>

const url = new URLSearchParams(window.location.search);

document.getElementById("name").innerText =
  url.get("name") || "Produk";

document.getElementById("img").src =
  url.get("image") || "img/default.jpg";

document.getElementById("price").innerText =
  "Rp " + parseInt(url.get("price") || 0).toLocaleString("id-ID");

function addToCart(){

  let item = {
    name: document.getElementById("name").innerText,
    price: parseInt(document.getElementById("price").innerText.replace(/\D/g,'')),
    image: document.getElementById("img").src,
    quantity: 1
  };

  let cart = JSON.parse(localStorage.getItem("zeyaCart")) || [];

  let existing = cart.find(p => p.name === item.name);

  if(existing){
    existing.quantity += 1;
  } else {
    cart.push(item);
  }

  localStorage.setItem("zeyaCart", JSON.stringify(cart));

  alert("Berhasil ditambahkan ke cart 🛒");
}

</script>

</body>
</html>