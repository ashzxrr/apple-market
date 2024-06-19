
</style>
<div class="status-container">
  <a href="<?= base_url('user/wait'); ?>" class="status">Menunggu Pembayaran</a>
  <a href="<?= base_url('user/dikemas'); ?>" class="status">Dikemas</a>
  <a href="<?= base_url('user/dikirim'); ?>" class="status">Dikirim</a>  
  <a href="<?= base_url('user/selesai'); ?>" class="status">Selesai</a>
</div>
<h2>Daftar Pesanan</h2>
<?php foreach ($user_orders_details as $item): ?>
        <div class="order-card">
            <h4>Status Order: <?= $item['status_order']; ?></h4>
            <!-- Tampilkan ringkasan pesanan -->
            <div class="product-summary">
                <img src="<?= base_url('upload/produk/' . $item['foto']); ?>" alt="Foto Produk">
                <div class="product-details">
                    <p><?= $item['nama_produk']; ?></p>
                    <p>Jumlah: <?= $item['jumlah']; ?></p>

 
                    <p>Ongkos Kirim: <?= $item['ongkos_kirim']; ?></p>
                </div>
                <div class="product-total">
                <?php if ($item['total'] !== null): ?>
    <p>Total Pembayaran : Rp. <?= number_format($item['total'], 0, ',', '.'); ?></p>
<?php else: ?>
    <p>Total Pembayaran : Tidak ada data total.</p>
<?php endif; ?>
                    <!-- Tautan ke halaman detail pesanan -->
                    <a href="<?= base_url('user/detail_pesanan/' . $item['id_orders']); ?>">Detail Pesanan</a>
                </div>
            </div>
            <!-- Akhir ringkasan pesanan -->
        </div>
<?php endforeach; ?>