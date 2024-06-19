
<!-- Tampilkan daftar produk dalam keranjang -->
<?php if ($keranjang): ?>
    <?php foreach ($keranjang as $item): ?>
        <div class="produk-item">
            <!-- Tampilkan detail produk -->
            <h3><?= $item->nama_produk; ?></h3>
            <p>Harga: Rp. <?= number_format($item->harga, 0, ',', '.'); ?></p>
            <p>Jumlah: <?= $item->jumlah; ?></p>
            <!-- Tampilkan tombol checkout atau hapus -->
            <a href="<?= base_url('user/checkout_item/' . $item->id_produk); ?>">Checkout</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Keranjang Anda kosong.</p>
<?php endif; ?>