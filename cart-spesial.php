<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart - Zeya's Bakery</title>

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

.nav-right{
  display:flex;
  align-items:center;
  gap:15px;
}

.back-btn{
  background:white;
  border:none;
  padding:10px 18px;
  border-radius:30px;
  cursor:pointer;
  font-weight:600;
  color:#b57c83;
  transition:0.3s;
}

.back-btn:hover{
  background:#6d4348;
  color:white;
}

.container{
  padding:50px;
}

.title{
  text-align:center;
  font-size:35px;
  color:#6d4348;
  margin-bottom:35px;
  font-weight:700;
}

.cart-item{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:20px;
  background:white;
  padding:20px;
  border-radius:25px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

.left{
  display:flex;
  align-items:center;
  gap:20px;
}

.left img{
  width:120px;
  height:120px;
  object-fit:cover;
  border-radius:20px;
}

.info h3{
  font-size:22px;
  color:#6d4348;
  margin-bottom:8px;
}

.info p{
  color:#7a5b5b;
  margin:5px 0;
}

.qty-box{
  display:flex;
  align-items:center;
  gap:15px;
}

.qty-btn{
  width:40px;
  height:40px;
  border:none;
  border-radius:50%;
  background:#b57c83;
  color:white;
  font-size:20px;
  cursor:pointer;
  transition:0.3s;
}

.qty-btn:hover{
  background:#6d4348;
}

.qty-number{
  font-size:20px;
  font-weight:600;
}

.subtotal{
  text-align:right;
}

.subtotal h3{
  color:#b57c83;
  margin-top:8px;
}

.bottom-box{
  margin-top:40px;
  background:white;
  padding:30px;
  border-radius:25px;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
  text-align:center;
}

.total{
  font-size:30px;
  color:#6d4348;
  font-weight:700;
  margin-bottom:20px;
}

.checkout-btn{
  background:#b57c83;
  color:white;
  border:none;
  padding:15px 30px;
  border-radius:30px;
  font-size:17px;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
}

.checkout-btn:hover{
  background:#6d4348;
  transform:translateY(-2px);
}

.empty{
  text-align:center;
  padding:60px;
  background:white;
  border-radius:25px;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

@media(max-width:900px){

  .container{
    padding:25px;
  }

  .cart-item{
    flex-direction:column;
    align-items:flex-start;
  }

  .left{
    flex-direction:column;
    align-items:flex-start;
  }

  .navbar{
    flex-direction:column;
    gap:15px;
  }

}

</style>
</head>

<body>

<div class="navbar">

  <div class="logo">
    🍪 Zeya's Bakery
  </div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

  <div class="nav-right">

    <button onclick="goBack()" class="back-btn">
      ← Back
    </button>

  </div>

</div>

<div class="container">

  <div class="title">
    🛒 Cart Kamu
  </div>

  <div id="cartContainer"></div>

  <div class="bottom-box">

    <div class="total">
      Total : Rp <span id="total">0</span>
    </div>

    <button class="checkout-btn" onclick="checkout()">
      Checkout Sekarang
    </button>

  </div>

</div>

<script>

function getCart(){

  return JSON.parse(
    localStorage.getItem("zeyaCart")
  ) || [];

}

function saveCart(cart){

  localStorage.setItem(
    "zeyaCart",
    JSON.stringify(cart)
  );

}

function formatRupiah(angka){

  return angka.toString().replace(
    /\B(?=(\d{3})+(?!\d))/g,
    "."
  );

}

function renderCart(){

  let cart = getCart();

  let container =
  document.getElementById("cartContainer");

  container.innerHTML = "";

  let total = 0;

  if(cart.length === 0){

    container.innerHTML = `
      <div class="empty">
        <h2>Cart masih kosong 🥺</h2>
      </div>
    `;

    document.getElementById("total").innerText = "0";

    return;

  }

  cart.forEach((item,index)=>{

    let subtotal =
    item.price * item.quantity;

    total += subtotal;

    container.innerHTML += `

      <div class="cart-item">

        <div class="left">

          <img src="${item.image}">

          <div class="info">

            <h3>${item.name}</h3>

            <p>
              Harga :
              Rp ${formatRupiah(item.price)}
            </p>

            <p>
              Stok :
              ${item.stok || 20}
            </p>

          </div>

        </div>

        <div class="qty-box">

          <button
          class="qty-btn"
          onclick="minus(${index})">
            -
          </button>

          <div class="qty-number">
            ${item.quantity}
          </div>

          <button
          class="qty-btn"
          onclick="plus(${index})">
            +
          </button>

        </div>

        <div class="subtotal">

          <p>Subtotal</p>

          <h3>
            Rp ${formatRupiah(subtotal)}
          </h3>

        </div>

      </div>

    `;

  });

  document.getElementById("total").innerText =
  formatRupiah(total);

}

function plus(i){

  let cart = getCart();

  cart[i].quantity++;

  saveCart(cart);

  renderCart();

}

function minus(i){

  let cart = getCart();

  if(cart[i].quantity > 1){

    cart[i].quantity--;

  } else {

    cart.splice(i,1);

  }

  saveCart(cart);

  renderCart();

}

function checkout(){

  alert("Checkout berhasil 🛒✨");

  localStorage.removeItem("zeyaCart");

  renderCart();

}

function goBack(){

  window.history.back();

}

renderCart();

</script>

</body>
</html>