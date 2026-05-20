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
  background:#f3dce0;
  color:#5c383d;
}

/* NAVBAR */

.navbar{
  width:100%;
  background:#b78189;
  padding:18px 45px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.logo{
  background:white;
  padding:12px 26px;
  border-radius:50px;
  color:#b78189;
  font-weight:700;
  font-size:20px;
}

.menu{
  display:flex;
  gap:45px;
}

.menu a{
  color:white;
  text-decoration:none;
  font-weight:600;
  transition:0.3s;
}

.menu a:hover{
  opacity:0.7;
}

/* CONTAINER */

.container{
  display:grid;
  grid-template-columns:1fr 1.1fr;
  gap:60px;
  padding:60px;
  align-items:start;
}

/* IMAGE */

.img-box{
  background:#f8f3f4;
  padding:18px;
  border-radius:30px;
}

.img-box img{
  width:100%;
  height:450px;
  object-fit:cover;
  border-radius:25px;
}

/* DETAIL */

.detail{
  padding-top:10px;
}

.title{
  font-size:58px;
  font-weight:700;
  color:#6a4147;
  margin-bottom:12px;
}

.price{
  font-size:30px;
  color:#b78189;
  font-weight:700;
  margin-bottom:28px;
}

.desc{
  font-size:20px;
  line-height:1.9;
  color:#69484d;
  margin-bottom:28px;
}

/* INFO BOX */

.info{
  background:#f7f5f5;
  padding:24px;
  border-radius:25px;
  margin-bottom:22px;
}

.info h4{
  color:#b78189;
  font-size:28px;
  margin-bottom:12px;
}

.info span,
.info div{
  font-size:22px;
  line-height:1.8;
}

/* BUTTON */

.cart-btn{
  margin-top:25px;
  background:#b78189;
  color:white;
  border:none;
  padding:18px 38px;
  border-radius:50px;
  font-size:22px;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
}

.cart-btn:hover{
  background:#8c5a61;
  transform:scale(1.03);
}

@media(max-width:900px){

  .container{
    grid-template-columns:1fr;
    padding:30px;
  }

  .img-box img{
    height:320px;
  }

  .title{
    font-size:42px;
  }

  .menu{
    gap:18px;
    flex-wrap:wrap;
    justify-content:center;
  }

  .navbar{
    flex-direction:column;
    gap:18px;
  }

}

</style>
</head>

<body>

<!-- NAVBAR -->

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

</div>

<!-- CONTENT -->

<div class="container">

  <!-- IMAGE -->

  <div class="img-box">
    <img id="productImage">
  </div>

  <!-- DETAIL -->

  <div class="detail">

    <div class="title" id="productTitle">
      Produk
    </div>

    <div class="price" id="productPrice">
      Rp 90.000
    </div>

    <div class="desc">
      Produk bakery premium homemade dengan bahan berkualitas tinggi,
      fresh setiap hari, tekstur lembut dan rasa seimbang.
    </div>

    <div class="info">

      <h4>Deskripsi</h4>

      <span id="deskripsiProduk">
        Dibuat tanpa pengawet dan cocok untuk semua kalangan.
      </span>

    </div>

    <div class="info">

      <h4>Keunggulan</h4>

      <div>
        ✓ Fresh daily <br>
        ✓ Handmade <br>
        ✓ Premium ingredients
      </div>

    </div>

    <button class="cart-btn" onclick="addToCart()">
      🛒 Add To Cart
    </button>

  </div>

</div>

<script>

const urlParams =
new URLSearchParams(window.location.search);

const product = {

  name:
  urlParams.get("name") || "Produk",

  image:
  urlParams.get("image") || "img/default.jpg",

  price:
  parseInt(urlParams.get("price")) || 90000

};

document.getElementById("productTitle").innerText =
product.name;

document.getElementById("productImage").src =
product.image;

document.getElementById("productPrice").innerText =
"Rp " + formatRupiah(product.price);

let deskripsi = {

  "Croissant":
  "Croissant premium dengan lapisan pastry buttery yang renyah di luar dan lembut di dalam.",

  "Puff Pastry":
  "Puff pastry homemade dengan tekstur flaky dan aroma butter yang khas.",

  "Chocolate Cake":
  "Cake coklat premium dengan rasa manis lembut dan topping coklat melimpah.",

  "Strawberry Cake":
  "Cake strawberry fresh dengan perpaduan krim lembut dan buah strawberry segar.",

  "Cookies":
  "Cookies renyah homemade dengan rasa manis yang pas dan aroma butter lezat.",

  "Cupcake":
  "Cupcake lembut dengan topping cream premium dan tampilan cantik.",

  "Bread":
  "Roti fresh homemade dengan tekstur empuk dan aroma harum menggoda.",

  "Kastengel Cheese":
  "Kastengel keju premium dengan rasa gurih, renyah, dan aroma butter yang lezat."

};

document.getElementById("deskripsiProduk").innerText =
deskripsi[product.name] ||
"Dibuat tanpa pengawet dan cocok untuk semua kalangan.";

function formatRupiah(angka){

  return angka.toString().replace(
    /\B(?=(\d{3})+(?!\d))/g,
    "."
  );

}

function addToCart(){

  let item = {

    name: product.name,

    price: product.price,

    image: product.image,

    quantity: 1

  };

  let cart =
  JSON.parse(
    localStorage.getItem("zeyaCart")
  ) || [];

  let existing =
  cart.find(p => p.name === item.name);

  if(existing){

    existing.quantity += 1;

  } else {

    cart.push(item);

  }

  localStorage.setItem(
    "zeyaCart",
    JSON.stringify(cart)
  );

  alert("Berhasil ditambahkan ke cart 🛒");

}

</script>

</body>
</html>
