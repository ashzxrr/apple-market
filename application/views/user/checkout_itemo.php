<!-- Tampilkan daftar produk dalam keranjang -->
<?php if ($selected_items): ?>
    <form action="<?= base_url('user/proses_checkout_item'); ?>" method="post">
        <table border="1">
            <!-- Tambahkan header tabel sesuai kebutuhan -->
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($selected_items as $item): ?>
                <?php if (is_object($item) && property_exists($item, 'nama_produk')): ?>
                    <tr>
                        <td><?= $item->nama_produk; ?></td>
                        <td>Rp. <?= number_format($item->harga, 0, ',', '.'); ?></td>
                        <td><?= $item->jumlah; ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Error: Data Produk Tidak Valid</td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulir checkout dengan data tambahan sesuai kebutuhan -->
        <label for="nama_pembeli">Nama Pembeli:</label>
        <input type="text" name="nama_pembeli" required>

        <!-- Tambahkan input form lainnya sesuai kebutuhan -->

        <div> 
            <button type="submit">Proses Checkout</button>
        </div>
    </form>

<?php else: ?>
    <p>Tidak ada produk yang dipilih untuk checkout.</p>
<?php endif; ?>
