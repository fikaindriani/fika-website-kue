<?php
$conn = mysqli_connect("localhost","root","","db_kue");

$dataProduk = [];

$query = mysqli_query($conn,"SELECT * FROM produk");

while($d = mysqli_fetch_assoc($query)){

  $dataProduk[] = [
    "nama" => $d['nama_kue'],
    "stok" => $d['stok']
  ];

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zeya Cart</title>

<style>
body{
  margin:0;
  font-family:'Poppins',sans-serif;
  background:#f8dfe3;
  color:#4a2c2c;
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
  gap:25px;
}

.menu a{
  text-decoration:none;
  color:white;
  font-weight:500;
}

.container{
  padding:30px 50px;
}

.item{
  display:flex;
  gap:15px;
  background:white;
  padding:15px;
  border-radius:20px;
  margin-bottom:15px;
  align-items:center;
  box-shadow:0 10px 20px rgba(0,0,0,0.06);
}

.item img{
  width:90px;
  height:90px;
  object-fit:cover;
  border-radius:15px;
}

.qty-btn{
  width:28px;
  height:28px;
  border:none;
  border-radius:50%;
  background:#b57c83;
  color:white;
  cursor:pointer;
}

.qty-btn:disabled{
  background:gray;
  cursor:not-allowed;
}

.delete{
  background:#a94444;
  color:white;
  border:none;
  padding:5px 10px;
  border-radius:10px;
  cursor:pointer;
}

.total-box{
  margin-top:20px;
  padding:20px;
  background:white;
  border-radius:20px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  box-shadow:0 10px 20px rgba(0,0,0,0.06);
}

.checkout{
  background:#b57c83;
  color:white;
  border:none;
  padding:10px 20px;
  border-radius:20px;
  cursor:pointer;
}

.habis{
  color:red;
  font-weight:bold;
}

.tersedia{
  color:green;
  font-weight:bold;
}
</style>
</head>

<body>

<div class="navbar">

  <div class="logo">
    🍪 Zeya Cart
  </div>

  <div class="menu">
    <a href="index.php">Home</a>
    <a href="index.php#categories">Categories</a>
    <a href="index.php#about">About</a>
    <a href="index.php#contact">Contact</a>
  </div>

</div>

<div class="container">

  <div id="cartList"></div>

  <div class="total-box">

    <h3>
      Total: Rp
      <span id="totalAll">0</span>
    </h3>

    <button class="checkout" onclick="checkout()">
      Checkout
    </button>

  </div>

</div>

<script>

let cart =
JSON.parse(localStorage.getItem("zeyaCart")) || [];

let produkDB =
<?= json_encode($dataProduk); ?>;

function format(num){
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
}

function getStok(namaProduk){

  let produk = produkDB.find(p => p.nama === namaProduk);

  return produk ? parseInt(produk.stok) : 0;
}

function render(){

  let html = "";

  if(cart.length === 0){

    document.getElementById("cartList").innerHTML =
    "<p>Cart kosong 😢</p>";

    document.getElementById("totalAll").innerText =
    "0";

    return;
  }

  cart.forEach((item,i)=>{

    if(item.selected === undefined){
      item.selected = false;
    }

    let stokProduk =
    getStok(item.name);

    let stokHabis =
    stokProduk <= 0;

    html += `

    <div class="item">

      <input
      type="checkbox"
      ${item.selected ? "checked" : ""}
      onchange="pilih(${i})"
      ${stokHabis ? "disabled" : ""}
      >

      <img src="${item.image}">

      <div style="flex:1">

        <b>${item.name}</b><br>

        Rp ${format(item.price)}

        <br><br>

        Stok :
        ${stokProduk}

        <br><br>

        Qty :

        <button class="qty-btn"
        onclick="minus(${i})">
          -
        </button>

        ${item.quantity}

        <button
        class="qty-btn"
        onclick="plus(${i})"
        ${item.quantity >= stokProduk || stokHabis ? "disabled" : ""}
        >
          +
        </button>

        <br><br>

        ${
          stokHabis
          ?
          "<span class='habis'>Produk Habis</span>"
          :
          "<span class='tersedia'>Tersedia</span>"
        }

        <br><br>

        Subtotal :
        Rp ${format(item.price * item.quantity)}

        <br><br>

        <button class="delete"
        onclick="hapus(${i})">
          Hapus
        </button>

      </div>

    </div>

    `;
  });

  document.getElementById("cartList").innerHTML =
  html;

  updateTotal();
}

function pilih(i){

  cart[i].selected =
  !cart[i].selected;

  save();
}

function updateTotal(){

  let total = 0;

  cart.forEach(item => {

    if(item.selected){

      total +=
      item.price * item.quantity;

    }

  });

  document.getElementById("totalAll").innerText =
  format(total);
}

function plus(i){

  let stokProduk =
  getStok(cart[i].name);

  if(cart[i].quantity < stokProduk){

    cart[i].quantity++;

  }else{

    alert("Stok produk habis!");

  }

  save();
}

function minus(i){

  if(cart[i].quantity > 1){

    cart[i].quantity--;

  }else{

    cart.splice(i,1);

  }

  save();
}

function hapus(i){

  cart.splice(i,1);

  save();
}

function save(){

  localStorage.setItem(
    "zeyaCart",
    JSON.stringify(cart)
  );

  render();
}

function checkout(){

  let selectedItems =
  cart.filter(item => item.selected);

  if(selectedItems.length === 0){

    alert("Pilih produk dulu!");

    return;
  }

  localStorage.setItem(
    "checkoutCart",
    JSON.stringify(selectedItems)
  );

  window.location.href =
  "payment.php";
}

render();

</script>

</body>
</html>