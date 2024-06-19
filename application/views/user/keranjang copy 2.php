<!-- Tampilkan daftar produk dalam keranjang -->
<div class="cart-container">
    <div class="cart-header">
        <h2>Keranjang Belanja</h2>
        <a class="delete-button" href="<?= base_url('user/hapus_semua_item'); ?>">
            <i class="fas fa-trash"></i> Hapus Semua
        </a>
    <form action="<?= base_url('user/checkout_selected_items'); ?>" method="post" id="checkout-form">

        <button type="submit"">Checkout</button>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                    <th>Checkout</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $item): ?>
                    <tr>
                        <!-- Tampilkan detail produk -->
                        <td>
                            <strong><?= $item->nama_produk; ?></strong>
                        </td>
                        <td>Rp. <?= number_format($item->harga, 0, ',', '.'); ?></td>
                        <td><img src="<?= base_url('upload/produk/' . $item->foto); ?>" alt="<?= $item->nama_produk; ?>" style="max-width: 50px;"></td>
                        <td><?= $item->jumlah; ?></td>
                        <!-- Tampilkan tombol checkout atau hapus -->
                        <td>
                            <a class="button" href="<?= base_url('user/checkout_item/' . $item->id_produk); ?>">
                                <i class="fas fa-shopping-cart"></i> Checkout
                            </a>
                            <a class="delete-button" href="<?= base_url('user/hapus_item/' . $item->id_produk); ?>">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                        <!-- Tambahkan checkbox untuk checkout -->
                        <td>
                            <input type="checkbox" name="checkout_items[]" value="<?= $item->id_produk; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
