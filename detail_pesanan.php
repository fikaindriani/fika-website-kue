<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Pesanan</title>

<style>
body {
  font-family: Georgia, serif;
  background: #e7bcbc;
  padding: 20px;
  margin: 0;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #d89c9c;
  padding: 15px 20px;
  border-radius: 15px;
}

.menu {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.menu a {
  padding: 10px 18px;
  background: #f3c5c5;
  border-radius: 20px;
  text-decoration: none;
  color: black;
  white-space: nowrap;
  transition: 0.3s;
}

.menu a:hover {
  background: #c47d7d;
  color: white;
}

.menu a.active {
  background: #c47d7d;
  color: white;
}

.right {
  display: flex;
  gap: 10px;
}

.btn {
  background: #c47d7d;
  padding: 8px 15px;
  border-radius: 15px;
  color: white;
  text-decoration: none;
  border: none;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 14px;
  transition: 0.3s;
}

.btn:hover {
  background: #a86b6b;
}

.btn-hapus {
  background: #dc3545;
  padding: 6px 12px;
  border-radius: 10px;
  color: white;
  text-decoration: none;
  border: none;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 13px;
  transition: 0.3s;
}

.btn-hapus:hover {
  background: #c82333;
}

table {
  width: 100%;
  margin-top: 30px;
  border-collapse: collapse;
  background: #e3a8a8;
}

th, td {
  border: 3px solid #8B5A2B;
  padding: 15px;
  text-align: center;
}

th {
  background: #d89c9c;
  color: white;
}

td {
  background: #f3cfcf;
}

img {
  width: 80px;
  border-radius: 10px;
}

/* Sembunyikan tombol cetak dan hapus saat print */
@media print {
  .nav {
    display: none;
  }
  h2 {
    margin-top: 0;
  }
  .btn-print {
    display: none;
  }
  .btn-hapus {
    display: none;
  }
  th, td {
    border: 2px solid black;
  }
  th:last-child,
  td:last-child {
    display: none;
  }
}
</style>

</head>

<body>

<div class="nav">
  <div class="menu">
    <a href="dashboard-admin.php">DASHBOARD</a>
    <a href="produk.php">MANAJEMEN PRODUK</a>
    <a href="pesanan.php">MANAJEMEN PESANAN</a>
    <a href="#" class="active">DETAIL PESANAN</a>
    <a href="kategori.php">KATEGORI</a>
    <a href="logout.php">LOGOUT</a>
  </div>

  <div class="right">
    <button class="btn" onclick="window.print()">Cetak PDF</button>
    <a href="logout.php" class="btn">Logout</a>
  </div>
</div>

<h2 style="text-align:center; margin:20px 0;">📋 Detail Semua Pesanan</h2>

<?php
// Proses hapus data
if(isset($_GET['hapus'])) {
  $id_hapus = mysqli_real_escape_string($conn, $_GET['hapus']);
  
  // Ambil informasi bukti pembayaran untuk dihapus filenya
  $query_file = $conn->query("SELECT bukti FROM pesanan WHERE id_pesanan = '$id_hapus'");
  $data_file = $query_file->fetch_assoc();
  
  if($data_file && $data_file['bukti'] && file_exists("uploads/".$data_file['bukti'])) {
    unlink("uploads/".$data_file['bukti']); // Hapus file bukti
  }
  
  $query_hapus = $conn->query("DELETE FROM pesanan WHERE id_pesanan = '$id_hapus'");
  
  if($query_hapus) {
    echo "<script>
            alert('Data pesanan berhasil dihapus!');
            window.location.href = '".$_SERVER['PHP_SELF']."';
          </script>";
    exit();
  } else {
    echo "<script>alert('Gagal menghapus data!');</script>";
  }
}
?>

<div style="overflow-x: auto;">
<table>
<thead>
<tr>
  <th>ID Order</th>
  <th>Nama</th>
  <th>No Hp</th>
  <th>Produk</th>
  <th>Total Pembayaran</th>
  <th>Bukti Pembayaran</th>
  <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$data = $conn->query("SELECT * FROM pesanan ORDER BY id_pesanan DESC");

if($data->num_rows > 0){
  while($row = $data->fetch_assoc()){
?>
<tr>
  <td><?= $row['id_pesanan'] ?></td>
  <td><?= htmlspecialchars($row['nama']) ?></td>
  <td><?= htmlspecialchars($row['telepon']) ?></td>
  <td style="text-align:left;"><?= nl2br(htmlspecialchars($row['produk'])) ?></td>
  <td>Rp <?= number_format($row['total_bayar'],0,',','.') ?></td>
  <td>
    <?php if($row['bukti'] && file_exists("uploads/".$row['bukti'])): ?>
      <img src="uploads/<?= $row['bukti'] ?>" alt="Bukti Pembayaran">
    <?php else: ?>
      <span style="color:red;">File tidak ada</span>
    <?php endif; ?>
  </td>
  <td>
    <button class="btn-hapus" onclick="confirmHapus(<?= $row['id_pesanan'] ?>, '<?= addslashes($row['nama']) ?>')">🗑️ Hapus</button>
  </td>
</tr>
<?php 
  }
} else {
  echo "<tr><td colspan='7' style='text-align:center;'>Belum ada data pesanan</td></tr>";
}
?>
</tbody>
</table>
</div>

<script>
function confirmHapus(id, nama) {
  if(confirm("Apakah Anda yakin ingin menghapus pesanan dari " + nama + "?\nData yang dihapus tidak dapat dikembalikan!")) {
    window.location.href = "?hapus=" + id;
  }
}

function cetakPDF() {
  window.print();
}
</script>

</body>
</html>