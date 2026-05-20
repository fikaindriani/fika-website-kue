<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "db_kue");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = trim($_SESSION['admin']);

$data = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$admin = mysqli_fetch_assoc($data);

if (isset($_POST['upload'])) {
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $error = $_FILES['foto']['error'];

        if ($error === 0) {
            $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif'];

            if (in_array($ext, $allowed)) {
                $namaBaru = time() . '.' . $ext;
                $folder = "uploads/" . $namaBaru;

                if (!is_dir("uploads")) {
                    mkdir("uploads", 0777, true);
                }

                if (move_uploaded_file($tmp, $folder)) {
                    mysqli_query($conn, "UPDATE admin SET foto='$namaBaru' WHERE username='$username'");
                    header("Location: dashboard-admin.php");
                    exit;
                } else {
                    echo "<script>alert('Gagal upload');</script>";
                }
            } else {
                echo "<script>alert('Format harus jpg/png');</script>";
            }
        } else {
            echo "<script>alert('Error upload');</script>";
        }
    } else {
        echo "<script>alert('Pilih file dulu');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    display: flex;
}

.sidebar {
    width: 230px;
    background: linear-gradient(180deg, #e9b4b4, #f8dede);
    height: 100vh;
    padding: 20px;
}

.profile {
    text-align: center;
}

.profile img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.profile h4 {
    margin: 10px 0;
}

.profile button {
    margin-top: 5px;
    padding: 6px 12px;
    border: none;
    background: #ff8fa3;
    color: white;
    border-radius: 10px;
    cursor: pointer;
}

.menu {
    margin-top: 25px;
}

.menu a {
    display: block;
    padding: 12px;
    margin: 8px 0;
    text-decoration: none;
    color: black;
    background: white;
    border-radius: 12px;
    text-align: center;
}

.main {
    flex: 1;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.main::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('img/roti.jpeg') no-repeat center;
    background-size: cover;
    filter: blur(3px);
    z-index: 0;
}

.main::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 192, 203, 0.4);
    z-index: 1;
}

.welcome {
    position: relative;
    z-index: 2;
    padding: 30px 60px;
    border-radius: 30px;
    font-size: 28px;
    font-weight: bold;
    color: #e8e8e8;
    backdrop-filter: blur(5px);
    font-family: 'Times New Roman', Times, serif;
}
</style>
</head>

<body>

<div class="sidebar">
    <div class="profile">

        <?php
        $foto = !empty($admin['foto']) ? $admin['foto'] : 'default.png';
        if (!file_exists("uploads/" . $foto)) {
            $foto = "default.png";
        }
        ?>

        <img src="uploads/<?php echo $foto; ?>?t=<?php echo time(); ?>">

        <h4><?php echo $_SESSION['admin']; ?></h4>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="foto" required>
            <br>
            <button type="submit" name="upload">Ganti Foto</button>
        </form>

    </div>

    <div class="menu">
        <a href="dashboard-admin.php">Dashboard</a>
        <a href="produk.php">Manajemen Produk</a>
        <a href="pesanan.php">Manajemen Pesanan</a>
        <a href="detail_pesanan.php">Detail Pesanan</a>
        <a href="kategori.php">Kategori</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="main">
    <div class="welcome">
        /ᐠ｡ꞈ｡ᐟ\SELAMAT DATANG ADMIN/ᐠ｡ꞈ｡ᐟ\
    </div>
</div>

</body>
</html>