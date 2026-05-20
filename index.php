<?php 
session_start(); 
include "koneksi.php";

if(isset($_POST['submit_feedback'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
    
    $query = "INSERT INTO feedback (nama, pesan, tanggal) VALUES ('$nama', '$pesan', NOW())";
    
    if($conn->query($query)){
        $success = true;
    } else {
        $error = "Gagal menyimpan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Zeya's Bakery - Baked with Love</title>
<meta name="description" content="Zeya's Bakery - Baked with Love, Sweet in Every Bite.">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --brown: #3d2b1f;
    --cream: #f0e6d6;
    --pink: #d4929a;
    --pink-light: #f5e0e3;
    --gold: #c8943e;
    --brown-light: #5a3e2b;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #3d2b1f;
    background: var(--cream);
    overflow-x: hidden;
    width: 100%;
}

h1, h2, h3 {
    font-family: 'Playfair Display', serif;
}

nav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 50;
    background: transparent;
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
}

nav.scrolled {
    background: rgba(61, 43, 31, 0.95);
    backdrop-filter: blur(10px);
}

nav .container {
    max-width: 1200px;
    width: 100%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 20px;
}

nav .brand {
    background: white;
    border: none;
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: var(--brown);
    font-weight: 700;
    padding: 10px 24px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    white-space: nowrap;
}
nav .brand:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

nav .nav-links {
    display: flex;
    gap: 8px;
}

nav .nav-links a {
    background: rgba(61, 43, 31, 0.85);
    border: none;
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 500;
    padding: 10px 24px;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    backdrop-filter: blur(4px);
    white-space: nowrap;
}

nav .nav-links a:hover {
    background: var(--pink);
    transform: translateY(-2px);
}

nav .nav-links a.active {
    background: var(--pink);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

nav .icons {
    display: flex;
    align-items: center;
    gap: 8px;
}

nav .icon-btn {
    background: rgba(61, 43, 31, 0.85);
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
    padding: 8px;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
}

nav .icon-btn:hover {
    background: var(--pink);
    transform: scale(1.05);
}

.cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: var(--gold);
    color: white;
    font-size: 0.6rem;
    font-weight: bold;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

nav .login-btn {
    background: rgba(61, 43, 31, 0.85);
    border: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 700;
    color: white;
    transition: all 0.3s ease;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

nav .login-btn:hover {
    background: var(--pink);
    transform: scale(1.05);
}

.hamburger {
    display: none;
    background: rgba(61, 43, 31, 0.85);
    border: none;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 50px;
}

.hamburger:hover {
    background: var(--pink);
}

.mobile-menu {
    display: none;
    background: rgba(61, 43, 31, 0.95);
    backdrop-filter: blur(10px);
    padding: 16px;
    width: 100%;
}

.mobile-menu.open {
    display: block;
}

.mobile-menu a {
    display: block;
    padding: 12px 16px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    border-radius: 50px;
    margin-bottom: 8px;
    transition: all 0.2s;
    text-align: center;
}

.mobile-menu a:hover {
    background: var(--pink);
}

@media (max-width: 768px) {
    nav .nav-links {
        display: none;
    }
    .hamburger {
        display: block;
    }
    nav .brand {
        font-size: 0.9rem;
        padding: 6px 14px;
    }
}

.hero {
    position: relative;
    width: 100%;
    min-height: 100vh;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background-image: url('img/home.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: scroll;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(61,43,31,0.5), rgba(61,43,31,0.3));
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 20px;
    width: 100%;
    animation: fadeInUp 1s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero h1 {
    font-size: clamp(1.8rem, 6vw, 3.5rem);
    color: white;
    text-shadow: 2px 2px 12px rgba(0, 0, 0, 0.5);
    margin-bottom: 16px;
    letter-spacing: 1px;
    padding: 0 10px;
}

.hero p {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: clamp(1rem, 4vw, 1.5rem);
    color: var(--pink-light);
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    padding: 0 10px;
}

.about {
    padding: 60px 16px;
    background:var(--brown) ;
    width: 100%;
}

.about .container {
    max-width: 1000px;
    width: 100%;
    margin: auto;
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    width: 100%;
}

.section-line {
    width: 100%;
    height: 8px;
    background: #F1D1D1;
    margin: 0;
    border-radius: 0;
}

.section-title h2 {
    background: none;
    box-shadow: none;
    color: #F1D1D1;
    border-bottom: 3px solid var(--pink);
    display: inline-block;
    padding-bottom: 5px;
}
.about-grid {
    display: flex;
    gap: 40px;
    align-items: center;
    flex-wrap: wrap;
}

.about-grid {
    flex-direction: row;
}

.about-text {
    flex: 1;
    min-width: 280px;
    color: #D88989;
    font-size: 0.9rem;
    line-height: 1.7;
}

.about-text p {
    margin-bottom: 16px;
}

.about-img {
    flex: 1;
    min-width: 280px;
    height: 320px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.about-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.about-img:hover img {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .about-grid {
        flex-direction: column;
    }
    .about-img {
        order: -1;
        width: 100%;
    }
}

.categories {
    padding: 60px 16px;
    background: var(--brown);
    width: 100%;
}

.categories .section-line {
    background: var(--gold);
}

.categories .section-title h2 {
    color: #F1D1D1;
    background: none;
}

.cat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    width: 100%;
    padding: 0 80px;
    box-sizing: border-box;
}

@media (max-width: 768px) {
    .cat-grid {
        grid-template-columns: repeat(2, 1fr);
        padding: 0 20px;
    }
}

@media (max-width: 480px) {
    .cat-grid {
        grid-template-columns: 1fr;
        padding: 0 16px;
    }
}

.cat-card {
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: block;
}

.cat-card:hover {
    transform: translateY(-5px);
}

.cat-card .img-wrap {
    overflow: hidden;
    border-radius: 16px;
    aspect-ratio: 1;
    position: relative;
}

.cat-card .img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.cat-card:hover .img-wrap img {
    transform: scale(1.1);
}

.cat-card {
    position: relative;
    overflow: hidden;
}

.cat-card p {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    background: none;
    padding: 0;
}

.contact {
    padding: 60px 16px;
    background: var(--brown);
    width: 100%;
}

.contact .section-title h2 {
    color: #F1D1D1;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    max-width: 900px;
    margin: auto;
    align-items: center;
}

.contact-info a {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #e8c6c9;
    color: #8b4a4a;
    padding: 10px 14px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 10px;
    transition: 0.3s;
}

.contact-info a:hover {
    background: #d4929a;
    color: white;
    transform: translateX(5px);
}

.contact form {
    background: #e8bfc4;
    padding: 20px;
    border-radius: 16px;
    text-align: center;
}

.contact form h3 {
    color: #6b3e3e;
    margin-bottom: 10px;
}

.contact input,
.contact textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
    border: none;
    font-size: 0.8rem;
    outline: none;
}

.contact textarea {
    height: 80px;
    resize: none;
}

.contact .submit-btn {
    width: 100%;
    background: #d4929a;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 12px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.contact .submit-btn:hover {
    background: var(--gold);
}

.hours {
    font-size: 0.9rem;
}

.hours p {
    color: #f0caca;
    font-weight: 500;
    margin-bottom: 8px;
}

.hours .note {
    font-size: 0.75rem;
    margin-top: 12px;
    color: #d4929a;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }
}

.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 100;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.modal-overlay.open {
    display: flex;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal {
    background: white;
    border-radius: 28px;
    padding: 28px 24px;
    max-width: 380px;
    width: 90%;
    position: relative;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal h2 {
    text-align: center;
    font-size: 1.4rem;
    color: var(--brown);
    margin-bottom: 20px;
}

.modal .close {
    position: absolute;
    top: 16px;
    right: 20px;
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    color: var(--brown);
    transition: transform 0.2s;
}

.modal .close:hover {
    transform: scale(1.1);
}

.modal-btn {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 18px;
    border-radius: 60px;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.modal-btn:hover {
    transform: translateX(5px);
}

.modal-btn.admin {
    background: var(--brown);
    color: white;
}

.modal-btn.user {
    background: var(--pink);
    color: white;
}

.modal-btn .icon {
    font-size: 1.3rem;
}

.modal-btn .label {
    font-weight: 600;
    font-size: 1rem;
}

.modal-btn .desc {
    font-size: 0.7rem;
    opacity: 0.8;
}

.cart-modal .modal {
    max-width: 420px;
}

.cart-items {
    max-height: 300px;
    overflow-y: auto;
    margin: 16px 0;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(61, 43, 31, 0.1);
}

.cart-item-info {
    flex: 1;
}

.cart-item-name {
    font-weight: 600;
    font-size: 0.85rem;
}

.cart-item-price {
    font-size: 0.75rem;
    color: var(--pink);
}

.cart-item-remove {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    color: var(--brown);
    opacity: 0.6;
    transition: all 0.2s;
    padding: 8px;
    border-radius: 50%;
}

.cart-item-remove:hover {
    opacity: 1;
    background: rgba(212, 146, 154, 0.2);
}

.cart-total {
    text-align: right;
    font-weight: bold;
    font-size: 1rem;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 2px solid var(--pink);
}

.cart-buttons {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.cart-buttons button {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 0.85rem;
}

.btn-clear {
    background: #e0d0c0;
    color: var(--brown);
}

.btn-checkout {
    background: var(--pink);
    color: white;
}

.btn-clear:hover {
    background: #d0c0b0;
    transform: translateY(-2px);
}

.btn-checkout:hover {
    background: var(--gold);
    transform: translateY(-2px);
}

.empty-cart {
    text-align: center;
    padding: 30px;
    color: #999;
    font-size: 0.85rem;
}

.toast {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--brown);
    color: white;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 0.8rem;
    z-index: 200;
    display: none;
    animation: slideUp 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    white-space: nowrap;
}

@media (max-width: 480px) {
    .toast {
        white-space: normal;
        text-align: center;
        max-width: 90%;
    }
}

@keyframes slideUp {
    from {
        transform: translateX(-50%) translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
    }
}

footer {
    background: var(--brown);
    color: var(--cream);
    text-align: center;
    padding: 20px;
    font-size: 0.7rem;
    width: 100%;
}
.icon-btn img,
.login-btn img,
.hamburger img {
    width: 22px;
    height: 22px;
    object-fit: contain;
}

.icon-btn,
.login-btn,
.hamburger {
    background: none;
    border: none;
    cursor: pointer;
    position: relative;
}

.login-container {
    position: relative;
}

.login-dropdown {
    position: absolute;
    top: 40px;
    right: 0;
    background: #2b1b14;
    border-radius: 16px;
    padding: 10px;
    display: none;
    flex-direction: column;
    min-width: 120px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.login-dropdown a {
    text-decoration: none;
    color: #f5d0d7;
    padding: 8px;
    text-align: center;
    font-weight: bold;
    transition: 0.2s;
}

.login-dropdown a:hover {
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
}

.login-dropdown a {
    display: block;
    padding: 8px;
    text-align: center;
    font-weight: bold;
    border-radius: 10px;
    margin-bottom: 6px;
    color: #f5d0d7;
    background: transparent;
    transition: 0.2s;
}

.login-dropdown a:hover {
    background: rgba(255,255,255,0.1);
}

.login-dropdown a.active {
    background: #ffffff;
    color: #e88b9a;
}

.logout-text {
    background: rgba(61, 43, 31, 0.85);
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 500;
    padding: 10px 24px;
    border-radius: 50px;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.order-text {
    background: rgba(61, 43, 31, 0.85);
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 50px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    height: 44px;
}

.order-text:hover {
    background: var(--pink);
    transform: translateY(-2px);
}

.logout-text:hover {
    background: var(--pink);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    nav .container {
        padding: 10px 12px;
    }
    .icons {
        gap: 4px;
    }
    .logout-text {
        font-size: 0.8rem;
        padding: 6px 12px;
    }
    .hero {
        min-height: 80vh;
    }
    .about {
        padding: 40px 12px;
    }
    .cat-grid {
        padding: 0 20px !important;
        gap: 12px;
    }
    .contact {
        padding: 40px 12px;
    }
    .contact-grid {
        gap: 20px;
    }
}

@media (max-width: 480px) {
    nav .container {
        padding: 8px 10px;
    }
    nav .brand {
        font-size: 0.8rem;
        padding: 6px 10px;
    }
    .icon-btn,
    .login-btn {
        width: 36px;
        height: 36px;
    }
    .icon-btn img,
    .login-btn img {
        width: 18px;
        height: 18px;
    }
    .hero h1 {
        font-size: 1.5rem;
    }
    .hero p {
        font-size: 0.9rem;
    }
    .cat-grid {
        grid-template-columns: 1fr !important;
        padding: 0 12px !important;
    }
    .about-text {
        font-size: 0.8rem;
    }
    .contact form {
        padding: 14px;
    }
    .contact input,
    .contact textarea {
        font-size: 0.75rem;
    }
    footer {
        font-size: 0.6rem;
        padding: 14px;
    }
}
</style>
</head>
<body>

<nav id="navbar">
    <div class="container">
        <button class="brand">Zeya's Bakery</button>
        <div class="nav-links">
            <a href="#home" class="nav-link">Home</a>
            <a href="#categories" class="nav-link">Categories</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#contact" class="nav-link">Contact</a>
        </div>
        <div class="icons">
    
    <a href="cart.php" class="icon-btn" title="Cart">
        <img src="img/cart.png" alt="Cart">
        <span id="cartCount" class="cart-count" style="display: none;">0</span>
    </a>

    <a href="pesanan-user.php" class="order-text">Pesanan Saya</a>

<?php if(isset($_SESSION['user'])): ?>

    <a href="logout.php" class="logout-text">Logout</a>

<?php else: ?>

    <div class="login-container">
        <button class="login-btn" onclick="toggleLoginMenu()">
            <img src="img/login.png" alt="Login">
        </button>

        <div class="login-dropdown" id="loginDropdown">
            <a href="admin-login.php" onclick="handleClick(event, this)">ADMIN</a>
            <a href="user-login.php" onclick="handleClick(event, this)">LOGIN USER</a>
            <a href="register.php" onclick="handleClick(event, this)">REGISTER</a>
        </div>
    </div>

<?php endif; ?>
</div>
    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="toggleMenu()">Home</a>
        <a href="#categories" onclick="toggleMenu()">Categories</a>
        <a href="#about" onclick="toggleMenu()">About</a>
        <a href="#contact" onclick="toggleMenu()">Contact</a>
        <a href="pesanan-user.php" onclick="toggleMenu()">Pesanan Saya</a>
    </div>
</nav>

<section class="hero" id="home">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Welcome to Zeya's Bakery </h1>
        <p>Baked with Love, Sweet in Every Bite.</p>
    </div>
</section>

<div class="section-line"></div>

<section class="about" id="about">
    <div class="container">
        <div class="section-title">
            <h2>About Zeya's Bakery</h2>
        </div>
        <div class="about-grid">
            <div class="about-text">
                <p>Zeya's Bakery adalah toko kue yang menyediakan berbagai pilihan cake, cookies, dan dessert dengan cita rasa terbaik. Semua produk kami dibuat dengan bahan berkualitas dan penuh cinta untuk menghadirkan kebahagiaan di setiap momen spesial Anda.</p>
                <p>Kami percaya bahwa setiap kue memiliki cerita, dan kami ingin menjadi bagian dari cerita indah Anda. Dengan pelayanan terbaik dan produk berkualitas, Zeya's Bakery siap menemani setiap perayaan Anda.</p>
            </div>
            <div class="about-img">
                <img src="img/aboute.jpg" alt="Zeya's Bakery">
            </div>
        </div>
    </div>
</section>

<div class="section-line"></div>

<section class="categories" id="categories">
    <div class="container">
        <div class="section-title">
            <h2>Explore Our Sweet Categories</h2>
        </div>
        <div class="cat-grid">
            
            <a href="cake.php" class="cat-card" target="_blank">
                <div class="img-wrap"><img src="img/cake.jpg" alt="Cake"></div>
                <p>Cake (Kue Tart)</p>
            </a>
            <a href="cupcake.php" class="cat-card" target="_blank">
                
                <div class="img-wrap"><img src="img/pinky-cupcake.jpg" alt="Cake"></div>
                <p>Cupcake</p>
            </a>
            <a href="cookies.php" class="cat-card" target="_blank">
                <div class="img-wrap"><img src="img/cookies.jpg" alt="Cookies"></div>
                <p>Cookies</p>
            </a>
            
            <a href="bread.php" class="cat-card" target="_blank">
                <div class="img-wrap"><img src="img/bread.jpg" alt="Bread"></div>
                <p>Bread / Roti</p>
            </a>
            
            <a href="pastry.php" class="cat-card" target="_blank">
                <div class="img-wrap"><img src="img/pastry.jpg" alt="Pastry"></div>
                <p>Pastry</p>
            </a>
            <a href="spesial.php" class="cat-card" target="_blank">
                <div class="img-wrap"><img src="img/spesial_menu.jpg" alt="Seasonal"></div>
                <p>Seasonal / Special Menu</p>
            </a>
        </div>
    </div>
</section>

<div class="section-line"></div>

<section class="contact" id="contact">
    <div class="container">
        <div class="section-title">
            <h2>CONTACT</h2>
        </div>

        <div class="contact-grid">

            <div class="contact-info">
                <a href="https://wa.me/6282329127275">📱 082329127275</a>
                <a href="https://instagram.com/ZeyaBakery">📷 @ZeyaBakery</a>
                <a href="https://tiktok.com/@zeyaBakery_">🎵 zeyaBakery_</a>
            </div>

            <form id="feedbackForm" method="POST">
                <h3>Kesan dan Pesan 🌷</h3>
                <?php if(isset($success)): ?>
                    <div style="background: #4CAF50; color: white; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 0.8rem;">
                        ✅ Terima kasih! Kesan dan pesan Anda telah terkirim.
                    </div>
                <?php endif; ?>
                <?php if(isset($error)): ?>
                    <div style="background: #f44336; color: white; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 0.8rem;">
                        ❌ <?= $error ?>
                    </div>
                <?php endif; ?>
                <input type="text" name="nama" id="cName" placeholder="Nama" required>
                <textarea name="pesan" id="cMsg" placeholder="Pesan" required></textarea>
                <button type="submit" name="submit_feedback" class="submit-btn">SUBMIT</button>
            </form>

            <div class="hours">
                <p>🕐 Senin – Sabtu: 08.00 – 20.00</p>
                <p>🕐 Minggu: 08.00 – 18.00</p>
                <p class="note">
                    Semoga setiap kue yang kami sajikan bisa menambah kebahagiaan di setiap momen spesial Anda. 🌷
                </p>
            </div>

        </div>
    </div>
</section>

<div class="section-line"></div>

<footer>
    <p>&copy; 2025 Zeya's Bakery - Baked with Love. All Rights Reserved.</p>
</footer>

<div class="modal-overlay" id="loginModal">
    <div class="modal">
        <button class="close" onclick="closeModal('loginModal')">✕</button>
        <h2>Login As</h2>
        <button class="modal-btn admin" id="adminLoginBtn">
            <span class="icon">🛡️</span>
            <div>
                <div class="label">Admin</div>
                <div class="desc">Masuk sebagai administrator</div>
            </div>
        </button>
        <button class="modal-btn user" id="userLoginBtn">
            <span class="icon">👤</span>
            <div>
                <div class="label">User</div>
                <div class="desc">Masuk sebagai pelanggan</div>
            </div>
        </button>
    </div>
</div>

<div class="modal-overlay" id="cartModal">
    <div class="modal cart-modal">
        <button class="close" onclick="closeModal('cartModal')">✕</button>
        <h2>🛒 Keranjang Belanja</h2>
        <div id="cartItems" class="cart-items">
            <div class="empty-cart">Keranjang masih kosong</div>
        </div>
        <div id="cartTotal" class="cart-total">Total: Rp0</div>
        <div class="cart-buttons">
            <button class="btn-clear" id="clearCartBtn">Kosongkan</button>
            <button class="btn-checkout" id="checkoutBtn">Checkout</button>
        </div>
    </div>
</div>

<div id="toast" class="toast"></div>

<script>
let cart = [];

window.addEventListener('scroll', function() {
    const nav = document.getElementById('navbar');
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
});

function loadCart() {
    const saved = localStorage.getItem('zeyaCart');
    if (saved) {
        try {
            cart = JSON.parse(saved);
        } catch(e) {
            cart = [];
        }
    }
    updateCartDisplay();
}

function saveCart() {
    localStorage.setItem('zeyaCart', JSON.stringify(cart));
    updateCartCount();
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    const badge = document.getElementById('cartCount');
    if (count > 0) {
        badge.textContent = count;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
}

function updateCartDisplay() {
    const container = document.getElementById('cartItems');
    const totalEl = document.getElementById('cartTotal');
    
    if (cart.length === 0) {
        container.innerHTML = '<div class="empty-cart">Keranjang masih kosong</div>';
        totalEl.innerHTML = 'Total: Rp0';
        return;
    }
    
    let html = '';
    let total = 0;
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        html += `
            <div class="cart-item">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">Rp${item.price.toLocaleString('id-ID')} x ${item.quantity}</div>
                </div>
                <button class="cart-item-remove" data-index="${index}">🗑️</button>
            </div>
        `;
    });
    
    container.innerHTML = html;
    totalEl.innerHTML = `Total: Rp${total.toLocaleString('id-ID')}`;
    
    document.querySelectorAll('.cart-item-remove').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const index = parseInt(btn.dataset.index);
            cart.splice(index, 1);
            saveCart();
            updateCartDisplay();
            showToast('Item dihapus dari keranjang');
        });
    });
}

function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.style.display = 'block';
    
    setTimeout(() => {
        toast.style.display = 'none';
    }, 2500);
}

function openModal(modalId) {
    document.getElementById(modalId).classList.add('open');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('open');
}

function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('open');
}

function handleAdminLogin() {
    closeModal('loginModal');
    showToast('Selamat datang Admin!');
    setTimeout(() => {
        alert('✨ Login sebagai Admin berhasil ✨');
    }, 100);
}

function handleUserLogin() {
    closeModal('loginModal');
    showToast('Selamat datang! Nikmati belanja di Zeya Bakery');
    setTimeout(() => {
        alert('🛍️ Anda login sebagai User. Selamat berbelanja! 🧁');
    }, 100);
}

function updateActiveNav() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 150;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
}

document.querySelectorAll('.nav-link, .brand, .mobile-menu a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href && href.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    loadCart();
    
    document.getElementById('cartBtn').addEventListener('click', () => {
        updateCartDisplay();
        openModal('cartModal');
    });
    
    document.getElementById('loginBtn').addEventListener('click', () => {
        openModal('loginModal');
    });
    
    document.getElementById('clearCartBtn').addEventListener('click', () => {
        if (cart.length > 0) {
            cart = [];
            saveCart();
            updateCartDisplay();
            showToast('Keranjang telah dikosongkan');
        } else {
            showToast('Keranjang sudah kosong');
        }
    });
    
    document.getElementById('checkoutBtn').addEventListener('click', () => {
        if (cart.length === 0) {
            showToast('Keranjang masih kosong!');
            return;
        }
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        showToast(`Checkout berhasil! Total: Rp${total.toLocaleString('id-ID')}`);
        cart = [];
        saveCart();
        updateCartDisplay();
        closeModal('cartModal');
    });
    
    document.getElementById('adminLoginBtn').addEventListener('click', handleAdminLogin);
    document.getElementById('userLoginBtn').addEventListener('click', handleUserLogin);
    
    window.addEventListener('scroll', updateActiveNav);
    updateActiveNav();
});

function toggleLoginMenu() {
    const menu = document.getElementById("loginDropdown");

    if (menu.style.display === "flex") {
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }
}

function handleClick(e, el) {
    e.preventDefault();

    const items = document.querySelectorAll(".login-dropdown a");
    items.forEach(item => item.classList.remove("active"));

    el.classList.add("active");

    setTimeout(() => {
        window.location.href = el.getAttribute("href");
    }, 200);
}
</script>
</body>
</html>