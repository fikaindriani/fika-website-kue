<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Manajemen Kategori</title>

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
  flex-wrap: wrap;
  gap: 15px;
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

h2 {
  text-align: center;
  margin: 20px 0;
}

/* Tabel gaya rustic */
table {
  width: 100%;
  margin-top: 20px;
  border-collapse: collapse;
  background: #e3a8a8;
}

th, td {
  border: 3px solid #8B5A2B;
  padding: 12px 15px;
  text-align: center;
  vertical-align: middle;
}

th {
  background: #d89c9c;
  color: white;
}

td {
  background: #f3cfcf;
}

/* Tombol aksi dalam tabel */
.btn-aksi {
  background: #c47d7d;
  border: none;
  padding: 5px 12px;
  border-radius: 20px;
  color: white;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 13px;
  margin: 0 3px;
  transition: 0.2s;
  text-decoration: none;
  display: inline-block;
}

.btn-aksi:hover {
  background: #a86b6b;
}

.btn-hapus {
  background: #b55a5a;
}

.btn-hapus:hover {
  background: #8f4242;
}

/* Modal popup untuk tambah/edit */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #fff0e6;
  margin: auto;
  padding: 0;
  border-radius: 20px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.3);
  border: 2px solid #c47d7d;
}

.modal-header {
  background: #d89c9c;
  padding: 15px 20px;
  border-radius: 18px 18px 0 0;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-header h3 {
  margin: 0;
}

.close {
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
  color: white;
}

.close:hover {
  color: #3e1a1a;
}

.modal-body {
  padding: 20px;
}

.modal-body label {
  font-weight: bold;
  display: block;
  margin-bottom: 8px;
  color: #5e2e2e;
}

.modal-body input {
  width: 100%;
  padding: 10px;
  border-radius: 12px;
  border: 2px solid #dba5a5;
  font-family: Georgia, serif;
  margin-bottom: 15px;
  box-sizing: border-box;
}

.modal-footer {
  padding: 15px 20px 20px;
  text-align: right;
}

.btn-simpan {
  background: #8faa6b;
}

.btn-simpan:hover {
  background: #6f8a4e;
}

.btn-batal {
  background: #b57c6a;
  margin-right: 10px;
}

.btn-batal:hover {
  background: #956151;
}

/* Toolbar */
.toolbar {
  background: #f0cfcf;
  padding: 12px 20px;
  border-radius: 15px;
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}

.check-all-area label {
  font-weight: bold;
  cursor: pointer;
}

.btn-bulk {
  background: #b55a5a;
}

/* Pesan sukses/error */
.alert {
  padding: 12px;
  border-radius: 12px;
  margin: 15px 20px 0 20px;
  font-weight: bold;
  text-align: center;
}

.alert-success {
  background: #cfe6cf;
  color: #2f5e2f;
  border: 2px solid #8baa6b;
}

.alert-error {
  background: #f3cfcf;
  color: #8b3a3a;
  border: 2px solid #c47d7d;
}

@media print {
  .nav, .toolbar, .btn-aksi, .modal, .alert, .right {
    display: none;
  }
  table {
    margin-top: 0;
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
    <a href="detail_pesanan.php">DETAIL PESANAN</a>
    <a href="kategori.php" class="active">KATEGORI</a>
    <a href="logout.php">LOGOUT</a>
  </div>
  <div class="right">
    <button class="btn" onclick="window.print()">Cetak PDF</button>
    <a href="logout.php" class="btn">Logout</a>
  </div>
</div>

<h2>🏷️ Manajemen Kategori Produk</h2>

<?php
// Proses tambah data
if(isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    if(!empty($nama)) {
        $conn->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
        echo "<div class='alert alert-success'>✅ Kategori berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-error'>⚠️ Nama kategori tidak boleh kosong!</div>";
    }
}

// Proses edit
if(isset($_POST['update'])) {
    $id = (int)$_POST['id_kategori'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    if(!empty($nama)) {
        $conn->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori=$id");
        echo "<div class='alert alert-success'>✏️ Kategori berhasil diupdate!</div>";
    } else {
        echo "<div class='alert alert-error'>⚠️ Nama kategori tidak boleh kosong!</div>";
    }
}

// Proses hapus (single)
if(isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $conn->query("DELETE FROM kategori WHERE id_kategori=$id");
    echo "<div class='alert alert-success'>🗑️ Kategori berhasil dihapus!</div>";
}

// Proses hapus massal
if(isset($_POST['bulk_delete']) && isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $id_list = implode(',', array_map('intval', $ids));
    $conn->query("DELETE FROM kategori WHERE id_kategori IN ($id_list)");
    echo "<div class='alert alert-success'>🗑️ " . count($ids) . " kategori berhasil dihapus!</div>";
}
?>

<!-- Toolbar Check All -->
<form method="POST" id="formBulk" onsubmit="return confirm('Yakin hapus kategori terpilih?')">
<div class="toolbar">
    <div class="check-all-area">
        <label>
            <input type="checkbox" id="checkAll"> Check all
        </label>
    </div>
    <div>
        <button type="submit" name="bulk_delete" class="btn btn-bulk" onclick="return attachSelectedIds()">🗑️ Hapus Terpilih</button>
    </div>
</div>

<!-- Tabel kategori -->
<div style="overflow-x: auto;">
<?php
$query = "SELECT * FROM kategori ORDER BY id_kategori DESC";
$result = $conn->query($query);
?>
<table>
    <thead>
        <tr>
            <th width="40"><input type="checkbox" disabled id="checkAllTrigger"></th>
            <th>ID Kategori</th>
            <th>Nama Kategori</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><input type="checkbox" name="selected_ids[]" value="<?= $row['id_kategori'] ?>" class="rowCheckbox"></td>
                <td><?= $row['id_kategori'] ?></td>
                <td style="text-align:left; font-weight:bold;"><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td>
                    <button class="btn-aksi" onclick="openEditModal(<?= $row['id_kategori'] ?>, '<?= addslashes($row['nama_kategori']) ?>')">✏️ Edit</button>
                    <a href="?hapus=<?= $row['id_kategori'] ?>" class="btn-aksi btn-hapus" onclick="return confirm('Yakin hapus kategori ini?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php } 
        } else { ?>
            <tr><td colspan="4" style="text-align:center;">Belum ada kategori. Silakan tambah.</td></tr>
        <?php } ?>
    </tbody>
</table>
</div>

<!-- hidden input untuk mengirim array id bulk -->
<input type="hidden" name="ids" id="bulkIds">
</form>

<!-- Modal Tambah / Edit -->
<div id="modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Kategori</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form method="POST" id="formModal">
            <div class="modal-body">
                <input type="hidden" name="id_kategori" id="editId">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" id="namaKategori" placeholder="Contoh: Cake, Cupcake, Bread..." required autocomplete="off">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-batal" onclick="closeModal()">Batal</button>
                <button type="submit" name="simpan" id="btnSimpan" class="btn btn-simpan">Simpan</button>
                <button type="submit" name="update" id="btnUpdate" class="btn btn-simpan" style="display:none;">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
// Check all functionality
const checkAllMain = document.getElementById('checkAll');
const rowCheckboxes = document.querySelectorAll('.rowCheckbox');

function updateCheckAll() {
    if(!checkAllMain) return;
    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
    checkAllMain.checked = allChecked;
}

if(checkAllMain) {
    checkAllMain.addEventListener('change', function() {
        rowCheckboxes.forEach(cb => cb.checked = checkAllMain.checked);
    });
}

rowCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateCheckAll);
});

// Fungsi untuk mengumpulkan id yang diceklis sebelum submit bulk
function attachSelectedIds() {
    const selected = Array.from(document.querySelectorAll('.rowCheckbox:checked')).map(cb => cb.value);
    if(selected.length === 0) {
        alert('Pilih minimal satu kategori untuk dihapus.');
        return false;
    }
    document.getElementById('bulkIds').value = JSON.stringify(selected);
    return confirm(`Hapus ${selected.length} kategori?`);
}

// Modal Edit
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modalTitle');
const editId = document.getElementById('editId');
const namaKategori = document.getElementById('namaKategori');
const btnSimpan = document.getElementById('btnSimpan');
const btnUpdate = document.getElementById('btnUpdate');
const formModal = document.getElementById('formModal');

function openEditModal(id, nama) {
    modalTitle.innerText = 'Edit Kategori';
    editId.value = id;
    namaKategori.value = nama;
    btnSimpan.style.display = 'none';
    btnUpdate.style.display = 'inline-block';
    modal.style.display = 'flex';
}

function openAddModal() {
    modalTitle.innerText = 'Tambah Kategori';
    editId.value = '';
    namaKategori.value = '';
    btnSimpan.style.display = 'inline-block';
    btnUpdate.style.display = 'none';
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}

// Tombol "Tambah Kategori" di bawah tabel (optional)
// Kita tambahkan tombol + di atas toolbar? Sesuai konsep, kita sediakan tombol tambah di kanan toolbar
const toolbarDiv = document.querySelector('.toolbar');
if(toolbarDiv && !document.querySelector('.btn-add-custom')) {
    const addBtn = document.createElement('button');
    addBtn.innerHTML = '➕ Tambah Kategori';
    addBtn.className = 'btn btn-simpan';
    addBtn.style.marginLeft = 'auto';
    addBtn.onclick = openAddModal;
    toolbarDiv.appendChild(addBtn);
}

// Jika ingin tombol tambah dari navigasi atau header
window.openAddModal = openAddModal;
window.closeModal = closeModal;

// Reset form jika modal ditutup
window.onclick = function(event) {
    if(event.target === modal) closeModal();
}
</script>

</body>
</html>