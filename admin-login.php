<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Zeya’s Bakery</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter', sans-serif;
   background: linear-gradient(135deg, #f6e7d8, #ead1b5);
    background-size: cover;
    background-position: center;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 48px;
    background:#2b1b14;
    backdrop-filter: blur(8px);
}

.logo{
    font-family:'Playfair Display', serif;
    font-size:26px;
    font-weight:700;
    color:#e75480;
}

.nav-links{
    display:flex;
    gap:30px;
}

.nav-links a{
    text-decoration:none;
    color:#a64d79;
    font-weight:500;
}

.nav-links a:hover{
    color:#ff69b4;
}

/* MAIN */
.main-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:85vh;
}

/* CARD */
.login-card{
    background:#2b1b14;
    backdrop-filter: blur(10px);
    width:100%;
    max-width:380px;
    padding:30px;
    border-radius:25px;
    box-shadow:0 15px 40px rgba(255,105,180,0.2);
}

/* TITLE */
.welcome-section h2{
    font-family:'Playfair Display', serif;
    font-size:26px;
    color:#e75480;
}

.admin-label{
    font-size:13px;
    color:#999;
    margin-bottom:10px;
}

/* INPUT */
.input-group{
    margin-top:15px;
}

.input-group label{
    display:block;
    margin-bottom:5px;
    font-size:13px;
    color:#a64d79;
}

.input-group input{
    width:100%;
    padding:10px;
    border-radius:10px;
    border:1px solid #F2BBBB;
    background:#fff5f8;
}

/* BUTTON */
.signin-btn{
    width:100%;
    margin-top:20px;
    padding:12px;
    border:none;
    border-radius:25px;
    background:#ff69b4;
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.signin-btn:hover{
    background:#e75480;
}

/* EXTRA */
.forgot-row{
    margin-top:5px;
}

.forgot-row a{
    font-size:12px;
    color:#ff69b4;
    text-decoration:none;
}

.bakery-note{
    text-align:center;
    font-size:12px;
    margin-top:15px;
    color:#d48aa0;
}
</style>
</head>

<body>

<div class="navbar">
    <div class="logo">Zeya’s 🍰 Bakery</div>
    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="categories.html">Categories</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </div>
</div>

<div class="main-container">
    <div class="login-card">

        <div class="welcome-section">
            <div class="admin-label">ADMIN PANEL</div>
            <h2>Welcome Back </h2>
        </div>

        <form action="proses-login.php" method="POST">

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Admin username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="********" required>
            </div>

            <div class="forgot-row">
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="signin-btn">
                Login as Admin
            </button>

        </form>

        <div class="bakery-note">
            🔒 Khusus admin untuk mengelola toko kue
        </div>

    </div>
</div>

</body>
</html>ini yg di login admin