<?php ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | Zeya’s Bakery</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Inter', sans-serif;
    background: linear-gradient(135deg, #f6e7d8, #ead1b5);
}

.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 48px;
    background:#2b1b14;
}
.logo{
    font-family:'Playfair Display', serif;
    font-size:26px;
    font-weight:700;
    color:#e75480;
}

.main-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:85vh;
}

.login-card{
    background:#2b1b14;
    width:100%;
    max-width:380px;
    padding:30px;
    border-radius:25px;
    box-shadow:0 15px 40px rgba(255,105,180,0.2);
}

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

.input-group{margin-top:15px;}
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
}

.extra-text{
    text-align:center;
    margin-top:10px;
    font-size:12px;
}
.extra-text a{
    color:#ff69b4;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="navbar">
    <div class="logo">Zeya’s 🍰 Bakery</div>
</div>

<div class="main-container">
    <div class="login-card">

        <div class="welcome-section">
            <div class="admin-label">REGISTER</div>
            <h2>Create Account</h2>
        </div>

        <form action="proses-register.php" method="POST">

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="signin-btn">
                Register
            </button>

        </form>

        <div class="extra-text">
            Sudah punya akun? <a href="user-login.php">Login</a>
        </div>

    </div>
</div>

</body>
</html>