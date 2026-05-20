<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Zeya's Bakery</title>

<style>
body{
  margin:0;
  font-family: Georgia, serif;
  background:#e8bcbc;
  color:#4a2c2c;
}

.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:15px 40px;
  background:#d9a5a5;
}

.logo{
  background:#f3d6da;
  padding:10px 20px;
  border-radius:20px;
  font-weight:bold;
}

.menu a{
  margin:0 15px;
  text-decoration:none;
  color:#4a2c2c;
  font-weight:bold;
}

.nav-right{
  display:flex;
  align-items:center;
  gap:15px;
}

.back-btn{
  background:#c57474;
  border:none;
  padding:8px 15px;
  border-radius:20px;
  cursor:pointer;
  font-size:16px;
  color:white;
  font-weight:bold;
}

.cart-icon{
  font-size:22px;
  cursor:pointer;
}

.container{
  display:grid;
  grid-template-columns: 300px 1fr 280px;
  gap:40px;
  padding:20px 40px 40px;
}

.product-img img{
  width:100%;
  border-radius:20px;
}

.size-btn{
  background:#d88c8c;
  padding:12px 25px;
  border-radius:25px;
  display:inline-block;
  margin-right:10px;
  cursor:pointer;
}

.size-btn.active{
  background:#9e5f5f;
}

.qty{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:15px;
  margin:20px 0;
}

.qty button{
  width:45px;
  height:45px;
  border-radius:50%;
  border:none;
  font-size:20px;
  cursor:pointer;
}

.checkout{
  text-align:center;
}

.checkout button{
  background:#d88c8c;
  border:none;
  padding:12px 30px;
  border-radius:25px;
  cursor:pointer;
}

.divider{
  height:4px;
  background:#3a1f1f;
  margin:30px 0;
}
</style>
</head>

<body>

<div class="navbar">
  <div class="logo">Zeya’s Bakery</div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

  <div class="nav-right">
    <button onclick="goBack()" class="back-btn">← Back</button>
    <div onclick="goCart()" class="cart-icon">🛒</div>
  </div>
</div>

<h1 id="productTitle" style="padding-left:40px;"></h1>

<div class="container">

  <div class="product-img">
    <img id="productImage">
  </div>

  <div>
    <p>Small – Rp 100.000</p>
    <p>Medium – Rp 130.000</p>
    <p>Large – Rp 170.000</p>

    <div class="divider"></div>

    <h2>SIZE</h2>

    <div>
      <span class="size-btn active" onclick="setSize(100000,this)">Small</span>
      <span class="size-btn" onclick="setSize(130000,this)">Medium</span>
      <span class="size-btn" onclick="setSize(170000,this)">Large</span>
    </div>
  </div>

  <div class="checkout">
    <h2>Quantity</h2>

    <div class="qty">
      <button onclick="minus()">-</button>
      <span id="qty">1</span>
      <button onclick="plus()">+</button>
    </div>

    <button onclick="addToCart()">Cek Out</button>

    <p>Subtotal</p>
    <h2 id="subtotal">Rp 100.000</h2>
  </div>

</div>

<script>
let price = 100000;
let qty = 1;

const urlParams = new URLSearchParams(window.location.search);

const product = {
  name: urlParams.get("name"),
  image: urlParams.get("image"),
  basePrice: parseInt(urlParams.get("price")) || 100000
};

document.getElementById("productTitle").innerText = product.name;
document.getElementById("productImage").src = product.image;

function formatRupiah(angka){
  return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function setSize(newPrice, el){
  price = newPrice;
  document.querySelectorAll(".size-btn").forEach(b=>b.classList.remove("active"));
  el.classList.add("active");
  update();
}

function plus(){ qty++; update(); }

function minus(){
  if(qty > 1){ qty--; update(); }
}

function update(){
  document.getElementById("qty").innerText = qty;
  document.getElementById("subtotal").innerText = "Rp " + formatRupiah(price * qty);
}

function addToCart(){
  let size = document.querySelector(".size-btn.active").innerText;

  let url = "payment.php?name=" + encodeURIComponent(product.name)
          + "&image=" + encodeURIComponent(product.image)
          + "&price=" + price
          + "&qty=" + qty
          + "&size=" + encodeURIComponent(size);

  window.location.href = url;
}

function goCart(){
  window.location.href = "cart-cupcake.php";
}

function goBack(){
  window.location.href = "cupcake.php";
}
</script>

</body>
</html>