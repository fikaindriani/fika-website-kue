<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Silakan login terlebih dahulu'); window.location='user-login.php';</script>";
    exit;
}

$id_user = $_SESSION['user_id'];
$query = "SELECT * FROM pesanan WHERE id_user = '$id_user' ORDER BY id_pesanan DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesanan Saya - Zeya's Bakery</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: #fdf2f2;
    color: #3d2b1f;
}

.navbar {
    background: #3d2b1f;
    padding: 18px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 20px rgba(61,43,31,0.15);
}

.navbar .logo {
    color: #d4929a;
    font-size: 1.6rem;
    font-weight: bold;
    font-family: 'Playfair Display', serif;
    letter-spacing: 1px;
}

.navbar .logo:hover {
    color: #c8943e;
    transition: 0.3s;
}

.navbar .back-btn {
    background: #d4929a;
    color: white;
    padding: 10px 24px;
    border-radius: 50px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.navbar .back-btn:hover {
    background: #c8943e;
    transform: translateY(-2px);
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
}

.page-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: 'Playfair Display', serif;
    color: #3d2b1f;
}

.page-title span {
    background: #d4929a;
    color: white;
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 16px;
    font-family: 'Inter', sans-serif;
}

.tab-bar {
    display: flex;
    gap: 8px;
    background: white;
    border-radius: 50px;
    padding: 6px;
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(61,43,31,0.06);
}

.tab-btn {
    flex: 1;
    padding: 10px 16px;
    border: none;
    background: transparent;
    font-weight: 600;
    cursor: pointer;
    border-radius: 50px;
    transition: 0.3s;
    font-size: 13px;
    color: #3d2b1f;
}

.tab-btn.active {
    background: #d4929a;
    color: white;
    box-shadow: 0 2px 6px rgba(212,146,154,0.3);
}

.tab-btn:hover:not(.active) {
    background: #f5e0e3;
}

.order-card {
    background: white;
    border-radius: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(61,43,31,0.06);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(61,43,31,0.1);
}

.order-header {
    padding: 14px 20px;
    background: #fef6f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    border-bottom: 1px solid #f0d6d6;
}

.order-id {
    font-size: 13px;
    color: #8b5e5e;
}

.order-id strong {
    color: #3d2b1f;
    font-size: 14px;
}

.status-badge {
    padding: 4px 14px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
}

.status-diproses {
    background: #fff3e0;
    color: #e67e22;
}
.status-dikemas {
    background: #e3f2fd;
    color: #2196f3;
}
.status-diantar {
    background: #e8f5e9;
    color: #4caf50;
}
.status-sampai {
    background: #e0f2e0;
    color: #2e7d32;
}
.status-ditolak {
    background: #ffebee;
    color: #e53935;
}

.order-body {
    padding: 18px 20px;
}

.product-list {
    margin-bottom: 18px;
}

.product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f5e0e3;
}

.product-name {
    font-size: 14px;
    font-weight: 600;
    color: #3d2b1f;
}

.product-price {
    text-align: right;
}

.price-value {
    font-size: 14px;
    font-weight: 700;
    color: #d4929a;
}

.order-footer {
    padding: 14px 20px;
    background: #fef6f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    border-top: 1px solid #f0d6d6;
}

.total-section {
    text-align: right;
}

.total-label {
    font-size: 11px;
    color: #b88a8a;
}

.total-value {
    font-size: 22px;
    font-weight: 800;
    color: #d4929a;
    font-family: 'Playfair Display', serif;
}

.payment-method {
    font-size: 12px;
    color: #8b5e5e;
    margin-top: 4px;
}

.btn-track {
    background: #d4929a;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-track:hover {
    background: #c8943e;
    transform: translateY(-2px);
}

.empty-state {
    background: white;
    border-radius: 20px;
    padding: 60px 20px;
    text-align: center;
}

.empty-state p {
    color: #b88a8a;
    margin-bottom: 16px;
    font-size: 16px;
}

.empty-state a {
    background: #d4929a;
    color: white;
    padding: 10px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
    display: inline-block;
}

.empty-state a:hover {
    background: #c8943e;
    transform: translateY(-2px);
}

.timeline-status {
    display: flex;
    justify-content: space-between;
    margin-top: 18px;
    padding-top: 18px;
    border-top: 1px solid #f5e0e3;
}

.timeline-step {
    text-align: center;
    flex: 1;
    position: relative;
}

.timeline-step .circle {
    width: 36px;
    height: 36px;
    background: #f0d6d6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-size: 16px;
    transition: 0.3s;
}

.timeline-step.active .circle {
    background: #d4929a;
    color: white;
    box-shadow: 0 0 0 3px #f5e0e3;
}

.timeline-step.completed .circle {
    background: #c8943e;
    color: white;
}

.timeline-step.rejected .circle {
    background: #e53935;
    color: white;
}

.timeline-step .label {
    font-size: 10px;
    color: #8b5e5e;
    font-weight: 500;
}

.timeline-step.active .label {
    color: #d4929a;
    font-weight: 700;
}

.timeline-step.rejected .label {
    color: #e53935;
    font-weight: 700;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(61,43,31,0.6);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(4px);
}

.modal.active {
    display: flex;
}

.modal-content {
    background: white;
    border-radius: 24px;
    max-width: 500px;
    width: 90%;
    padding: 24px;
    animation: modalIn 0.3s ease;
}

@keyframes modalIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f0d6d6;
}

.modal-header h3 {
    font-size: 20px;
    font-family: 'Playfair Display', serif;
    color: #3d2b1f;
}

.close-modal {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #b88a8a;
    transition: 0.2s;
}

.close-modal:hover {
    color: #d4929a;
    transform: scale(1.1);
}

.modal-body {
    max-height: 500px;
    overflow-y: auto;
}

@media (max-width: 768px) {
    .container {
        margin: 20px auto;
        padding: 0 15px;
    }
    .navbar {
        padding: 12px 20px;
    }
    .navbar .logo {
        font-size: 1.2rem;
    }
    .page-title {
        font-size: 22px;
    }
    .tab-btn {
        padding: 8px 10px;
        font-size: 11px;
    }
    .order-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-footer {
        flex-direction: column;
        align-items: flex-start;
    }
    .total-section {
        text-align: left;
    }
    .total-value {
        font-size: 20px;
    }
    .timeline-status {
        flex-direction: column;
        gap: 12px;
    }
    .timeline-step {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .timeline-step .circle {
        margin: 0;
    }
    .btn-track {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .container {
        margin: 15px auto;
        padding: 0 12px;
    }
    .tab-bar {
        flex-wrap: wrap;
        border-radius: 16px;
    }
    .tab-btn {
        font-size: 10px;
        padding: 6px 10px;
    }
    .order-body {
        padding: 14px;
    }
    .product-name {
        font-size: 13px;
    }
}
</style>
</head>
<body>

<div class="navbar">
    <div class="logo">🍰 Zeya's Bakery</div>
    <a href="index.php" class="back-btn">← Kembali Belanja</a>
</div>

<div class="container">
    <div class="page-title">
        📋 Pesanan Saya
        <span><?php echo $result->num_rows; ?></span>
    </div>

    <div class="tab-bar">
        <button class="tab-btn active" data-filter="all">Semua</button>
        <button class="tab-btn" data-filter="Di Proses">Diproses</button>
        <button class="tab-btn" data-filter="Di Kemas">Dikemas</button>
        <button class="tab-btn" data-filter="Di Antar">Dikirim</button>
        <button class="tab-btn" data-filter="Sampai">Selesai</button>
        <button class="tab-btn" data-filter="Ditolak">Ditolak</button>
    </div>

    <div class="orders-container">
        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): 
                $status = $row['status'];
                $statusClass = '';
                $statusIcon = '';
                if($status == 'Di Proses') { $statusClass = 'status-diproses'; $statusIcon = '⏳'; }
                elseif($status == 'Di Kemas') { $statusClass = 'status-dikemas'; $statusIcon = '📦'; }
                elseif($status == 'Di Antar') { $statusClass = 'status-diantar'; $statusIcon = '🚚'; }
                elseif($status == 'Sampai') { $statusClass = 'status-sampai'; $statusIcon = '✅'; }
                elseif($status == 'Ditolak') { $statusClass = 'status-ditolak'; $statusIcon = '❌'; }
                else { $statusClass = 'status-diproses'; $statusIcon = '⏳'; }
            ?>
                <div class="order-card" data-status="<?php echo $status; ?>">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>#INV-<?php echo str_pad($row['id_pesanan'], 5, '0', STR_PAD_LEFT); ?></strong>
                        </div>
                        <div class="status-badge <?php echo $statusClass; ?>">
                            <?php echo $statusIcon . ' ' . $status; ?>
                        </div>
                    </div>

                    <div class="order-body">
                        <div class="product-list">
                            <?php 
                            $produkList = explode(',', $row['produk']);
                            $totalItems = $row['qty'];
                            $showCount = min(2, count($produkList));
                            for($i = 0; $i < $showCount; $i++): 
                            ?>
                            <div class="product-item">
                                <div>
                                    <div class="product-name">🍰 <?php echo trim($produkList[$i]); ?></div>
                                </div>
                                <div class="product-price">
                                    <div class="price-value">Rp <?php echo number_format($row['harga'] / $row['qty'], 0, ',', '.'); ?></div>
                                </div>
                            </div>
                            <?php endfor; ?>
                            <?php if(count($produkList) > 2): ?>
                            <div class="product-item">
                                <div class="product-name">+<?php echo count($produkList) - 2; ?> produk lainnya</div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="timeline-status">
                            <?php
                            $steps = ['Di Proses', 'Di Kemas', 'Di Antar', 'Sampai'];
                            $currentIndex = array_search($status, $steps);
                            $isRejected = ($status == 'Ditolak');
                            
                            if($isRejected):
                            ?>
                                <div class="timeline-step rejected">
                                    <div class="circle">❌</div>
                                    <div class="label">Pesanan Ditolak</div>
                                </div>
                            <?php else: ?>
                                <?php foreach($steps as $idx => $step): 
                                    $stepStatus = '';
                                    if($idx < $currentIndex) $stepStatus = 'completed';
                                    elseif($idx == $currentIndex) $stepStatus = 'active';
                                    
                                    $stepIcons = ['Di Proses' => '📝', 'Di Kemas' => '📦', 'Di Antar' => '🚚', 'Sampai' => '🏠'];
                                ?>
                                <div class="timeline-step <?php echo $stepStatus; ?>">
                                    <div class="circle"><?php echo $stepIcons[$step]; ?></div>
                                    <div class="label"><?php echo $step; ?></div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div>
                            <div class="payment-method">💳 <?php echo $row['metode']; ?></div>
                            <div class="payment-method">📦 Total <?php echo $row['qty']; ?> item</div>
                        </div>
                        <div class="total-section">
                            <div class="total-label">Total Belanja</div>
                            <div class="total-value">Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></div>
                        </div>
                        <button class="btn-track" onclick="showDetail(<?php echo htmlspecialchars(json_encode($row)); ?>)">Lihat Detail</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>✨ Belum ada pesanan</p>
                <p>Yuk, pesan kue favoritmu sekarang!</p>
                <a href="index.php">🛍️ Mulai Belanja</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="detailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Pesanan</h3>
            <button class="close-modal" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body" id="modalBody">
        </div>
    </div>
</div>

<script>
function filterOrders(status) {
    const cards = document.querySelectorAll('.order-card');
    cards.forEach(card => {
        if(status === 'all' || card.dataset.status === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        filterOrders(this.dataset.filter);
    });
});

function showDetail(order) {
    const modal = document.getElementById('detailModal');
    const modalBody = document.getElementById('modalBody');
    
    let statusClass = '';
    if(order.status == 'Di Proses') statusClass = 'status-diproses';
    else if(order.status == 'Di Kemas') statusClass = 'status-dikemas';
    else if(order.status == 'Di Antar') statusClass = 'status-diantar';
    else if(order.status == 'Sampai') statusClass = 'status-sampai';
    else if(order.status == 'Ditolak') statusClass = 'status-ditolak';
    
    let produkHtml = '';
    let produkList = order.produk.split(',');
    let hargaPerItem = parseInt(order.total_bayar / order.qty);
    produkList.forEach(produk => {
        produkHtml += `
            <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f5e0e3;">
                <span style="font-weight:500;">🍰 ${produk.trim()}</span>
                <span style="color:#d4929a; font-weight:600;">Rp ${hargaPerItem.toLocaleString('id-ID')}</span>
            </div>
        `;
    });
    
    modalBody.innerHTML = `
        <div style="margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f0d6d6;">
            <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                <span style="color:#8b5e5e;">No. Pesanan</span>
                <strong style="color:#3d2b1f;">#INV-${String(order.id_pesanan).padStart(5,'0')}</strong>
            </div>
            <div style="display:flex; justify-content:space-between;">
                <span style="color:#8b5e5e;">Status</span>
                <span class="status-badge ${statusClass}" style="display:inline-block;">${order.status}</span>
            </div>
        </div>
        
        <div style="margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f0d6d6;">
            <h4 style="margin-bottom:10px; color:#3d2b1f; font-size:15px;">📦 Detail Pengiriman</h4>
            <p style="font-size:13px; margin-bottom:5px;"><strong>${order.nama}</strong></p>
            <p style="font-size:12px; margin-bottom:5px; color:#8b5e5e;">📞 ${order.telepon}</p>
            <p style="font-size:12px; color:#8b5e5e;">📍 ${order.alamat}</p>
            ${order.catatan ? `<p style="font-size:11px; color:#b88a8a; margin-top:8px;">📝 Catatan: ${order.catatan}</p>` : ''}
        </div>
        
        <div style="margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f0d6d6;">
            <h4 style="margin-bottom:10px; color:#3d2b1f; font-size:15px;">🍰 Produk yang Dipesan</h4>
            ${produkHtml}
            <div style="display:flex; justify-content:space-between; margin-top:12px; padding-top:10px;">
                <span style="font-weight:600;">Total ${order.qty} item</span>
                <span style="font-weight:800; color:#d4929a; font-size:17px;">Rp ${parseInt(order.total_bayar).toLocaleString('id-ID')}</span>
            </div>
        </div>
        
        <div>
            <h4 style="margin-bottom:10px; color:#3d2b1f; font-size:15px;">💳 Pembayaran</h4>
            <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                <span style="color:#8b5e5e;">Metode</span>
                <span style="font-weight:500;">${order.metode}</span>
            </div>
            ${order.bukti ? `
            <div style="margin-top:10px;">
                <span style="color:#8b5e5e;">Bukti Transfer</span><br>
                <a href="uploads/${order.bukti}" target="_blank">
                    <img src="uploads/${order.bukti}" style="width:100px; border-radius:10px; margin-top:6px; border:1px solid #f0d6d6;">
                </a>
            </div>
            ` : ''}
        </div>
        
        <a href="index.php" style="display:block; text-align:center; margin-top:20px; padding:10px; background:#d4929a; color:white; text-decoration:none; border-radius:50px; font-weight:600; font-size:13px; transition:0.3s;" onmouseover="this.style.background='#c8943e'" onmouseout="this.style.background='#d4929a'">🛍️ Beli Lagi</a>
    `;
    
    modal.classList.add('active');
}

function closeModal() {
    document.getElementById('detailModal').classList.remove('active');
}

window.onclick = function(e) {
    const modal = document.getElementById('detailModal');
    if(e.target === modal) {
        closeModal();
    }
}
</script>

</body>
</html>